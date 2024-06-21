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
        Schema::create('solicitudes', function (Blueprint $table) {
            $table->id();
            $table->integer('id_cliente');
            $table->integer('id_service');
            $table->string('status');
            $table->string('ip')->nullable();
            $table->string('id_employee')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('solicitudes');
    }
};
