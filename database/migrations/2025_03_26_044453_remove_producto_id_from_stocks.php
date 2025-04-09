<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropForeign(['producto_id']); // Elimina la clave foránea si existe
            $table->dropColumn('producto_id'); // Elimina la columna
        });
    }

    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->unsignedBigInteger('producto_id')->nullable();
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
        });
    }
};
