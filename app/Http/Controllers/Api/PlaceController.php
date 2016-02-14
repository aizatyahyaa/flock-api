<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddPlaceRequest;
use App\Place;
use App\Services\PlaceService;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    public function __construct(PlaceService $PlaceService)
    {
        $this->PlaceService = $PlaceService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all()->load('user');

        return response()->json($places);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //s
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPlaceRequest $request)
    {
        $this->PlaceService->createOrUpdatePlace($request);

        return response()->json(['message' => 'Place Saved']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        $exist = Place::find($place)->exists();

        if ($exist) {
            return response()->json(true);
        } else {
            return response()->json(false);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPlaceRequest $request, Place $place)
    {
        $this->PlaceService->createOrUpdatePlace($request, $place);

        return response()->json(['message' => 'Place Stored']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        $place->delete();

        return response()->json(['message' => 'Place Deleted']);
    }
}
