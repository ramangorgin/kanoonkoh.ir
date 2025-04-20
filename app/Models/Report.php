<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Report extends Model
{
    use HasFactory;

    protected $fillable = [
        'program_id', 'author_id', 'title', 'date', 'type', 'area',
        'peak_name', 'duration', 'leader_id', 'assistant_leader_id',
        'technical_manager_id', 'support_id', 'guide_id', 'technical_level',
        'peak_height', 'start_altitude', 'start_location', 'road_type',
        'transportation', 'water_type', 'signal_status', 'guide_name',
        'required_equipment', 'difficulty', 'slope_angle', 'has_stone_climbing',
        'has_ice_climbing', 'average_backpack_weight', 'required_skills',
        'natural_description', 'weather', 'route_points', 'execution_schedule',
        'cover_image', 'pdf_path', 'track_url', 'participant_count',
        'full_report',
    ];

    protected $casts = [
        'signal_status' => 'boolean',
        'has_stone_climbing' => 'boolean',
        'has_ice_climbing' => 'boolean',
        'route_points' => 'array',
        'execution_schedule' => 'array',
        'date' => 'date',
    ];

    public function participants()
    {
        return $this->belongsToMany(User::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }
}
