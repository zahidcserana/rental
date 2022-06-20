<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('house_id')->unsigned()->index()->nullable();
            $table->bigInteger('customer_id')->unsigned()->index()->nullable();
            $table->string('number')->nullable();
            $table->date('date')->nullable();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('additional_cost', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->decimal('paid', 12, 2)->default(0);
            $table->string('status', 50)->default('pending');
            $table->string('comments')->nullable();

            $table->timestamps();

            $table->softDeletes('deleted_at', 0);

            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
