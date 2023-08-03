<?php

namespace App\Http\Controllers;

use App\Models\House;
use App\Http\Requests\SearchHouseRequest;
use App\Http\Requests\UpdateHouseRequest;

class HouseController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(SearchHouseRequest $request)
    {
        $houses = House::where('name', 'LIKE', $request->get('name'))
            ->orWhereBetween('price', [$request->get('min'), $request->get('max')])
            ->orWhere('bedrooms', $request->get('bedrooms'))
            ->orWhere('bathrooms', $request->get('bathrooms'))
            ->orWhere('storeys', $request->get('storeys'))
            ->orWhere('garages', $request->get('garages'))
            ->get();
    }
}
