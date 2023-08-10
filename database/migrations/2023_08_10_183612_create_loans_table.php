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
        Schema::create('loans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->uuid('invoice_id')->nullable();
            $table->string('account');
            $table->float('value');
            $table->float('rates')->nullable();
            $table->float('billing')->nullable();
            $table->timestamp('finalized_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')
                ->on('invoices')->onDelete('restrict')
                ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loans');
    }
};