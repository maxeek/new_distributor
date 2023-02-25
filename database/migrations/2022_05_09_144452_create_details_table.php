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
        Schema::create('details', function (Blueprint $table) {
            $table->id();



            $table->foreignId('order_id')
                ->nullable()
                ->constrained('orders')
                ->cascadeOnDelete()
                ->nullOnDelete();


            $table->foreignId('product_id')
                ->nullable()
                ->constrained('products')
                ->cascadeOnDelete()
                ->nullOnDelete();

            $table->unsignedBigInteger('product_variant');

            $table->integer('qty');
            $table->double('up');
            $table->double('amount');


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
        Schema::dropIfExists('details');
    }
};
