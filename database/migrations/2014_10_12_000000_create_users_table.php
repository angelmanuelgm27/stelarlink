<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('address');
            $table->string('phone');
            $table->string('dni')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('rol');
            $table->string('avatar')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin',
                'address' => 'default',
                'phone' => '4122548458',
                'dni' => '11223344',
                'rol' => 'administrador',
                'avatar' => '',
                'password' => Hash::make('admin2024'),
            ],
            [
                'name' => 'demo',
                'email' => 'demo@admin',
                'address' => 'default',
                'phone' => '4122548458',
                'dni' => '44557799',
                'rol' => 'default',
                'avatar' => '',
                'password' => Hash::make('demo20242024'),
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
