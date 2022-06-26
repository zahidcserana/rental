<?php

namespace App\Http\Controllers;

use App\Http\Resources\FlatTableResource;
use App\Http\Resources\InvoiceTableResource;
use App\Models\Customer;
use App\Models\Flat;
use App\Models\House;
use App\Models\Invoice;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Seeders\ResetSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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

        $invoices = Invoice::where($where)->whereMonth('date', '=', date('m'))->whereYear('date', '=', date('Y'))->get();
        $lastMonthCollect = $invoices->sum('paid');

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
                'flatAvailable' => $flatAvailable,
                'flatAvailableCount' => $flatAvailable->count(),
                'flatRentedCount' => $flatRented->count(),
                'invoice' => $dueInvoiceData,
                'invoiceLastMonth' => $dueInvoiceLastMonthData,
                'customer' => $customer,
                'lastMonthCollect' => $lastMonthCollect,
                'customerCount' => $customer->count(),
                'summary' => [
                    'totalDue' => $totalDue,
                    'totalLastMonthDue' => $totalLastMonthDue,
                    'invoice' => $dueInvoice->count(),
                ],
            ],
        ]);
    }

    public function reset(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        DB::table('flats')->truncate();
        DB::table('houses')->truncate();
        DB::table('customers')->truncate();
        DB::table('invoice_items')->truncate();
        DB::table('invoices')->truncate();
        DB::table('users')->truncate();

        House::create([
            'id' => 1,
            'name' => 'Mirpur House',
        ]);

        User::create([
            'id' => 2,
            'name' => 'Analytical Admin',
            'email' => 'admin@admin.com',
            'type' => User::TYPE_ADMIN,
            'house_id' => 1
        ]);

//        $seeder = new ResetSeeder();
//        $seeder->run();


        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended(RouteServiceProvider::HOME);
    }
}
