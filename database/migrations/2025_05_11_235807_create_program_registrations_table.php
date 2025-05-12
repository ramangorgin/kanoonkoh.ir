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
        Schema::create('program_registrations', function (Blueprint $table) {
            $table->id();
        
            $table->foreignId('program_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
        
            $table->string('guest_name')->nullable();
            $table->string('guest_phone')->nullable();
            $table->string('guest_national_id')->nullable();
        
            $table->string('pickup_location')->nullable();
            $table->string('transaction_code')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        
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
        Schema::dropIfExists('program_registrations');
    }
};
