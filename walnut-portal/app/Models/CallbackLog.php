<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CallbackLog extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'incoming_log_id',
        'status',
        'result'
    ];

    public function incomingLog()
    {
        return $this->belongsTo(IncomingLog::class);
    }
} 