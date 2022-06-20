<?php

namespace App\Components;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\InvoiceItem\StoreRequest as InvoiceItemStoreRequest;
use App\Models\Invoice;

class InvoiceProcess
{
    public function generateInvoice()
    {
        Log::info('Invoice Cron: Start');

        $customers = Customer::where('status', 'active')->get();

        foreach ($customers as $customer) {
            if (!$customer->rentedFlats->count()) {
                continue;
            }

            $exist = Invoice::whereMonth('date', date('m'))->where('customer_id', $customer->id)->first();

            if ($exist) {
                continue;
            }

            $requestData = array(
                'date' => Carbon::now()->startOfMonth()->format('Y-m-d'),
                'customer_id' => $customer->id,
                'house_id' => $customer->house_id
            );

            $storeRequest = StoreRequest::make($requestData);
            $invoice = app()->invoice->store($storeRequest);

            $totalRent = 0;

            foreach ($customer->rentedFlats as $flat) {
                $totalRent += $flat->rent;

                $itemData = [
                    'invoice_id' => $invoice->id,
                    'flat_id' => $flat->id,
                    'amount' => $flat->rent
                ];

                $storeRequest = InvoiceItemStoreRequest::make($itemData);
                app()->invoiceItem->store($storeRequest);
            }

            $invoice->subtotal = $totalRent;
            $invoice->total = $totalRent;
            $invoice->number = sprintf("%06d", $invoice->id);
            $invoice->update();
        }

        Log::info('Invoice Cron: Finish');
    }
}
