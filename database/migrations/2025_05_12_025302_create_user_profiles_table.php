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
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            $table->string('father_name')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('national_id')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('mobile')->nullable();
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('postal_code')->nullable();
        
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_relation')->nullable();
        
            $table->string('insurance_number')->nullable();
            $table->date('insurance_issue_date')->nullable();
            $table->date('insurance_expiration_date')->nullable();
            $table->string('insurance_file')->nullable();
        
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->string('health_conditions')->nullable();
            $table->string('allergies')->nullable();
        
            $table->enum('experience_level', ['beginner', 'intermediate', 'advanced'])->nullable();
            $table->json('personal_equipment')->nullable();
            $table->json('completed_courses')->nullable();
        
            $table->string('id_card_scan')->nullable();
            $table->string('profile_photo')->nullable();
        
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
        Schema::dropIfExists('user_profiles');
    }
};
