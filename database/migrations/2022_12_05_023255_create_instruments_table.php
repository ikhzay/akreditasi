<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ak_instrument', function (Blueprint $table) {
            $table->id();
            $table->integer('kriteria_id');
            $table->string('jenis');
            $table->integer('no_urut');
            $table->integer('no_butir');
            $table->decimal('bobot');
            $table->text('element');
            $table->text('descriptor');
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
        Schema::dropIfExists('instruments');
    }
}
