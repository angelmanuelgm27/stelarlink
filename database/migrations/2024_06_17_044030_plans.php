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
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id')->references('id')->on('users');
            $table->unsignedInteger('service_id')->references('id')->on('services');
            $table->string('status');
            $table->string('ip')->nullable();
            $table->string('adrress');
            $table->string('latitude');
            $table->string('longitude');
            $table->unsignedInteger('technical_support_group_id')->references('id')->on('technical_support_groups')->nullable();
            $table->unsignedInteger('zone_id')->references('id')->on('zones')->nullable();
            $table->unsignedInteger('invoice_id')->references('id')->on('invoices');
            $table->timestamp('instalation_date')->nullable();
            $table->timestamp('renovation_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('plans');
    }
};
