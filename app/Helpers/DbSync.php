<?php

namespace App\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DBSync
{
    use App\Jobs\SyncToSheetJob;

    protected static function sync($table, $action, $row)
    {
        if (!$row) return;

        $row['___action'] = $action;
        $row['___table']  = $table;

        // Dispatch job to queue
        SyncToSheetJob::dispatch($table, $action, $row);
    }
}
