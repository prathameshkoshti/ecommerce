<?php

use Illuminate\Support\Facades\Schema;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id');
            $table->integer('user_id');
            $table->integer('shipping_id');
            $table->integer('quantity');
            $table->integer('size');
            $table->float('price', 8, 2);
			$table->date('order_date');
			$table->tinyInteger('delivery_status')->comment('0 => Confirmed, 1 => Dispatched, 2 => Delivered, 3 => Cancelled')->default(0);
            $table->string('cancellation_reason')->nullable();
            $table->date('action_date')->nullable();
			$table->tinyInteger('status')->comment('0 => Inactive, 1 => Active')->default(1);
            $table->timestamp('created_at')->nullable()->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->integer('created_by')->nullable();
            $table->timestamp('updated_at')->nullable()->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
