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
        Schema::create('ITRequestResponse', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('request_id')->nullable(); 
            $table->integer('job_request_no')->nullable();
            $table->string('request_type')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('work_done')->nullable();
            $table->text('remarks')->nullable();
            $table->datetime('job_started')->nullable();
            $table->datetime('job_ended')->nullable();
            $table->string('technician')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ITRequestResponse');
    }
};
