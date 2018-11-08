<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemReferenciaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_referencia', function (Blueprint $table) {
            $table->increments('id');
            $table->string('descricao');
            $table->date('data');
            $table->decimal('valor');
            $table->enum('tipo_evento', ['credito', 'debito']);
            $table->text('observacao')->nullable();
            $table->unsignedInteger('referencia_id');
            $table->unsignedInteger('evento_id');

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
        Schema::dropIfExists('referencia_item');
    }
}
