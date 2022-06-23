<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->string('email')->unique()->index();
            $table->string('phone')->unique()->nullable();
            $table->string('mobile')->unique()->index();
            $table->string('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->double('previous_balance', 8, 2)->nullable()->default(0.00);
            $table->double('total_purchases', 8, 2)->nullable()->default(0.00);
            $table->timestamp('last_purchase')->nullable();
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
        Schema::dropIfExists('customers');
    }
}
