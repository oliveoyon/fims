<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\School;
use App\Models\Division;
use App\Models\Zone;
use App\Models\District;
use App\Models\Upazila;

class SchoolController extends Controller
{
    public function index() {
        $schools = School::latest()->with(['division','zone','district','upazila'])->get();
        $divisions = Division::all();
        return view('admin.schools.index', compact('schools','divisions'));
    }

    public function store(Request $request) {
        $data = $request->validate([
            'division_id' => 'required|exists:divisions,id',
            'zone_id' => 'required|exists:zones,id',
            'district_id' => 'required|exists:districts,id',
            'upazila_id' => 'required|exists:upazilas,id',
            'name' => 'required|string|max:255',
            'address' => 'nullable|string|max:500',
            'phone' => 'nullable|string|max:20',
            'geo_location' => 'nullable|string|max:100',
            'is_active' => 'boolean',
        ]);

        $data['is_active'] = $request->has('is_active');

        School::updateOrCreate(['id' => $request->id], $data);
        return response()->json(['success'=>true]);
    }

    public function edit(School $school) {
        return response()->json($school);
    }

    public function destroy(School $school) {
        $school->delete();
        return response()->json(['success'=>true]);
    }

    // Dependency dropdowns
    public function getZones($divisionId) {
        return response()->json(Zone::where('division_id', $divisionId)->get());
    }

    public function getDistricts($zoneId) {
        return response()->json(District::where('zone_id', $zoneId)->get());
    }

    public function getUpazilas($districtId) {
        return response()->json(Upazila::where('district_id', $districtId)->get());
    }
}
