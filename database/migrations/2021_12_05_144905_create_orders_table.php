<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->foreignId('cargo_type_id')->constrained();
            $table->unsignedBigInteger('cargo_weight');
            $table->foreignId('city_from_id')->constrained('cities');
            $table->foreignId('city_to_id')->constrained('cities');
            $table->foreignId('vehicle_type_id')->constrained();
            $table->foreignId('client_id')->constrained('users');
            $table->foreignId('driver_id')->nullable()->constrained('users');
            $table->unsignedBigInteger('price');
            $table->dateTime('start_date');
            $table->dateTime('due_date');
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
        Schema::dropIfExists('orders');
    }
}
