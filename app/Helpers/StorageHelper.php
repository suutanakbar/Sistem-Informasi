<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class StorageHelper
{
    /**
     * Get the full URL for a stored file
     *
     * @param string|null $path
     * @return string|null
     */
    public static function url(?string $path): ?string
    {
        if (!$path) {
            return null;
        }

        return asset('storage/' . $path);
    }

    /**
     * Check if a file exists in storage
     *
     * @param string $path
     * @return bool
     */
    public static function exists(string $path): bool
    {
        return Storage::disk('public')->exists($path);
    }

    /**
     * Delete a file from storage
     *
     * @param string|null $path
     * @return bool
     */
    public static function delete(?string $path): bool
    {
        if (!$path) {
            return false;
        }

        return Storage::disk('public')->delete($path);
    }

    /**
     * Get image URL for agenda poster
     *
     * @param string|null $gambar_poster
     * @return string|null
     */
    public static function agendaPoster(?string $gambar_poster): ?string
    {
        return self::url($gambar_poster);
    }

    /**
     * Get image URL for postingan foto
     *
     * @param string|null $foto
     * @return string|null
     */
    public static function postinganFoto(?string $foto): ?string
    {
        return self::url($foto);
    }

    /**
     * Get image URL for profil ormada logo
     *
     * @param string|null $logo
     * @return string|null
     */
    public static function profilLogo(?string $logo): ?string
    {
        return self::url($logo);
    }
}