<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('school_tender', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tender_id');
            $table->unsignedBigInteger('school_id');
            $table->timestamps();

            $table->foreign('tender_id')->references('id')->on('tenders')->onDelete('cascade');
            $table->foreign('school_id')->references('id')->on('schools')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('school_tender');
    }
};
