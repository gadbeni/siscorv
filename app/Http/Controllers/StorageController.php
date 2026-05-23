<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class StorageController extends Controller
{
    /**
     * Store file with optimized approach for documents
     * 
     * @param \Illuminate\Http\UploadedFile $file
     * @param string $folder
     * @return string|null
     */
    public function store_file($file, $folder)
    {
        try {
            // Create directory structure
            $dir = $folder . '/' . date('F') . date('Y');
            Storage::makeDirectory($dir);

            // Generate unique filename
            $base_name = Str::random(20);
            $extension = $file->getClientOriginalExtension();
            $filename = $base_name . '.' . $extension;
            $path = $dir . '/' . $filename;

            // Store file
            Storage::disk('public')->put($path, file_get_contents($file));

            // Return path for S3 or local
            if (env('FILESYSTEM_DRIVER') == 's3') {
                return env('AWS_ENDPOINT') . '/' . env('AWS_BUCKET') . '/' . env('AWS_ROOT') . '/' . $path;
            }
            
            return $path;
        } catch (\Throwable $th) {
            \Log::error('Error al guardar el archivo: ' . $th->getMessage());
            return null;
        }
    }
}
