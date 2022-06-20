<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $invoices = Invoice::all();

        foreach ($invoices as $invoice) {
            $this->updateData($invoice);
        }
    }

    public function updateData($invoice)
    {
        $subTotal = 0;

        foreach ($invoice->invoiceItems as $invoiceItem) {
            $subTotal += $invoiceItem->amount;
        }

        $invoice->subtotal = $subTotal;
        $invoice->total = ($invoice->subtotal + $invoice->additional_cost) - $invoice->discount;
        $rand = rand(0, 2);

        if ($rand == 1) {
            $invoice->paid = $invoice->total;
            $invoice->status = 'paid';
        } else if ($rand == 2) {
            $invoice->paid = rand(10, $invoice->total - 1000);
            $invoice->status = 'due';
        } else if ($rand == 0) {
            $invoice->paid = 0;
            $invoice->status = 'unpaid';
        }

        $invoice->house_id = $invoice->customer->house_id;
        $invoice->update();
        $invoice->refresh();
    }
}
