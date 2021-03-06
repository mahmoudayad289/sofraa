<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('description');
			$table->string('photo')->nullable();
			$table->double('price');
			$table->double('price_offer');
			$table->integer('restaurant_id');
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
