<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->unsignedInteger('payment_method_id')->references('id')->on('payment_methods');
            $table->string('status')->default('Pendiente');
            $table->string('reference');
            $table->float('amount_bs');
            $table->float('amount_dollar');
            $table->unsignedInteger('user_id_approve')
                ->references('id')
                ->on('users')
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('payments');
    }
};
