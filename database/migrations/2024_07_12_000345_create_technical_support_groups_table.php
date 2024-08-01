<?php

use App\Models\Zone;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('technical_support_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedInteger('zone_id')->references('id')->on('zones');
            $table->string('availability')->default('No disponible');
            $table->timestamp('last_instalation')->default(Carbon::now()->subYear());
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technical_support_groups');
    }
};
