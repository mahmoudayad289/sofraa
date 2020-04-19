<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOrdersTable extends Migration {

	public function up()
	{
		Schema::create('orders', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->integer('restaurant_id');
			$table->integer('client_id');
			$table->integer('amount')->default('1');
			$table->string('notes')->nullable();
			$table->string('address');
			$table->string('spacial_order')->nullable();
			$table->enum('payment_method', array('online', 'cash'));
            $table->enum('statue', array('pending', 'accepted', 'rejected', 'delivered', 'deleted'));
            $table->double('cost')->default('0');
            $table->double('delivery_cost')->default('0');
            $table->double('total')->default('0');
            $table->double('commission')->default('0');
			$table->double('rest')->default('0');
		});
	}

	public function down()
	{
		Schema::drop('orders');
	}
}
