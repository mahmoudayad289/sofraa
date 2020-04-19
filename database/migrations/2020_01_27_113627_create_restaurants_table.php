<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestaurantsTable extends Migration {

	public function up()
	{
		Schema::create('restaurants', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('name');
			$table->string('email');
			$table->string('image')->nullable();
			$table->string('phone')->unique();
			$table->integer('delivery_charge');
			$table->double('minimum_order');
            $table->integer('district_id');
            $table->string('password');
            $table->boolean('state')->default(1);
            $table->string('api_token')->nullable();
            $table->string('pin_code')->nullable();
		});
	}

	public function down()
	{
		Schema::drop('restaurants');
	}
}
