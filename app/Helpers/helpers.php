<?php

use App\Helpers\StorageHelper;

if (!function_exists('storage_url')) {
    /**
     * Generate URL for a stored file
     *
     * @param string|null $path
     * @return string|null
     */
    function storage_url(?string $path): ?string
    {
        return StorageHelper::url($path);
    }
}

if (!function_exists('agenda_poster_url')) {
    /**
     * Generate URL for agenda poster image
     *
     * @param string|null $gambar_poster
     * @return string|null
     */
    function agenda_poster_url(?string $gambar_poster): ?string
    {
        return StorageHelper::agendaPoster($gambar_poster);
    }
}

if (!function_exists('postingan_foto_url')) {
    /**
     * Generate URL for postingan foto image
     *
     * @param string|null $foto
     * @return string|null
     */
    function postingan_foto_url(?string $foto): ?string
    {
        return StorageHelper::postinganFoto($foto);
    }
}

if (!function_exists('profil_logo_url')) {
    /**
     * Generate URL for profil ormada logo
     *
     * @param string|null $logo
     * @return string|null
     */
    function profil_logo_url(?string $logo): ?string
    {
        return StorageHelper::profilLogo($logo);
    }
}

if (!function_exists('file_exists_storage')) {
    /**
     * Check if file exists in storage
     *
     * @param string $path
     * @return bool
     */
    function file_exists_storage(string $path): bool
    {
        return StorageHelper::exists($path);
    }
}