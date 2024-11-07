<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class IncomingLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'source',
        'title',
        'word_count',
        'incoming_log_data_id'
    ];

    public function logData()
    {
        return $this->belongsTo(IncomingLogData::class, 'incoming_log_data_id');
    }

    public function callbackLogs()
    {
        return $this->hasMany(CallbackLog::class);
    }
} 