<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            // تغییر فیلدهای موجود
            $table->text('content')->nullable()->change();
            $table->renameColumn('photos', 'gallery');
            
            // اضافه کردن فیلدهای جدید
            $table->string('type')->nullable()->after('content');
            $table->string('area')->nullable();
            $table->string('peak_name')->nullable();
            $table->integer('peak_height')->nullable();
            $table->integer('start_altitude')->nullable();
            $table->string('duration')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            $table->string('technical_level')->nullable();
            $table->string('road_type')->nullable();
            $table->json('transportation')->nullable();
            $table->json('water_type')->nullable();
            $table->boolean('signal_status')->default(false);
            $table->json('required_equipment')->nullable();
            $table->json('required_skills')->nullable();
            $table->string('difficulty')->nullable();
            $table->string('slope_angle')->nullable();
            $table->boolean('has_stone_climbing')->default(false);
            $table->boolean('has_ice_climbing')->default(false);
            $table->string('average_backpack_weight')->nullable();
            
            $table->text('natural_description')->nullable();
            $table->string('weather')->nullable();
            $table->string('wind_speed')->nullable();
            $table->string('temperature')->nullable();
            $table->string('vegetation')->nullable();
            $table->string('wildlife')->nullable();
            $table->string('local_language')->nullable();
            $table->string('historical_sites')->nullable();
            $table->text('important_notes')->nullable();
            $table->string('food_availability')->nullable();
            
            $table->json('route_points')->nullable();
            $table->json('execution_schedule')->nullable();
            $table->text('full_report')->nullable();
            $table->string('pdf_path')->nullable();
            
            // فیلدهای مسئولین
            $table->foreignId('leader_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('assistant_leader_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('technical_manager_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('guide_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('support_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            // برگرداندن تغییرات در صورت نیاز
            $table->text('content')->nullable(false)->change();
            $table->renameColumn('gallery', 'photos');
            
            $table->dropColumn([
                'type', 'area', 'peak_name', 'peak_height', 'start_altitude', 'duration',
                'start_date', 'end_date', 'technical_level', 'road_type', 'transportation',
                'water_type', 'signal_status', 'required_equipment', 'required_skills',
                'difficulty', 'slope_angle', 'has_stone_climbing', 'has_ice_climbing',
                'average_backpack_weight', 'natural_description', 'weather', 'wind_speed',
                'temperature', 'vegetation', 'wildlife', 'local_language', 'historical_sites',
                'important_notes', 'food_availability', 'route_points', 'execution_schedule',
                'full_report', 'pdf_path', 'leader_id', 'assistant_leader_id',
                'technical_manager_id', 'guide_id', 'support_id'
            ]);
        });
    }
};