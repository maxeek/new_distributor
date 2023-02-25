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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            $table

                ->foreignId('condition_id')
                ->nullable()
                ->constrained('conditions')
                ->cascadeOnDelete()
                ->nullOnDelete();

            $table
                ->foreignId('city_id')
                ->nullable()
                ->constrained('cities')
                ->cascadeOnDelete()
                ->nullOnDelete();

            $table->string('cuit', 11)->unique();
            $table->string('business_name', 45);
            $table->string('surname', 45)->nullable();
            $table->string('name', 45)->nullable();
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();

            $table->string('email')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
        Schema::dropIfExists('clients');
    }
};
