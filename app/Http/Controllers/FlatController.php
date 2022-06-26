<?php

namespace App\Http\Controllers;

use App\Http\Requests\Flat\DestroyRequest;
use App\Http\Requests\Flat\StoreRequest;
use App\Http\Requests\Flat\UpdateRequest;
use App\Http\Resources\FlatTableResource;
use App\Models\Flat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class FlatController extends Controller
{
    public function index(Request $request)
    {
        $flatCollection = Flat::query();

        if (Auth::user()->type != User::TYPE_ADMIN_SUPER) {
            $flatCollection = $flatCollection->where('house_id', Auth::user()->house_id);
        } else {
            $flatCollection->when($request['house_id'], function ($q) use ($request) {
                return $q->where('house_id', $request['house_id']);
            });
        }

        $data = $flatCollection->get();

        $param['data'] = FlatTableResource::collection($data);
        $param['status'] = \config('settings.flat_status');

        return Inertia::render('Flat/index', [
            'title' => 'Flat List',
            'link' => 'flat.create',
            'label' => 'Create Flat',
            'param' => $param,
        ]);
    }

    public function create()
    {
//        $param['houses'] = $this->houseList();
        $param['customers'] = $this->customerList();
        $param['status'] = \config('settings.flat_status');

        return Inertia::render('Flat/create', [
            'title' => 'New Flat',
            'link' => 'flat.index',
            'label' => 'Flat List',
            'param' => $param,
        ]);
    }

    public function store(StoreRequest $request)
    {
        app()->flat->store($request);

        return Redirect::route('flat.index')->with('message', 'Flat Created Successfully.');
    }

    public function edit(Flat $flat)
    {
        $param['data'] = $flat;
//        $param['houses'] = $this->houseList();
        $param['customers'] = $this->customerList();
        $param['status'] = \config('settings.flat_status');

        return Inertia::render('Flat/edit', [
            'title' => 'Update Flat',
            'link' => 'flat.index',
            'label' => 'Flat List',
            'param' => $param,
        ]);
    }

    public function update(UpdateRequest $request, Flat $flat)
    {
        app()->flat->update($request, $flat);

        return redirect()->back()->with('message', __('Data successfully updated.'));
    }

    public function destroy(DestroyRequest $request, Flat $flat)
    {
        app()->flat->destroy($request, $flat);

        return redirect()->back()->with('message', __('Data successfully deleted.'));
    }
}
