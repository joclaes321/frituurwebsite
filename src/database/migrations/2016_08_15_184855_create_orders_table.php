<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create orders table
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->boolean('order_in_progress')->default(true);
            $table->timestamps();

            // Foreign keys
//            $table->foreign('user_id')->references('id')->on('users')
//                ->onDelete('cascade');
        });

        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50)->unique();
            $table->timestamps();
        });

        // Create products table
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->string('name', 50);
            $table->decimal('price', 12, 4);
            $table->timestamps();

            // Foreign keys
//            $table->foreign('type_id')->references('id')->on('product_types')
//                ->onDelete('cascade');
        });

        // Create toppings table
        Schema::create('toppings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->decimal('price', 4, 2);
            $table->timestamps();
        });

        // Create product topping table
        Schema::create('product_toppings', function (Blueprint $table) {
            $table->integer('product_id');
            $table->integer('topping_id');
            $table->timestamps();

            $table->primary(['product_id', 'topping_id']);
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
//            $table->foreign('topping_id')->references('id')->on('toppings')->onDelete('cascade');
        });

        // Create order line table
        Schema::create('order_lines', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('topping_id')->nullable();
            $table->integer('quantity');
            $table->decimal('price', 14, 2);
            $table->timestamps();

            // Foreign keys
//            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
//            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
//            $table->foreign('topping_id')->references('id')->on('toppings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('order_lines');
        Schema::drop('product_toppings');
        Schema::drop('toppings');
        Schema::drop('products');
        Schema::drop('product_types');
        Schema::drop('orders');
    }
}
