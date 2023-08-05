<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function show(Request $request): String
    {
        sleep(2);
        $houses = House::where(function ($query) use ($request) {
            if ($request->get('name')) {
                $query->where('name', 'LIKE', '%' . $request->get('name') .'%');
            }
            if ($request->get('min') || $request->get('max')) {
                $query->whereBetween('price', [$request->get('min') ?? 0, $request->get('max') ?? 100000000]);
            }
            if ($request->get('bedrooms')) {
                $query->where('bedrooms', $request->get('bedrooms'));
            }
            if ($request->get('bathrooms')) {
                $query->where('bathrooms', $request->get('bathrooms'));
            }
            if ($request->get('storeys')) {
                $query->where('storeys', $request->get('storeys'));
            }
            if ($request->get('garages')) {
                $query->where('garages', $request->get('garages'));
            }
        })->get();

        return $houses->toJson();
    }
}
