<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Report extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    protected $fillable = [
        'title',
        'slug',
        'program_id',
        'author_id',
        'start_date',
        'end_date',
        'type',
        'area',
        'peak_name',
        'peak_height',
        'start_altitude',
        'duration',
        'leader_id',
        'assistant_leader_id',
        'technical_manager_id',
        'support_id',
        'guide_id',
        'technical_level',
        'road_type',
        'transportation',
        'water_type',
        'signal_status',
        'required_equipment',
        'required_skills',
        'difficulty',
        'slope_angle',
        'has_stone_climbing',
        'has_ice_climbing',
        'average_backpack_weight',
        'natural_description',
        'weather',
        'wind_speed',
        'temperature',
        'vegetation',
        'wildlife',
        'local_language',
        'historical_sites',
        'important_notes',
        'food_availability',
        'route_points',
        'execution_schedule',
        'cover_image',
        'pdf_path',
        'track_file',
        'gallery',
        'participant_count',
        'guests',
        'member_ids',
        'full_report',
    ];
    

}