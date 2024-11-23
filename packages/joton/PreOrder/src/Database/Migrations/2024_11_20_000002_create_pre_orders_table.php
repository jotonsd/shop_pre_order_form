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
        Schema::create('pre_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->index();
            $table->string('phone')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('deleted_by_id')->nullable();


            // Foreign key constraint
            $table->foreign('deleted_by_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        // Adding a composite index for name and email
        Schema::table('pre_orders', function (Blueprint $table) {
            $table->index(['name', 'email'], 'name_email_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pre_orders', function (Blueprint $table) {
            $table->dropIndex('name_email_index'); // Dropping the composite index
        });

        Schema::dropIfExists('pre_orders');
    }
};
