<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $media = Media::query()
            ->whereNotNull('path')
            ->where('path', '!=', '')
            ->when($request->q, fn ($q) => $q->where('name', 'like', '%' . $request->q . '%')->orWhere('file_name', 'like', '%' . $request->q . '%'))
            ->latest()
            ->paginate(24)
            ->withQueryString();
        return view('admin.media.index', compact('media'));
    }

    public function store(Request $request)
    {
        $files = [];
        if ($request->hasFile('file')) {
            $f = $request->file('file');
            $files = is_array($f) ? array_values($f) : [$f];
        }
        if (empty($files)) {
            if ($request->wantsJson()) {
                return response()->json(['error' => 'No file selected.', 'message' => 'No file selected.'], 422);
            }
            return redirect()->back()->with('error', 'No file selected.');
        }
        $uploaded = [];
        foreach ($files as $file) {
            if (!$file || !$file->isValid()) {
                if ($request->wantsJson()) {
                    return response()->json(['error' => 'Invalid or missing file.', 'message' => 'Invalid or missing file.'], 422);
                }
                continue;
            }
            if ($file->getSize() > 20480 * 1024) {
                continue;
            }
            $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $ext = $file->getClientOriginalExtension();
            $fileName = Str::slug($name ?: 'file') . '-' . uniqid() . '.' . ($ext ?: 'bin');
            $dir = storage_path('app/public/media');
            if (!is_dir($dir) && !@mkdir($dir, 0755, true)) {
                if ($request->wantsJson()) {
                    return response()->json(['error' => 'Storage failed.', 'message' => 'Could not create media directory.'], 500);
                }
                continue;
            }
            if (!is_writable($dir)) {
                if ($request->wantsJson()) {
                    return response()->json(['error' => 'Storage failed.', 'message' => 'Media directory is not writable.'], 500);
                }
                continue;
            }
            $path = 'media/' . $fileName;
            $fullPath = $dir . DIRECTORY_SEPARATOR . $fileName;
            $mimeType = $file->getMimeType();
            $size = (int) $file->getSize();
            try {
                $file->move($dir, $fileName);
            } catch (\Throwable $e) {
                File::put($fullPath, $file->get());
            }
            if (!file_exists($fullPath)) {
                if ($request->wantsJson()) {
                    return response()->json(['error' => 'Storage failed.', 'message' => 'Could not save file. Check storage/app/public/media is writable.'], 500);
                }
                continue;
            }
            $media = Media::create([
                'name' => $name,
                'file_name' => $fileName,
                'path' => $path,
                'disk' => 'public',
                'mime_type' => $mimeType,
                'size' => $size,
            ]);
            $uploaded[] = $media;
        }
        if ($request->wantsJson()) {
            return response()->json(['media' => $uploaded, 'count' => count($uploaded)]);
        }
        return redirect()->route('admin.media.index')->with('success', count($uploaded) . ' file(s) uploaded.');
    }

    public function show(Media $medium)
    {
        return response()->json([
            'id' => $medium->id,
            'name' => $medium->name,
            'file_name' => $medium->file_name,
            'url' => $medium->url,
            'shortcode' => $medium->shortcode,
            'img_tag' => $medium->img_tag,
            'mime_type' => $medium->mime_type,
            'size' => $medium->size,
            'alt' => $medium->alt,
            'caption' => $medium->caption,
        ]);
    }

    public function update(Request $request, Media $medium)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'alt' => 'nullable|string|max:255',
            'caption' => 'nullable|string',
        ]);
        $medium->update($validated);
        if ($request->wantsJson()) {
            return response()->json(['media' => $medium->fresh()]);
        }
        return redirect()->route('admin.media.index')->with('success', 'Updated.');
    }

    public function destroy(Media $medium)
    {
        $path = trim((string) ($medium->path ?? ''));
        if ($path !== '') {
            Storage::disk($medium->disk)->delete($path);
        }
        $medium->delete();
        if (request()->wantsJson()) {
            return response()->json(['deleted' => true]);
        }
        return redirect()->route('admin.media.index')->with('success', 'Deleted.');
    }
}
