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
        Schema::create('finisheds', function (Blueprint $table) {

            $table->id();

            $table->unsignedInteger('finishedable_id');
            $table->string('finishedable_type');

            $table->unsignedInteger('payment_amount')->nullable();
            $table->timestamp('paid')->nullable();

            $table->unsignedInteger('user_id')
                ->references('id')
                ->on('users');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('finisheds');
    }
};
