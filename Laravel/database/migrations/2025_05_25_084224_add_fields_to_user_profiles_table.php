<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // نقش کاربری
            $table->enum('role', ['member', 'admin'])->default('member');

            // اطلاعات عضویت
            $table->date('membership_date')->nullable();
            $table->enum('membership_level', [
                'آزمایشی',
                'عضو رسمی پایه ۳',
                'عضو رسمی پایه ۲',
                'عضو رسمی پایه ۱',
                'عضو پایدار',
                'عضو افتخاری',
            ])->nullable();
            $table->enum('membership_status', ['فعال', 'معلق', 'لغو شده'])->default('فعال');
            $table->unsignedInteger('points')->default(0);

            // اطلاعات پزشکی
            $table->unsignedSmallInteger('height_cm')->nullable();
            $table->unsignedSmallInteger('weight_kg')->nullable();
            $table->text('medical_conditions')->nullable();
            $table->text('allergies')->nullable();

            // اطلاعات عمومی
            $table->string('job')->nullable();
            $table->string('referrer')->nullable();
            $table->string('blood_type')->nullable();
            $table->boolean('had_surgery')->default(false);
            $table->text('medications')->nullable();

            // تماس اضطراری
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relation')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'role',
                'membership_date',
                'membership_level',
                'membership_status',
                'points',
                'height_cm',
                'weight_kg',
                'medical_conditions',
                'allergies',
                'job',
                'referrer',
                'blood_type',
                'had_surgery',
                'medications',
                'emergency_contact_name',
                'emergency_contact_relation',
            ]);
        });
    }
};
