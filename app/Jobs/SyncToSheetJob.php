<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class SyncToSheetJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $table;
    protected $action;
    protected $row;

    public function __construct($table, $action, $row)
    {
        $this->table  = $table;
        $this->action = $action;
        $this->row    = $row;
    }

    public function handle()
    {
        $webhook = env('SHEET_WEBHOOK_URL');

        $payload = [
            'table' => $this->table,
            'action' => $this->action,
            'row' => $this->row
        ];

        Http::post($webhook, $payload);
    }
}
