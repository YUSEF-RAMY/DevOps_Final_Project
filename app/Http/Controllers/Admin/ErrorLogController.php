<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ErrorLog;
use Illuminate\Http\Request;

class ErrorLogController extends Controller
{
    public function index(Request $request)
    {
        $query = ErrorLog::query();
        if ($request->filled('search')) {
            $s = '%' . $request->search . '%';
            $query->where(function ($q) use ($s) {
                $q->where('message', 'like', $s)->orWhere('url', 'like', $s)->orWhere('file', 'like', $s)->orWhere('type', 'like', $s);
            });
        }
        if ($request->filled('severity')) {
            switch ($request->severity) {
                case 'critical': $query->where('type', 'like', '%Exception%'); break;
                case 'high': $query->where('type', 'like', '%Error%'); break;
                case 'medium': $query->where('type', 'like', '%Warning%'); break;
                case 'low': $query->where(function ($q) {
                    $q->whereNull('type')->orWhere(function ($q2) {
                        $q2->where('type', 'not like', '%Exception%')->where('type', 'not like', '%Error%')->where('type', 'not like', '%Warning%');
                    });
                }); break;
            }
        }
        if ($request->filled('resolved')) {
            $query->where('is_resolved', (bool) $request->resolved);
        }
        $logs = $query->latest()->paginate(25)->withQueryString();

        $total = ErrorLog::count();
        $critical = ErrorLog::where('type', 'like', '%Exception%')->count();
        $unresolved = ErrorLog::where('is_resolved', false)->count();
        $today = ErrorLog::whereDate('created_at', today())->count();

        return view('admin.error-logs.index', compact('logs', 'total', 'critical', 'unresolved', 'today'));
    }

    public function show(ErrorLog $errorLog)
    {
        return view('admin.error-logs.show', compact('errorLog'));
    }

    public function resolve(ErrorLog $errorLog)
    {
        $errorLog->update(['is_resolved' => true]);
        return redirect()->route('admin.error-logs.show', $errorLog)->with('success', 'Marked as resolved.');
    }

    public function destroy(ErrorLog $errorLog)
    {
        $errorLog->delete();
        return redirect()->route('admin.error-logs.index')->with('success', 'Log deleted.');
    }

    public function clear()
    {
        ErrorLog::query()->delete();
        return redirect()->route('admin.error-logs.index')->with('success', 'All logs cleared.');
    }

    public function clearResolved()
    {
        ErrorLog::where('is_resolved', true)->delete();
        return redirect()->route('admin.error-logs.index')->with('success', 'Resolved logs cleared.');
    }

    public function markResolved(Request $request)
    {
        $ids = array_filter(array_map('intval', explode(',', (string) $request->input('ids', ''))));
        if ($ids) {
            ErrorLog::whereIn('id', $ids)->update(['is_resolved' => true]);
        }
        return redirect()->route('admin.error-logs.index')->with('success', 'Marked as resolved.');
    }
}
