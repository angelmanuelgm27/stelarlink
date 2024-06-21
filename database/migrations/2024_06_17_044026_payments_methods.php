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
        Schema::create('payments_methods', function (Blueprint $table) {
            $table->id();
            $table->string('platform_name');
            $table->string('account_bank_property');
            $table->string('account_property');
            $table->string('bank_name');
            $table->string('email_account_property');
            $table->string('dni');
            $table->string('details');
            $table->string('enabled');
            $table->string('imagen');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('payments_methods');
    }
};
