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
        Schema::create('client_services', function (Blueprint $table) {
            $table->id();
            $table->string('id_cliente');
            $table->string('id_service');
            $table->string('id_employee')->nullable();
            $table->string('date_active')->nullable();
            $table->string('date_finish')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('client_services');
    }
};
