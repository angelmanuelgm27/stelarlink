<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('installation_services', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->integer('price');
            $table->string('description');
            $table->string('image');
            $table->boolean('status');
            $table->timestamps();
        });

        DB::table('installation_services')->insert([
            [
                'name' => 'Apolo',
                'category' => 'Reconexión',
                'price' => 50,
                'description' => '10 metros de cable + Activación de servicio. ',
                'image' => 'icon-apolo.png',
                'status' => 1
            ],
            [
                'name' => 'Tierra',
                'category' => 'Familiar',
                'price' => 150,
                'description' => ' M5 Gen 2, Routers + 10 metros de cable.',
                'image' => 'icon-tierra.png',
                'status' => 1
            ],
            [
                'name' => 'Tierra Plus',
                'category' => 'Familiar respaldo',
                'price' => 180,
                'description' => ' M5 Gen 2, Routers + 10 metros de cable + Ups 10-8 Horas',
                'image' => 'icon-tierra-plus.png',
                'status' => 1
            ],
            [
                'name' => 'Luna',
                'category' => 'Comercial red privada',
                'price' => 200,
                'description' => ' M5 Gen 2, Routers 5G + cable ',
                'image' => 'icon-luna.png',
                'status' => 1
            ]
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('installation_services');
    }
};
