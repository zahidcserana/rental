<?php

namespace App\Components;

use App\Http\Requests\House\DestroyRequest;
use App\Http\Requests\House\StoreRequest;
use App\Http\Requests\House\UpdateRequest;
use App\Models\House;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class HouseComponent extends BaseComponent
{
    public function store(StoreRequest $request)
    {
        $input = $request->validated();

        $house = House::create($input);
        $house->slug = Str::slug($house->name) . '-' . $house->id;
        $house->update();


        return $house;
    }

    public function update(UpdateRequest $request, House $house)
    {
        $input = $request->validated();

        $house->update($input);

        $house->refresh();

        return $house;
    }

    public function destroy(DestroyRequest $request, House $house)
    {
        $house->flats()->delete();

        $house->delete();

        $response = ['id' => $house->id, 'name' => $house->name, 'user_id' => $house->user_id];

        return $response;
    }

    public function houseList()
    {
        $where = array();

        if (!$this->adminUser()) {
            $where = array_merge(array(['houses.user_id', Auth::user()->id]), $where);
        }

        $data = House::select('id', 'name')->where($where)->get();

        return $data;
    }
}
