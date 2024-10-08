<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {

            $table->id();

            $table->string('path');
            $table->string('name');
            $table->unsignedInteger('user_id')->references('id')->on('users')->nullable();
            $table->unsignedInteger('fileable_id');
            $table->string('fileable_type');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
