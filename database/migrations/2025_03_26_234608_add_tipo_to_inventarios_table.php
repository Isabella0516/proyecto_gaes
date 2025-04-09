<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->enum('tipo', ['inventario', 'stock'])->default('inventario');
        });
    }
    
    public function down()
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->dropColumn('tipo');
        });
    }
    
};
