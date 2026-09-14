<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SecurityLog;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SecurityLogController extends Controller
{
    public function index(Request $request): View
    {
        $query = SecurityLog::query()->with('user')->orderByDesc('id');

        if ($request->filled('event_type')) {
            $query->where('event_type', $request->string('event_type'));
        }

        if ($request->filled('ip')) {
            $query->where('ip_address', 'like', '%'.$request->string('ip').'%');
        }

        if ($request->filled('path')) {
            $query->where('path', 'like', '%'.$request->string('path').'%');
        }

        if ($request->filled('user_id')) {
            $query->where('user_id', (int) $request->input('user_id'));
        }

        $logs = $query->paginate(40)->withQueryString();

        $eventTypes = SecurityLog::query()
            ->select('event_type')
            ->distinct()
            ->orderBy('event_type')
            ->pluck('event_type');

        return view('admin.security-logs', [
            'logs' => $logs,
            'eventTypes' => $eventTypes,
        ]);
    }
}
