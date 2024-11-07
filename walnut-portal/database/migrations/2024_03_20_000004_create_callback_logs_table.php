<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('callback_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('incoming_log_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['pending', 'confirmed'])->default('pending');
            $table->string('result');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('callback_logs');
    }
}; 