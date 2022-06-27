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
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
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

        $seeder = new ResetSeeder();
        $seeder->run();


        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function register()
    {
//        $this->truncates();
        $this->houseDhaka();
        $this->houseMirpur(2);
        $this->houseGazipur(3);

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function truncates()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        $tableNames = Schema::getConnection()->getDoctrineSchemaManager()->listTableNames();

        foreach ($tableNames as $name) {
            if ($name == 'migrations') {
                continue;
            }
            DB::table($name)->truncate();
        }

        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }

    public function houseDhaka()
    {
        House::create([
            'id' => 1,
            'name' => 'Dhaka House',
        ]);

        User::create([
            'id' => 1,
            'name' => 'Analytical Journey',
            'email' => 'admin@analytical.com',
            'mobile' => '01970887754',
            'password' => Hash::make('analyt$cal'),
            'type' => User::TYPE_ADMIN_SUPER,
            'house_id' => 1,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'id' => 2,
            'name' => 'Analytical Admin',
            'email' => 'admin@admin.com',
            'mobile' => '01708887754',
            'password' => Hash::make('secret'),
            'type' => User::TYPE_ADMIN,
            'house_id' => 1,
            'remember_token' => Str::random(10),
        ]);
    }

    public function houseMirpur($houseId = 2)
    {
        House::create([
            'id' => $houseId,
            'name' => 'Mirpur House',
        ]);

        User::create([
            'name' => 'Analytical Journey',
            'email' => 'admin@mirpur.com',
            'mobile' => '0170888775' . $houseId + 1,
            'password' => Hash::make('analyt$cal'),
            'type' => User::TYPE_ADMIN_SUPER,
            'house_id' => $houseId,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Analytical Admin',
            'email' => 'mirpur@admin.com',
            'mobile' => '0170888775' . $houseId,
            'password' => Hash::make('secret'),
            'type' => User::TYPE_ADMIN,
            'house_id' => $houseId,
            'remember_token' => Str::random(10),
        ]);
    }

    public function houseGazipur($houseId = 3)
    {
        House::create([
            'id' => $houseId,
            'name' => 'Gazipur House',
        ]);

        User::create([
            'name' => 'Analytical Journey',
            'email' => 'admin@gazipur.com',
            'mobile' => '0170888775' . $houseId + 1,
            'password' => Hash::make('analyt$cal'),
            'type' => User::TYPE_ADMIN_SUPER,
            'house_id' => $houseId,
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Analytical Admin',
            'email' => 'gazipur@admin.com',
            'mobile' => '0170888775' . $houseId,
            'password' => Hash::make('secret'),
            'type' => User::TYPE_ADMIN,
            'house_id' => $houseId,
            'remember_token' => Str::random(10),
        ]);
    }


    public function resetHouse($houseId)
    {
        Invoice::where('house_id', $houseId)->forceDelete();
    }
}
