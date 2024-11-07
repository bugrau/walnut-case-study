<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessIncomingLog;
use App\Models\CallbackLog;
use App\Models\IncomingLog;
use App\Models\IncomingLogData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CallbackController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            '*' => 'required|array',
            '*.title' => 'required|string',
            '*.word_count' => 'required|integer'
        ]);

        return DB::transaction(function () use ($request) {
            if (!$request->isJson() || !is_array($request->json()->all())) {
                return response()->json(['error' => 'Invalid request format'], 400);
            }

            $newsItems = $request->json()->all();

            $logData = IncomingLogData::create([
                'payload' => $newsItems,
                'inserted' => []
            ]);

            $insertedNews = [];
            foreach ($newsItems as $news) {
                if (!IncomingLog::where('title', $news['title'])->exists()) {
                    $incomingLog = IncomingLog::create([
                        'source' => $request->header('User-Agent', 'Unknown'),
                        'title' => $news['title'],
                        'word_count' => $news['word_count'],
                        'incoming_log_data_id' => $logData->id
                    ]);

                    $insertedNews[] = $news;
                    ProcessIncomingLog::dispatch($incomingLog);
                }
            }

            $logData->update([
                'inserted' => $insertedNews
            ]);

            return response()->json([
                'success' => true,
                'inserted_count' => count($insertedNews)
            ]);
        });
    }

    public function testReceiver(Request $request)
    {
        return response()->json([
            'ok' => true,
            'title' => $request->input('title')
        ]);
    }
} 