<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('incoming_logs', function (Blueprint $table) {
            $table->id();
            $table->string('source');
            $table->string('title');
            $table->integer('word_count');
            $table->foreignId('incoming_log_data_id')
                ->constrained('incoming_log_data')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('incoming_logs');
    }
}; 