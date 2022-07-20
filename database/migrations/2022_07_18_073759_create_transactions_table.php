<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('business_id')->constrained();
            $table->foreignId('location_id')->constrained();
            $table->foreignId('supplier_id')->constrained();
            $table->text('purchase_order_ids')->nullable();
            $table->string('reference_no')->nullable();

            $table->enum('type', ['purchase', 'sell']);
            $table->enum('payment_status', ['paid', 'due']);
            $table->enum('status', ['received', 'pending', 'ordered', 'draft', 'final']);


            $table->foreignId('tax_id')->constrained();
            $table->decimal('tax_amount', 22, 2)->default(0);

            $table->enum('discount_type', ['fixed', 'percentage'])->nullable();
            $table->decimal('discount_amount', 22, 2)->default(0);

            $table->string('shipping_details')->nullable();
            $table->decimal('shipping_charges', 22, 2)->default(0);

            $table->decimal('total_before_tax', 22, 2)->default(0);
            $table->decimal('final_total', 22, 2)->default(0);

            $table->text('additional_notes')->nullable();
            $table->string('document')->nullable();

            $table->foreignId('created_by')->constrained('users', 'id');
            $table->timestamp('transaction_date');
            $table->timestamps();

            //Indexing
            $table->index('location_id');
            $table->index('supplier_id');
            $table->index('type');
            $table->index('transaction_date');
            $table->index('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
