<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Tender title
            $table->unsignedBigInteger('component_id');
            $table->unsignedBigInteger('tenderer_id');
            $table->text('description')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->foreign('component_id')->references('id')->on('components')->onDelete('cascade');
            $table->foreign('tenderer_id')->references('id')->on('tenderers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
