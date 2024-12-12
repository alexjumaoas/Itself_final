<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('request', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->datetime('request_date')->nullable();
            $table->string('request_code')->nullable();
            $table->string('status')->nullable();
            $table->integer('requestor_userId')->nullable();
            $table->string('section')->nullable();
            $table->string('division')->nullable();
            $table->string('request_summary')->nullable();
            $table->string('others')->nullable();
            $table->string('specific_details')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request');
    }
};
