<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ApplicationLogController extends Controller
{
    public function __invoke(): View
    {
        $path = storage_path('logs/laravel.log');
        $lines = [];

        if (is_readable($path)) {
            $bytes = (int) config('security.app_log_tail_bytes', 180_000);
            $maxLines = (int) config('security.app_log_tail_lines', 350);
            $size = filesize($path);
            if ($size !== false && $size > $bytes) {
                $chunk = file_get_contents($path, false, null, $size - $bytes);
            } else {
                $chunk = file_get_contents($path) ?: '';
            }
            $all = preg_split("/\r\n|\n|\r/", $chunk) ?: [];
            $lines = array_values(array_filter(array_slice($all, -$maxLines), static fn ($l) => $l !== ''));
        }

        return view('admin.application-log', ['lines' => $lines, 'logPath' => $path]);
    }
}
