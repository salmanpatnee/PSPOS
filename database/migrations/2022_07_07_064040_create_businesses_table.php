<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('currency_id')->default(91)->nullable(); // 91 => PKR
            $table->foreignId('user_id')->constrained();
            $table->enum('currency_symbol_placement', ['before', 'after'])->default('before')->nullable();
            $table->string('tax_number', 100)->nullable();
            $table->string('logo')->nullable();
            $table->text('email_settings')->nullable();
            $table->text('sms_settings')->nullable();
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
        Schema::dropIfExists('businesses');
    }
}
