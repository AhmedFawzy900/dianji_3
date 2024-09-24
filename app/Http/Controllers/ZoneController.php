<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ZoneController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'coordinates' => 'required|json',
        ]);
        Zone::create([
            'name' => $request->input('name'),
            'coordinates' => $request->input('coordinates'),
        ]);

        return redirect()->back()->with('success', 'Zone created successfully!');
    }

    public function index()
    {
        $zones = Zone::all();
        return view('zones.index',compact('zones'));
    }

    public function edit($id)
    {
        $zone = Zone::find($id);
        return view('zones.edit',compact('zone'));
    }

    public function update(Request $request, $id)
    {
        $zone = Zone::find($id); // Get the zone by ID
        $zone->coordinates = $request->coordinates;
        $zone->name = $request->name;
        $zone->save();
        $zones = Zone::all();
        return redirect()->route('zone.index')->with('success', 'Zone updated successfully!');
    }
    

    // delete one zone form array of zones not all
    public function deleteZoneItem(Request $request)
    {
        // Validate the request data
        $request->validate([
            'zone' => 'required|string|max:255'
        ]);

        $user = auth()->user(); // Assuming the user is authenticated

        // Fetch the provider's zone record
        $providerZone = Zone::where('provider_id', $user->id)->first();
        try{
            if ($providerZone) {
                // Retrieve current zones
                $zones = $providerZone->zones;

                // Remove the specified zone
                $updatedZones = array_filter($zones, function($z) use ($request) {
                    return $z !== $request->zone;
                });

                // Re-index the array to remove any gaps in keys
                $updatedZones = array_values($updatedZones);

                // Update the provider's zones
                $providerZone->zones = $updatedZones;
                $providerZone->save();

                return response()->json([
                    'message' => 'Zone deleted successfully',
                    'providerZone' => $providerZone
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Provider not found'
                ], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to delete zone'], 500);
        }
    }


    public function destroy($id)
    {
        $zone = Zone::where('id', $id);

        if (!$zone) {
            return response()->json(['message' => 'Zone not found or you are not authorized to delete it'], 404);
        }

        $zone->delete();
        $zones = Zone::all();

        return view('zones.index',compact('zones'))->with('success', 'Zone deleted successfully!');
    }

}
