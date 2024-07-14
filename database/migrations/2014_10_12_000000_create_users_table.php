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
                'email' => 'admin@1',
                'address' => 'default',
                'phone' => '4122548458',
                'dni' => '11',
                'rol' => 'administrador',
                'avatar' => '',
                'password' => Hash::make('1'),
            ],
            [
                'name' => 'cliente',
                'email' => 'c@1',
                'address' => 'default',
                'phone' => '4122548458',
                'dni' => '22',
                'rol' => 'default',
                'avatar' => '',
                'password' => Hash::make('1'),
            ],
            [
                'name' => 'servicio tecnico admin',
                'email' => 'sta@1',
                'address' => 'default',
                'phone' => '4122548458',
                'dni' => '33',
                'rol' => 'soporte-tecnico-administrador',
                'avatar' => '',
                'password' => Hash::make('1'),
            ],

            [
                'name' => 'cobranza',
                'email' => 'c@1',
                'address' => 'default',
                'phone' => '4122548458',
                'dni' => '44',
                'rol' => 'cobranza',
                'avatar' => '',
                'password' => Hash::make('1'),
            ],
        ]);

        for ($i=0; $i < 10; $i++) {
            DB::table('users')->insert([
                [
                    'name' => 'servicio tecnico instalador' . $i,
                    'email' => 'sti' . $i . '@1',
                    'address' => 'default',
                    'phone' => $i,
                    'dni' => $i,
                    'rol' => 'soporte-tecnico-instalador',
                    'avatar' => '',
                    'password' => Hash::make('1'),
                ],
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
