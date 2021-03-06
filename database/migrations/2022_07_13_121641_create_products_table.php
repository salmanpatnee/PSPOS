<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
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
            $table->foreignId('category_id')->constrained();
            $table->foreignId('brand_id')->nullable()->constrained();
            $table->string('product_id')->unique()->index();
            $table->string('sku')->nullable();
            $table->string('name')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->float('vat', 22, 2)->default(0)->nullable();
            $table->integer('units_sold')->default(0)->nullable();
            $table->integer('stock_threshold')->default(0)->nullable();
            $table->double('default_purchase_price', 9, 0)->default(0)->nullable();
            $table->double('default_selling_price', 9, 0)->default(0)->nullable();
            // $table->integer('quantity')->default(0)->nullable();
            $table->boolean('status')->default(1)->nullable();
            $table->foreignId('created_by')->constrained('users');
            $table->foreignId('updated_by')->nullable()->constrained('users');
            $table->softDeletes();
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
}
