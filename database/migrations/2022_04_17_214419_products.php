<?php

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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('unit');
            $table->string('brand');
            $table->integer('barcode')->nullable();
            $table->float('price_per_unite');
            $table->boolean('offer');
            $table->float('offer_mrp')->nullable();
            $table->date('expire_date')->nullable();
            $table->text('description')->nullable();
            $table->float('quantity')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('products');
    }
};
