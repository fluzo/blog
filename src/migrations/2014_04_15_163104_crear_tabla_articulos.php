<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaArticulos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('articulos', function(Blueprint $table)
		{
			$table->increments('id');
                        $table->string('titulo',300);
                        $table->text('cuerpo');
                        $table->string('slug',350);
                        $table->string('meta_description',300);
                        $table->integer('categoria_id')->unsigned();
                        $table->foreign('categoria_id')->references('id')->on('categorias');
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
		Schema::drop('articulos');
	}

}
