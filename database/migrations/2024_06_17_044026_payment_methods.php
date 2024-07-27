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

        Schema::create('payment_methods', function (Blueprint $table) {

            $table->id();

            $table->string('name');
            $table->text('details')->nullable();
            $table->boolean('enabled')->default(true);
            $table->string('image');

            $table->timestamps();
        });

        DB::table('payment_methods')->insert([
            [
                'name' => 'Transferencia Banco Mercantil',
                'details' => 'Detalles',
                'enabled' => true,
                'image' => 'payment-methods/Uy42xp8gLUqIdGD19oCcWrYGgHk7rQ9UGpHjNS0L.png',
            ],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }

};
