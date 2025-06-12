<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_program_participations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('program_id')->nullable(); // اگر لینک داشت
            $table->string('program_name');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('leader_name')->nullable();
            $table->string('co_leader_name')->nullable();
            $table->string('technical_leader_name')->nullable();
            $table->string('support_name')->nullable();
            $table->string('guide_name')->nullable();

            $table->timestamps();

            $table->foreign('program_id')->references('id')->on('programs')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_program_participations');
    }
};
