<?php

namespace App\Components;

use App\Http\Requests\Customer\DestroyRequest;
use App\Http\Requests\Customer\StoreRequest;
use App\Http\Requests\Customer\UpdateRequest;
use App\Models\Customer;
use App\Models\User;
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
        $flats = [];
        foreach ($customer->flats as $flat) {
            $flat->house;

            if ($flat->house_id == $customer->house_id) {
                $flats[] = $flat;
            }
        }

        return $flats;
    }

    public function dropdownList()
    {
        $where = array();

        if (Auth::user()->type != User::TYPE_ADMIN_SUPER) {
            $where = array_merge(array(['customers.house_id', Auth::user()->house_id]), $where);
        }

        $data = Customer::select('id', 'name')->where($where)->get();

        return $data;
    }
}
