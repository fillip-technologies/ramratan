<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

/**
 * Picks a file extension from the file's real contents (never from the
 * client-supplied filename) and only allows whitelisted extensions, so an
 * upload can never be saved as .php / .phtml / etc.
 */
class SafeUpload
{
    public const IMAGES = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    public const VIDEOS = ['mp4', 'mov', 'qt', 'avi', 'flv', 'wmv', 'webm', 'm4v'];

    public static function ext(UploadedFile $file, array $allowed): string
    {
        $ext = strtolower((string) $file->guessExtension());

        if ($ext === '' || !in_array($ext, $allowed, true)) {
            abort(422, 'Invalid file type.');
        }

        return $ext;
    }
}
