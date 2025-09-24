<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use App\Models\Division;
use Illuminate\Http\Request;

class ZoneController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View Zone')->only(['index']);
        $this->middleware('permission:Create Zone')->only(['store']);
        $this->middleware('permission:Edit Zone')->only(['edit', 'update']);
        $this->middleware('permission:Delete Zone')->only(['destroy']);
    }
    
    public function index()
    {
        $zones = Zone::with('division')->get();
        $divisions = Division::all();
        return view('admin.zones.index', compact('zones', 'divisions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:zones,name',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $zone = Zone::create([
            'name' => $request->name,
            'division_id' => $request->division_id,
        ]);

        return response()->json(['success' => true, 'id' => $zone->id]);
    }

    public function update(Request $request, Zone $zone)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:zones,name,' . $zone->id,
            'division_id' => 'required|exists:divisions,id',
        ]);

        $zone->update([
            'name' => $request->name,
            'division_id' => $request->division_id,
        ]);

        return response()->json(['success' => true, 'id' => $zone->id]);
    }

    public function destroy(Zone $zone)
    {
        $zone->delete();
        return response()->json(['success' => true]);
    }
}
