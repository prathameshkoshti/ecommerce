<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWishlistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlists', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id');
			$table->integer('user_id');
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
        Schema::dropIfExists('wishlists');
    }
}
