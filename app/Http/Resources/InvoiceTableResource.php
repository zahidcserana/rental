<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Request;

class InvoiceTableResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        unset($resource);

        $resource['id'] = $this->id;
        $resource['date'] = $this->date;
        $resource['number'] = $this->number;
        $resource['subtotal'] = $this->subtotal;
        $resource['additional_cost'] = $this->additional_cost;
        $resource['discount'] = $this->discount;
        $resource['total'] = $this->total;
        $resource['paid'] = $this->paid;
        $resource['due_amount'] = $this->total - $this->paid;
        $resource['status'] = $this->status;
        $resource['customer'] = ['url' => route('customer.edit', ['customer' => $this->customer]), 'name' => $this->customer->name];
        $resource['house'] = ['url' => route('house.edit', ['house' => $this->house]), 'name' => $this->house->name];
//        $resource['direct_url'] = ['url' => route('invoice.direct_url', ['direct_url' => $this->number]), 'name' => $this->number];
        $resource['link_edit'] = route('invoice.edit', ['invoice' => $this]);
        $resource['link_show'] = route('invoice.show', ['invoice' => $this]);
        $resource['link_delete'] = ['token' => csrf_token(), 'url' => route('invoice.destroy', ['id' => $this->id, 'invoice' => $this])];

        return $resource;
    }
}
