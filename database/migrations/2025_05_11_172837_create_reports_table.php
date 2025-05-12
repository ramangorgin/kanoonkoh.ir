<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            // ارتباط با برنامه
            $table->foreignId('program_id')->nullable()->constrained('programs')->nullOnDelete();

            // نویسنده (درصورتی که وجود داشته باشد)
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('title');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('type');
            $table->string('area');
            $table->string('peak_name')->nullable();
            $table->integer('peak_height')->nullable();
            $table->integer('start_altitude')->nullable();
            $table->string('duration')->nullable();

            // سرپرست و مسئولان
            $table->foreignId('leader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('assistant_leader_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('technical_manager_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('support_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('guide_id')->nullable()->constrained('users')->nullOnDelete();

            // ویژگی‌های فنی
            $table->enum('technical_level', ['عمومی', 'تخصصی'])->default('عمومی');
            $table->string('road_type')->nullable();
            $table->json('transportation')->nullable();
            $table->json('water_type')->nullable();
            $table->boolean('signal_status')->default(false);

            // مهارت و تجهیزات
            $table->json('required_equipment')->nullable();
            $table->json('required_skills')->nullable();
            $table->string('difficulty')->nullable();
            $table->string('slope_angle')->nullable();
            $table->boolean('has_stone_climbing')->default(false);
            $table->boolean('has_ice_climbing')->default(false);
            $table->string('average_backpack_weight')->nullable();

            // طبیعت و آب و هوا
            $table->text('natural_description')->nullable();
            $table->text('weather')->nullable();
            $table->integer('wind_speed')->nullable();
            $table->integer('temperature')->nullable();
            $table->string('vegetation')->nullable();
            $table->string('wildlife')->nullable();
            $table->string('local_language')->nullable();
            $table->text('historical_sites')->nullable();
            $table->text('important_notes')->nullable();
            $table->string('food_availability')->nullable();

            // مسیر و زمانبندی
            $table->json('route_points')->nullable();
            $table->json('execution_schedule')->nullable();

            // فایل‌ها
            $table->string('cover_image')->nullable();
            $table->string('pdf_path')->nullable();
            $table->string('track_file')->nullable();
            $table->json('gallery')->nullable();

            // شرکت‌کنندگان
            $table->integer('participant_count')->nullable();
            $table->json('guests')->nullable();
            $table->json('member_ids')->nullable();

            // متن گزارش
            $table->longText('full_report')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
