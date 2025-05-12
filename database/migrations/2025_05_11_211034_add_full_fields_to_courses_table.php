<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            // مشخصات تکمیلی دوره
            $table->string('slug')->unique()->nullable()->after('title');
            $table->text('description')->nullable();
            $table->string('instructor')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->time('start_time')->nullable();
            $table->time('end_time')->nullable();

            // مکان و نقشه
            $table->string('location_name')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lon', 10, 7)->nullable();

            // ظرفیت و وضعیت
            $table->unsignedInteger('capacity')->nullable();
            $table->boolean('is_registration_open')->default(true);
            $table->enum('status', ['پیش‌رو', 'برگزار شده', 'لغو شده'])->default('پیش‌رو');

            // هزینه‌ها
            $table->unsignedInteger('member_cost')->nullable();
            $table->unsignedInteger('guest_cost')->nullable();

            // اطلاعات بانکی
            $table->string('card_number')->nullable();
            $table->string('sheba_number')->nullable();
            $table->string('card_holder')->nullable();
            $table->string('bank_name')->nullable();

            // سایر
            $table->text('requirements')->nullable();
            $table->text('notes_for_participants')->nullable();
            $table->string('cover_image')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('courses', function (Blueprint $table) {
            $table->dropColumn([
                'slug', 'description', 'instructor', 'start_date', 'end_date',
                'start_time', 'end_time', 'location_name', 'lat', 'lon',
                'capacity', 'is_registration_open', 'status',
                'member_cost', 'guest_cost', 'card_number', 'sheba_number',
                'card_holder', 'bank_name', 'requirements',
                'notes_for_participants', 'cover_image'
            ]);
        });
    }
};
