<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomingLogData extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'incoming_log_data';

    protected $fillable = [
        'payload',
        'inserted'
    ];

    protected $casts = [
        'payload' => 'json',
        'inserted' => 'json'
    ];

    public function incomingLogs()
    {
        return $this->hasMany(IncomingLog::class);
    }
} 