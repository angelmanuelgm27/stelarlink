<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('price');
            $table->unsignedInteger('velocity_load');
            $table->unsignedInteger('velocity_download');
            $table->string('image');
            $table->boolean('status');
            $table->timestamps();
        });

        DB::table('services')->insert([
            [
                'name' => 'Estrella',
                'price' => 20,
                'velocity_load' => 5,
                'velocity_download' => 10,
                'image' => '6.png',
                'status' => 1
            ],
            [
                'name' => 'Galaxya',
                'price' => 30,
                'velocity_load' => 7,
                'velocity_download' => 15,
                'image' => '8.png',
                'status' => 1
            ],
            [
                'name' => 'Nebulosa',
                'price' => 40,
                'velocity_load' => 10,
                'velocity_download' => 20,
                'image' => '8.png',
                'status' => 1
            ],
            [
                'name' => 'Cosmo',
                'price' => 50,
                'velocity_load' => 12,
                'velocity_download' => 25,
                'image' => '8.png',
                'status' => 1
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('services');
    }
};
