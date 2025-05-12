<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserReportController extends Controller
{
    public function store(Request $request)
    {
        // ولیدیشن تمام فیلدها
        $validated = $request->validate([
            'program_id'               => 'nullable|exists:programs,id',
            'type'                     => 'required|string|max:255',
            'title'                    => 'required|string|max:255',
            'start_date'               => 'required|date',
            'end_date'                 => 'nullable|date|after_or_equal:start_date',
            'area'                     => 'required|string|max:255',
            'peak_name'                => 'nullable|string|max:255',
            'peak_height'              => 'nullable|integer',
            'start_altitude'           => 'nullable|integer',
            'road_type'                => 'nullable|array',
            'transportation'           => 'nullable|array',
            'water_type'               => 'nullable|array',
            'peak_view_location'       => 'nullable|string|max:255',
            'food_availability'        => 'nullable|string|max:255',
            'leader_id'                => 'nullable|exists:users,id',
            'assistant_leader_id'      => 'nullable|exists:users,id',
            'technical_manager_id'     => 'nullable|exists:users,id',
            'support_id'               => 'nullable|exists:users,id',
            'guide_id'                 => 'nullable|exists:users,id',
            'technical'                => 'nullable|string|max:255',
            'required_equipment'       => 'nullable|array',
            'difficulty'               => 'nullable|string|max:255',
            'slope_angle'              => 'nullable|string|max:255',
            'has_stone_climbing'       => 'required|boolean',
            'has_ice_climbing'         => 'required|boolean',
            'average_backpack_weight'  => 'nullable|numeric',
            'required_skills'          => 'nullable|array',
            'vegetation'               => 'nullable|string',
            'wildlife'                 => 'nullable|string',
            'weather'                  => 'nullable|string',
            'wind_speed'               => 'nullable|numeric',
            'temperature'              => 'nullable|numeric',
            'local_language'           => 'nullable|string|max:255',
            'historical_sites'         => 'nullable|string',
            'important_notes'          => 'nullable|string',
            'route_points'             => 'nullable|array',
            'execution_schedule'       => 'nullable|array',
            'participant_count'        => 'nullable|integer|min:1',
            'guests'                   => 'nullable|array',
            'member_ids'               => 'nullable|array',
            'track_file'               => 'nullable|file|mimes:gpx,kml,kmz|max:5120',
            'gallery'                  => 'nullable|array|max:10',
            'gallery.*'                => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'full_report'              => 'nullable|string',
        ]);

        // آماده‌سازی داده‌ها برای ذخیره
        $data = $validated;
        $data['author_id'] = Auth::id();

        // آپلود فایل کروکی
        if ($request->hasFile('track_file')) {
            $data['track_url'] = $request->file('track_file')->store('reports/tracks', 'public');
        }

        // آپلود تصاویر گالری
        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $photo) {
                $galleryPaths[] = $photo->store('reports/gallery', 'public');
            }
            $data['gallery'] = json_encode($galleryPaths);
        }

        // تبدیل آرایه‌ها به رشته JSON
        if (isset($data['road_type'])) {
            $data['road_type'] = json_encode($data['road_type']);
        }
        if (isset($data['transportation'])) {
            $data['transportation'] = json_encode($data['transportation']);
        }
        if (isset($data['water_type'])) {
            $data['water_type'] = json_encode($data['water_type']);
        }
        if (isset($data['required_equipment'])) {
            $data['required_equipment'] = json_encode($data['required_equipment']);
        }
        if (isset($data['required_skills'])) {
            $data['required_skills'] = json_encode($data['required_skills']);
        }
        if (isset($data['route_points'])) {
            $data['route_points'] = json_encode($data['route_points']);
        }
        if (isset($data['execution_schedule'])) {
            $data['execution_schedule'] = json_encode($data['execution_schedule']);
        }
        if (isset($data['guests'])) {
            $data['guests'] = json_encode($data['guests']);
        }
        if (isset($data['member_ids'])) {
            $data['member_ids'] = json_encode($data['member_ids']);
        }

        // ثبت گزارش
        Report::create($data);

        return redirect()->route('dashboard')->with('success', 'گزارش شما با موفقیت ثبت شد.');
    }
}
