<?php

namespace App\Http\Controllers;

use App\Models\CallbackLog;
use Illuminate\Http\Request;

class CallbackLogController extends Controller
{
    public function index()
    {
        $logs = CallbackLog::with('incomingLog')->paginate(10);
        return view('admin.callback-logs.index', compact('logs'));
    }

    public function show(CallbackLog $callbackLog)
    {
        return view('admin.callback-logs.show', compact('callbackLog'));
    }
} 