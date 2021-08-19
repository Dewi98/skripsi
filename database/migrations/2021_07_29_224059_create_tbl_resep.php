<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTblResep extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_resep', function (Blueprint $table) {
            $table->string('id_resep', 20)->primary();
            $table->string('nama_masakan', 20);
            $table->string('bahan_masakan', 20);
                
            $table->index('id_resep')
                ->references('id_resep')
                ->on('tbl_resep')
                ->onUpdate('cascade');
                
            $table->double('nama_masakan');
            $table->integer('bahan_masakan');
            $table->integer('stok_barang')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_resep');
    }
}
