<?php

namespace App\Http\Controllers;

use App\Models\IncomingLog;
use Illuminate\Http\Request;

class IncomingLogController extends Controller
{
    public function index(Request $request)
    {
        $query = IncomingLog::query();

        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        if ($request->filled('title')) {
            $query->where('title', 'like', '%' . $request->title . '%');
        }

        $logs = $query->paginate(10);
        return view('admin.incoming-logs.index', compact('logs'));
    }

    public function show(IncomingLog $incomingLog)
    {
        return view('admin.incoming-logs.show', compact('incomingLog'));
    }
} 