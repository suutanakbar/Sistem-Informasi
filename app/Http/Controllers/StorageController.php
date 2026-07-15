<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function serve($path)
    {
        $filePath = storage_path("app/public/" . $path);
        if (!file_exists($filePath)) {
            abort(404);
        }
        $mimeType = mime_content_type($filePath);
        $headers = [
            "Content-Type" => $mimeType,
            "Content-Length" => filesize($filePath),
            "Cache-Control" => "public, max-age=31536000",
        ];
        return response()->file($filePath, $headers);
    }
}
