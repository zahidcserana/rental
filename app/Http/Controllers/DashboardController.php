<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlatTableResource;
use App\Http\Resources\InvoiceTableResource;
use App\Models\Customer;
use App\Models\Flat;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $where = array(['house_id', Auth::user()->house_id]);
        $customer = Customer::where($where)->orderBy('account_balance', 'desc')->get();

        $flatAvailable = Flat::where($where)->where('status', Flat::STATUS_AVAILABLE)->get();
        $flatAvailable = FlatTableResource::collection($flatAvailable);
        $flatRented = Flat::where($where)->where('status', Flat::STATUS_RENTED)->get();

        $invoiceCollection = Invoice::where($where);
        $dueInvoice = $invoiceCollection->where('status', '<>', Invoice::STATUS_PAID);
        $dueInvoiceData = InvoiceTableResource::collection($dueInvoice->get());
        $totalDue = $dueInvoiceData->sum('total') - $dueInvoiceData->sum('paid');

        $dueInvoiceLastMonth = $invoiceCollection->whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->get();
        $dueInvoiceLastMonthData = InvoiceTableResource::collection($dueInvoiceLastMonth);
        $totalLastMonthDue = $dueInvoiceLastMonthData->sum('total') - $dueInvoiceLastMonthData->sum('paid');

        return Inertia::render('Dashboard', [
            'title' => 'Dashboard',
            'param' => [
                'flat' => $flatAvailable,
                'invoice' => $dueInvoiceData,
                'invoiceLastMonth' => $dueInvoiceLastMonthData,
                'customer' => $customer,
                'summary' => [
                    'totalDue' => $totalDue,
                    'totalLastMonthDue' => $totalLastMonthDue,
                    'customer' => $customer->count(),
                    'flat' => $flatRented->count(),
                    'invoice' => $dueInvoice->count(),
                ],
            ],
        ]);
    }
}
