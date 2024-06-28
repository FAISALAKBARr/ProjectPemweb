<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->string('role')->default('user'); // Menambahkan kolom role dengan default 'user'
        $table->boolean('blocked')->default(false); // Menambahkan kolom blocked dengan default false
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('role');
        $table->dropColumn('blocked');
    });
}

};
