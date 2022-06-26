<?php

namespace App\Http\Controllers;

use App\Components\InvoiceProcess;
use App\Http\Requests\Invoice\DestroyRequest;
use App\Http\Requests\Invoice\StoreRequest;
use App\Http\Requests\Invoice\UpdateRequest;
use App\Http\Resources\InvoiceResource;
use App\Http\Resources\InvoiceTableResource;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $dataCollection = Invoice::query();

        if (Auth::user()->type != User::TYPE_ADMIN_SUPER) {
            $dataCollection = $dataCollection->where('house_id', Auth::user()->house_id);
        }

        $dataCollection->when($request['customer_id'], function ($q) use ($request) {
            return $q->where('customer_id', $request['customer_id']);
        });

//        $request['status'] = empty($request['status']) ? 'unpaid' : ($request['status'] == 'all' ? null : $request['status']);
        $request['date'] = $request['date'] ?? date('y-m-d');

        $month = empty($request['date_invoice']['month']) ? date('m') : $request['date_invoice']['month'] + 1;
        $year = $request['date_invoice']['year'] ?? date('Y');

        $dataCollection->when($request['status'], function ($q) use ($request) {
            if ($request['status'] == 'paid') {
                return $q->where('status', 'paid');
            } else {
                return $q->where('status', '<>', 'paid');
            }
        });

        $dataCollection->when($month, function ($q) use ($month, $year) {
            return $q->whereMonth('date', '=', $month)
                ->whereYear('date', '=', $year);
        });


        $data = $dataCollection->get();

        $collection = InvoiceTableResource::collection($data);
        $summary['subtotal'] = $collection->sum('subtotal');
        $summary['additional_cost'] = $collection->sum('additional_cost');
        $summary['discount'] = $collection->sum('discount');
        $summary['total'] = $collection->sum('total');
        $summary['paid'] = $collection->sum('paid');
        $summary['due'] = $collection->sum('total') - $collection->sum('paid');

        $param['summary'] = $summary;
        $param['data'] = $collection;
        $param['customers'] = app()->customer->dropdownList();
        $param['status'] = \config('settings.invoice_status');

        $query = $request->query();
        $query['date_invoice']['month'] = $month - 1;
        $query['date_invoice']['year'] = $year;

        $param['query'] = $query;

        return Inertia::render('Invoice/index', [
            'title' => 'Invoice List',
            'link' => 'invoice.create',
            'label' => 'Generate Invoice',
            'param' => $param,
        ]);
    }

    public function create()
    {
        $invoiceProcess = new InvoiceProcess();

        $invoiceProcess->generateInvoice();

//        Artisan::call('invoice:generate');

        return Redirect::back()->with('message', 'Invoice Created Successfully.');
    }

    public function store(StoreRequest $request)
    {
        app()->invoice->store($request);

        return Redirect::route('invoice.index')->with('message', 'Invoice Created Successfully.');
    }

    public function edit(Invoice $invoice)
    {
        $param = new InvoiceResource($invoice);

//        return Inertia::render('invoice/edit', ['param' => $invoice]);
        return Inertia::render('Invoice/edit', [
            'title' => 'Update Invoice',
            'link' => 'invoice.index',
            'label' => 'Invoice List',
            'param' => $param,
        ]);
    }

    public function show(Invoice $invoice)
    {
        $param = new InvoiceResource($invoice);

        return Inertia::render('Invoice/show', [
            'title' => 'View Invoice',
            'link' => 'invoice.index',
            'label' => 'Invoice List',
            'param' => $param,
        ]);
    }

    public function update(UpdateRequest $request, Invoice $invoice)
    {
        app()->invoice->update($request, $invoice);

        return redirect()->back()->with('message', __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, Invoice $invoice)
    {
        app()->invoice->destroy($request, $invoice);

        return redirect()->back()->with('message', __('Data successfully deleted.'));
    }
}
