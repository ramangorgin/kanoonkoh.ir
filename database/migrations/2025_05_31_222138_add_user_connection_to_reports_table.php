<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserConnectionToReportsTable extends Migration
{
    public function up()
    {
        Schema::table('reports', function (Blueprint $table) {
            // فقط writer_name رو اضافه می‌کنیم چون user_id از قبل وجود دارد
            $table->string('writer_name')->nullable()->after('pdf_path');
        });
    }

    public function down()
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('writer_name');
        });
    }
}
