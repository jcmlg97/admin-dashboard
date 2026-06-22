<?php

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

function log_activity($action, $description, $userId = null)
{
    ActivityLog::create([
        'action' => $action,
        'description' => $description,
        'user_id' => $userId ?? Auth::id(),
    ]);
}