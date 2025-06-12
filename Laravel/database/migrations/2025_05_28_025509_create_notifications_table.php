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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // به کاربر خاص مربوطه
            $table->string('title')->nullable();          // عنوان اعلان (اختیاری)
            $table->text('message');                      // متن اعلان
            $table->string('icon')->nullable();           // آیکون (اختیاری، مثلا `bi-check-circle`)
            $table->boolean('is_read')->default(false);   // آیا دیده شده؟
            $table->timestamps();                         // created_at و updated_at
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
};
