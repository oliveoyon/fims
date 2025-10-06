<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tender;
use App\Models\Component;
use App\Models\Tenderer;
use App\Models\School;

class TenderController extends Controller
{
    public function index()
    {
        $tenders = Tender::with(['component', 'tenderer', 'schools'])->latest()->get();
        $components = Component::all();
        $tenderers = Tenderer::all();
        $schools = School::all();
        return view('admin.tenders.index', compact('tenders', 'components', 'tenderers', 'schools'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'component_id' => 'required|exists:components,id',
            'tenderer_id' => 'required|exists:tenderers,id',
            'schools' => 'required|array',
            'schools.*' => 'exists:schools,id',
            'description' => 'nullable|string',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_active' => 'nullable|boolean'
        ]);

        $tender = Tender::updateOrCreate(
            ['id' => $request->id],
            $request->only(['title','component_id','tenderer_id','description','start_date','end_date']) + ['is_active' => $request->has('is_active')]
        );

        $tender->schools()->sync($request->schools);

        return response()->json(['success' => true]);
    }

    public function edit(Tender $tender)
    {
        $tender->load('schools');
        return response()->json($tender);
    }

    public function update(Request $request, Tender $tender)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'component_id' => 'required|exists:components,id',
        'tenderer_id' => 'required|exists:tenderers,id',
        'schools' => 'required|array',
        'schools.*' => 'exists:schools,id',
        'description' => 'nullable|string',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
        'is_active' => 'nullable|boolean'
    ]);

    $tender->update(
        $request->only(['title','component_id','tenderer_id','description','start_date','end_date']) + ['is_active' => $request->has('is_active')]
    );

    $tender->schools()->sync($request->schools);

    return response()->json(['success' => true]);
}


    public function destroy(Tender $tender)
    {
        $tender->schools()->detach();
        $tender->delete();
        return response()->json(['success' => true]);
    }

    // Dependent dropdowns
    public function schoolsByDivision($division)
    {
        return response()->json(School::where('division_id', $division)->get());
    }

    public function schoolsByZone($zone)
    {
        return response()->json(School::where('zone_id', $zone)->get());
    }

    public function schoolsByDistrict($district)
    {
        return response()->json(School::where('district_id', $district)->get());
    }

    public function schoolsByUpazila($upazila)
    {
        return response()->json(School::where('upazila_id', $upazila)->get());
    }
}
