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
        Schema::create('coordinates', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('latitude');
            $table->string('longitude');
            $table->text('iframe');
            $table->timestamps();
        });

        DB::table('coordinates')->insert([
            [
                'latitude' => "10.4945137",
                'longitude' => "-66.8825502",
                'name' => 'City market',
                'iframe' => "google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.078046755879!2d-66.88255015419013!3d10.49451373771388!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a58e0235ab00b%3A0x8c6562974eeca228!2sCC%20CITY%20MARKET%20C.A.!5e0!3m2!1ses!2sdo!4v1713726087315!5m2!1ses!2sdo"
            ],
            [
                'latitude' => "10.4952363",
                'longitude' => "-66.8353223",
                'name' => 'C.C Millennium Mall',
                'iframe' => "google.com/maps/embed?pb=!1m18!1m12!1m3!1d3923.068882278651!2d-66.83532228913639!3d10.495236264273688!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8c2a59b592dbc231%3A0xff82b8b62b74da19!2sC.%20C.%20Millennium!5e0!3m2!1ses!2sdo!4v1713726429441!5m2!1ses!2sdo"
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('coordinates');
    }
};
