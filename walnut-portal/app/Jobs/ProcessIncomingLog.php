<?php

namespace App\Jobs;

use App\Models\IncomingLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class ProcessIncomingLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        protected IncomingLog $incomingLog
    ) {}

    public function handle(): void
    {
        $response = Http::post('/test-receiver', [
            'title' => $this->incomingLog->title,
            'word_count' => $this->incomingLog->word_count
        ]);

        $this->incomingLog->callbackLogs()->create([
            'status' => $response->json('ok') ? 'confirmed' : 'pending',
            'result' => json_encode($response->json())
        ]);
    }
} 