<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordersdetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('product_id');
            $table->string('quantity');
            $table->string('unitcost');
            $table->string('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordersdetails');
    }
};
