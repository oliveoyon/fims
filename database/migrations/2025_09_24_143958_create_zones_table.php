<?php

// database/migrations/2025_09_24_000002_create_zones_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('zones', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('division_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('zones');
    }
};
