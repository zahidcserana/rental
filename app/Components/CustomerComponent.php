<?php

namespace App\Components;

use App\Models\Customer;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Http\Requests\Customer\DestroyRequest;
use Illuminate\Support\Facades\Auth;

class CustomerComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $customer = Customer::create($input);

        return $customer;
    }

    public function update(UpdateRequest $request, Customer $customer)
    {
        $input = $request->validated();

        $customer->update($input);

        return $customer;
    }

    public function destroy(DestroyRequest $request, Customer $customer)
    {
        $customer->delete();

        $response = ['id' => $customer->id, 'name' => $customer->name];

        return $response;
    }

    public function customerFlat(Customer $customer)
    {
        foreach ($customer->flats as $flat) {
            $flat->house;
        }

        return $customer->flats;
    }

    public function dropdownList()
    {
        $where = array();

        if (!$this->adminUser()) {
            $where = array_merge(array(['customers.user_id', Auth::user()->id]), $where);
        }

        $data = Customer::select('id', 'name')->where($where)->get();

        return $data;
    }
}
