<?php

namespace App\Http\Controllers;

use App\Http\Resources\HotelResource;
use App\Models\City;
use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(HotelResource::collection(Hotel::all()), 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $hotel = Hotel::findOrFail($id);
        return response()->json(new HotelResource($hotel), 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'name' => 'required|string',
            'image' => 'required|url',
            'address' => 'required|string',
            'description' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
            'city' => 'required|string',
        ]);

        // Create city if its not exist in the database
        $city = City::firstOrCreate(['name' => $request->city]);

        // Check if the hotel already exists
        $existingHotel = Hotel::where('name', $request->name)->where('city_id', $city->id)->first();
        if ($existingHotel) {
            // Hotel exist return proper error
            return response()->json([
                'message' => 'Hotel already exists.',
                'hotel' => $existingHotel
            ], 409);
        }

        $request->merge(['city_id' => $city->id]);
        $hotel = Hotel::create([
            'name' => $validatedData['name'],
            'image' => $validatedData['image'],
            'address' => $validatedData['address'],
            'description' => $validatedData['description'],
            'stars' => $validatedData['stars'],
            'city_id' => $city->id,
        ]);

        return response()->json([
            'message' => 'Hotel created successfully',
            'hotel' => $hotel
        ], 201);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if (count($request->all()) === 0) {
            return response()->json([
                'message' => 'No data provided to update the hotel.',
            ], 400);
        }

        $request->validate([
            'name' => 'nullable|string',
            'image' => 'nullable|url',
            'address' => 'nullable|string',
            'description' => 'nullable|string',
            'stars' => 'nullable|integer|min:1|max:5',
            'city' => 'nullable|string',
        ]);

        // Find the hotel by ID
        $hotel = Hotel::findOrFail($id);

        if ($request->has('city')) {
            $city = City::firstOrCreate(['name' => $request->city]);
            $request->merge(['city_id' => $city->id]);
        }

        $hotel->update($request->only([
            'name',
            'image',
            'address',
            'description',
            'stars',
            'city_id',
        ]));

        return response()->json([
            'message' => 'Hotel updated successfully.',
            'hotel' => $hotel
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);
        $hotel->delete();

        return response()->json(null, 204);
    }
}
