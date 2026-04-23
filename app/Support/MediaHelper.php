<?php

namespace App\Support;

use App\Models\Media;

class MediaHelper
{
    /** Replace [media:id] shortcodes in content with img tag (images) or URL (other). */
    public static function replaceShortcodes(?string $content): string
    {
        if ($content === null || $content === '') {
            return '';
        }
        return (string) preg_replace_callback('/\[media:(\d+)\]/', function ($m) {
            $media = Media::find($m[1]);
            if (!$media) {
                return $m[0];
            }
            return $media->isImage() ? $media->img_tag : $media->url;
        }, $content);
    }
}
