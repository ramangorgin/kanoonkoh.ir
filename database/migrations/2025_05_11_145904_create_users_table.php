<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
    
            // مشخصات هویتی
            $table->string('first_name');
            $table->string('last_name');
            $table->string('father_name');
            $table->string('national_id')->unique();
            $table->date('birth_date');
            $table->enum('gender', ['male', 'female', 'other']);
    
            // اطلاعات تماس
            $table->string('mobile')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('province');
            $table->string('city');
            $table->string('address');
            $table->string('postal_code');
    
            // تماس اضطراری
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_phone');
            $table->string('emergency_contact_relation');
    
            // سلامت و ایمنی
            $table->string('blood_type')->nullable();
            $table->text('health_conditions')->nullable();
            $table->text('allergies')->nullable();
    
            // بیمه ورزشی
            $table->string('insurance_number')->nullable();
            $table->string('insurance_file')->nullable();
            $table->date('insurance_issue_date')->nullable();
            $table->date('insurance_expiration_date')->nullable();
    
            // اطلاعات فنی و ورزشی
            $table->enum('experience_level', ['beginner', 'intermediate', 'advanced']);
            $table->json('personal_equipment')->nullable(); // لیست تجهیزات
            $table->json('completed_courses')->nullable();  // لیست دوره‌ها
    
            // عضویت باشگاه
            $table->date('membership_start_date')->nullable();
            $table->enum('membership_status', ['active', 'inactive', 'suspended']);
            $table->enum('membership_type', [
                'آزمایشی',
                'رسمی درجه ۳',
                'رسمی درجه ۲',
                'رسمی درجه ۱',
                'پایدار',
                'افتخاری'
            ]);
            $table->integer('points')->default(0);
            $table->date('membership_expiration')->nullable();
    
            // مدارک
            $table->string('id_card_scan')->nullable();
            $table->string('profile_photo')->nullable();
    
            // سیستم
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    
    

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
