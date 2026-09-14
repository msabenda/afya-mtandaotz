<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedIp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BlockedIpController extends Controller
{
    public function index(): View
    {
        $blocked = BlockedIp::query()->with('creator')->orderByDesc('id')->paginate(30);

        return view('admin.blocked-ips', ['blocked' => $blocked]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'ip_address' => ['required', 'string', 'max:45', 'unique:blocked_ips,ip_address'],
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        BlockedIp::query()->create([
            'ip_address' => trim($data['ip_address']),
            'reason' => $data['reason'] ?? null,
            'created_by' => $request->user()->id,
        ]);

        return redirect()->route('admin.blocked-ips.index')->with('status', 'IP address blocked.');
    }

    public function destroy(BlockedIp $blockedIp): RedirectResponse
    {
        $blockedIp->delete();

        return redirect()->route('admin.blocked-ips.index')->with('status', 'Block removed.');
    }
}
