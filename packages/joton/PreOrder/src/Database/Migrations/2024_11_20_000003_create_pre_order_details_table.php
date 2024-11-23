<?php

namespace Joton\PreOrder\Database\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pre_order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pre_order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->double('unit_price');
            $table->double('total_price');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by_id')->nullable();


            // Foreign key constraint
            $table->foreign('deleted_by_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('pre_order_id')
                ->references('id')
                ->on('pre_orders')
                ->onDelete('cascade');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pre_order_details');
    }
};
