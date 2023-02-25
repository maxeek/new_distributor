<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table
                ->foreignId('category_id')
                ->nullable()
                ->constrained('categories')
                ->cascadeOnDelete()
                ->nullOnDelete();

            $table
                ->foreignId('subcategory_id')
                ->nullable()
                ->constrained('categories')
                ->cascadeOnDelete()
                ->nullOnDelete();

            $table->unsignedBigInteger('variation')->default(1);

            $table->string('barcode', 45)->unique();
            $table->string('sku', 45)->nullable();
            $table->string('title');
            $table->longText('detail')->nullable();
            $table->double('price')->nullable();
            $table->double('sale_price')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('alert')->nullable();
            $table->longText('img')->nullable();
            $table->tinyInteger('order')->nullable();

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
