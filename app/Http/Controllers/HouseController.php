<?php

namespace App\Http\Controllers;

use App\Http\Requests\House\DestroyRequest;
use App\Http\Requests\House\StoreRequest;
use App\Http\Requests\House\UpdateRequest;
use App\Http\Resources\HouseTableResource;
use App\Models\House;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class HouseController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->query();
        $where = array();

        if (!$this->adminUser()) {
            $where = array_merge(array(['houses.user_id', Auth::user()->id]), $where);
        }

        $data = House::where($where)->get();

        $param['data'] = HouseTableResource::collection($data);

        // return Inertia::render('house/index', ['param' => $param]);

        return Inertia::render('house/index', [
            'title' => 'House List',
            'link' => 'house.create',
            'label' => 'Create House',
            'param' => $param,
        ]);
    }

    public function create()
    {
        // return Inertia::render('house/create');

        return Inertia::render('house/create', [
            'title' => 'New House',
            'link' => 'house.index',
            'label' => 'House List',
        ]);
    }

    public function store(StoreRequest $request)
    {
        app()->house->store($request);

        return Redirect::route('house.index')->with('message', 'House Created Successfully.');
    }

    public function edit(House $house)
    {
        $param['data'] = $house;
        $param['users'] = User::all();

        return Inertia::render('house/edit', [
            'title' => 'Update House',
            'link' => 'house.index',
            'label' => 'House List',
            'param' => $param,
        ]);

//        return Inertia::render('house/edit', ['param' => $param]);
    }

    public function update(UpdateRequest $request, House $house)
    {
        app()->house->update($request, $house);

        return redirect()->back()->with('message', __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, House $house)
    {
        app()->house->destroy($request, $house);

        return redirect()->back()->with('message', __('Data successfully deleted.'));
    }

    public function houseList()
    {
        return response()->json(
            app()->house->houseList()
        );
    }
}
