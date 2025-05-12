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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'father_name', 'birth_date', 'national_id', 'gender', 'mobile', 'province',
                'city', 'address', 'postal_code', 'emergency_contact_name', 'emergency_contact_phone',
                'emergency_contact_relation', 'insurance_issue_date',
                'insurance_expiration_date', 'insurance_file', 'blood_type', 'health_conditions',
                'allergies', 'experience_level', 'personal_equipment', 'completed_courses',
                'id_card_scan', 'profile_photo'
            ]);
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
