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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
    
            $table->string('subject');
            $table->enum('department', [
                'کارگروه فرهنگی',
                'کارگروه محیط‌زیست',
                'کارگروه طبیعت‌گردی',
                'کارگروه روابط عمومی',
                'کارگروه اداری',
                'کارگروه فنی و آموزشی'
            ]);
            $table->text('message');
            $table->string('attachment')->nullable();
            $table->enum('status', ['open', 'answered', 'closed'])->default('open');
    
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
        Schema::dropIfExists('tickets');
    }
};
