<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Zone;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:View District')->only(['index']);
        $this->middleware('permission:Create District')->only(['store']);
        $this->middleware('permission:Edit District')->only(['edit', 'update']);
        $this->middleware('permission:Delete District')->only(['destroy']);
    }
    
    public function index()
    {
        $districts = District::with('zone')->get();
        $zones = Zone::all();
        return view('admin.districts.index', compact('districts', 'zones'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:districts,name',
            'zone_id' => 'required|exists:zones,id',
        ]);

        $district = District::create([
            'name' => $request->name,
            'zone_id' => $request->zone_id,
        ]);

        return response()->json(['success' => true, 'id' => $district->id]);
    }

    public function update(Request $request, District $district)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:districts,name,' . $district->id,
            'zone_id' => 'required|exists:zones,id',
        ]);

        $district->update([
            'name' => $request->name,
            'zone_id' => $request->zone_id,
        ]);

        return response()->json(['success' => true, 'id' => $district->id]);
    }

    public function destroy(District $district)
    {
        $district->delete();
        return response()->json(['success' => true]);
    }
}
