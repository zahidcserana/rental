<?php

namespace App\Http\Controllers;

use App\Http\Requests\Customer\DestroyRequest;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Resources\CustomerTableResource;
use App\Http\Resources\FlatCollection;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();
        $where = array();

        if (Auth::user()->type != User::TYPE_ADMIN_SUPER) {
            $where = array_merge(array(['customers.house_id', Auth::user()->house_id]), $where);
        }

        $data = Customer::where($where)->get();

        $param['data'] = CustomerTableResource::collection($data);
        $param['status'] = \config('settings.invoice_status');
        $param['query'] = $query;

        return Inertia::render('Customer/index', [
            'title' => 'Customer List',
            'link' => 'customer.create',
            'label' => 'Create Customer',
            'param' => $param,
        ]);
    }

    public function create()
    {
        return Inertia::render('Customer/create', [
            'title' => 'New Customer',
            'link' => 'customer.index',
            'label' => 'Customer List',
        ]);
    }

    public function store(StoreRequest $request)
    {
        app()->customer->store($request);

        return Redirect::route('customer.index')->with('message', 'Customer Created Successfully.');
    }

    public function edit(Customer $customer)
    {
        $param['data'] = $customer;

        return Inertia::render('Customer/edit', [
            'title' => 'Update Customer',
            'link' => 'customer.index',
            'label' => 'Customer List',
            'param' => $param,
        ]);
    }

    public function update(UpdateRequest $request, Customer $customer)
    {
        app()->customer->update($request, $customer);

        return redirect()->back()->with('message', __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, Customer $customer)
    {
        app()->customer->destroy($request, $customer);

        return redirect()->back()->with('message', __('Data successfully deleted.'));
    }

    public function customerFlat(Customer $customer)
    {
        $data = app()->customer->customerFlat($customer);

        return new FlatCollection($data);
    }

    public function dropdownList()
    {
        return response()->json(
            app()->customer->dropdownList()
        );
    }
}
