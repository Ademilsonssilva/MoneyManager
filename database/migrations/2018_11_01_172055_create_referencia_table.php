<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referencia', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('mes');
            $table->integer('ano');
            $table->decimal('valor_credito')->nullable();
            $table->decimal('valor_debito')->nullable();
            $table->decimal('valor_liquido')->nullable();
            $table->boolean('finalizado')->nullable();
            $table->date('data_finalizado')->nullable();
            $table->text('observacao')->nullable();
            $table->unsignedInteger('user_id');
            
            $table->unique(['user_id', 'mes', 'ano']);
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('restrict');
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
        Schema::dropIfExists('referencia');
    }
}
