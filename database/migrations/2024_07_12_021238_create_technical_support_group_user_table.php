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
        Schema::create('technical_support_group_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('technical_support_group_id');
            $table->unsignedBiginteger('user_id');

            $table->foreign('technical_support_group_id')->references('id')
                 ->on('technical_support_groups')->onDelete('cascade');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_support_group_user');
    }
};
