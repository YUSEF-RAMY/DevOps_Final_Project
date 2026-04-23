<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $fillable = ['name', 'file_name', 'path', 'disk', 'mime_type', 'size', 'alt', 'caption'];

    public function getUrlAttribute(): string
    {
        $path = trim((string) ($this->path ?? ''));
        if ($path === '') {
            return '';
        }
        if (($this->disk ?? '') === 'public') {
            return asset('storage/' . ltrim($path, '/'));
        }
        try {
            return Storage::disk($this->disk)->url($path);
        } catch (\Throwable $e) {
            return '';
        }
    }

    public function isImage(): bool
    {
        return str_starts_with($this->mime_type ?? '', 'image/');
    }

    public function getShortcodeAttribute(): string
    {
        return '[media:' . $this->id . ']';
    }

    public function getImgTagAttribute(): string
    {
        $url = $this->url;
        if ($url === '') {
            return '';
        }
        $alt = e($this->alt ?: $this->name ?: $this->file_name);
        return '<img src="' . e($url) . '" alt="' . $alt . '" />';
    }
}
