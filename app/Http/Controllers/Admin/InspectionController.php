<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inspection;
use App\Models\Tender;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InspectionController extends Controller
{
    public function index()
    {
        // Latest inspection per tender-school pair
        $inspections = Inspection::select('inspections.*')
            ->whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')
                    ->from('inspections')
                    ->groupBy('tender_id', 'school_id');
            })
            ->with(['tender', 'school', 'inspector'])
            ->latest()
            ->get();

        $tenders = Tender::where('is_active', 1)->get();
        return view('admin.inspections.index', compact('inspections', 'tenders'));
    }

    public function getSchoolsByTender($tender_id)
    {
        $tender = Tender::findOrFail($tender_id);
        return response()->json($tender->schools()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'tender_id' => 'required|exists:tenders,id',
            'school_id' => 'required|exists:schools,id',
            'work_status' => 'required|string',
            'progress_percentage' => 'nullable|numeric|min:0|max:100',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB max per image
            'videos.*' => 'nullable|mimes:mp4,mov,avi,wmv|max:102400' // 100MB max per video
        ], [
            'images.*.max' => 'Each image must not exceed 5MB.',
            'videos.*.max' => 'Each video must not exceed 100MB.',
            'images.*.mimes' => 'Only jpeg, png, jpg, gif, webp images are allowed.',
            'videos.*.mimes' => 'Only mp4, mov, avi, wmv videos are allowed.'
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('inspections/images', 'public');
            }
        }

        $videos = [];
        if ($request->hasFile('videos')) {
            foreach ($request->file('videos') as $video) {
                $videos[] = $video->store('inspections/videos', 'public');
            }
        }

        Inspection::updateOrCreate(
            ['id' => $request->id],
            [
                'tender_id' => $request->tender_id,
                'school_id' => $request->school_id,
                'inspector_id' => Auth::id(),
                'work_description' => $request->work_description,
                'work_status' => $request->work_status,
                'progress_percentage' => $request->progress_percentage ?? 0,
                'observation' => $request->observation,
                'recommendation' => $request->recommendation,
                'latitude' => $request->latitude,
                'longitude' => $request->longitude,
                'images' => $images,
                'videos' => $videos,
                'is_active' => 1
            ]
        );

        return response()->json(['success' => true]);
    }


    public function edit(Inspection $inspection)
    {
        // Add full URLs for media
        $inspection->images = $inspection->images ? array_map(fn($img) => asset('storage/' . $img), $inspection->images) : [];
        $inspection->videos = $inspection->videos ? array_map(fn($vid) => asset('storage/' . $vid), $inspection->videos) : [];
        return response()->json($inspection);
    }


    public function destroy(Inspection $inspection)
    {
        $inspection->delete();
        return response()->json(['success' => true]);
    }

    public function history(Inspection $inspection)
    {
        // Get all inspections for the same tender & school
        $history = Inspection::where('tender_id', $inspection->tender_id)
            ->where('school_id', $inspection->school_id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Add full URLs for media
        $history->transform(function ($item) {
            $item->images = $item->images ? array_map(fn($img) => asset('storage/' . $img), $item->images) : [];
            $item->videos = $item->videos ? array_map(fn($vid) => asset('storage/' . $vid), $item->videos) : [];
            return $item;
        });

        return response()->json($history);
    }
}
