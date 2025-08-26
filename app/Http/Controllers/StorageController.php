<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class StorageController extends Controller
{
    public function store_file($file, $folder, $size = 1200){
        try {

            // Obtener la extensión y MIME type del archivo
            $extension = strtolower($file->getClientOriginalExtension());
            $mimeType = strtolower($file->getMimeType());
            
            // Array de extensiones y MIME types para imágenes
            $imageExtensions = ['jpg', 'jpeg', 'png', 'webp'];
            $imageMimeTypes = ['image/jpeg', 'image/png', 'image/webp'];
            
            // Array de extensiones y MIME types para documentos
            $documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx'];
            $documentMimeTypes = [
                'application/pdf', 
                'application/msword', 
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-excel',
                'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
            ];

            if(in_array($extension, $imageExtensions) || in_array($mimeType, $imageMimeTypes))
            {
                Storage::makeDirectory($folder.'/'.date('F').date('Y'));
                $base_name = Str::random(20);

                // imagen normal
                $extension = 'avif'/* $file->getClientOriginalExtension()*/;
                $filename = $base_name.'.'.$extension;
                $path =  $folder.'/'.date('F').date('Y').'/'.$filename;
                $image_resize = Image::make($file->getRealPath())->orientate();
                $image_resize->resize($size, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                Storage::put($path, $image_resize->encode('avif', 80));

                // imagen banner
                $filename_banner = $base_name.'-banner.'.$extension;
                $image_resize = Image::make($file->getRealPath())->orientate();
                $image_resize->resize(900, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $path_banner = "$folder/".date('F').date('Y').'/'.$filename_banner;
                Storage::put($path_banner, $image_resize->encode('avif', 80));

                // imagen medium
                $filename_medium = $base_name.'-medium.'.$extension;
                $image_resize = Image::make($file->getRealPath())->orientate();
                $image_resize->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $path_medium = "$folder/".date('F').date('Y').'/'.$filename_medium;
                Storage::put($path_medium, $image_resize->encode('avif', 80));

                // imagen small
                $filename_small = $base_name.'-small.'.$extension;
                $image_resize = Image::make($file->getRealPath())->orientate();
                $image_resize->resize(256, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $path_small = "$folder/".date('F').date('Y').'/'.$filename_small;
                Storage::put($path_small, $image_resize->encode('avif', 80));

                // imagen cropped
                $filename_cropped = $base_name.'-cropped.'.$extension;
                $image_resize = Image::make($file->getRealPath())->orientate();
                $image_resize->resize(null, 300, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->resizeCanvas(300, 300);
                $path_cropped = "$folder/".date('F').date('Y').'/'.$filename_cropped;
                Storage::put($path_cropped, $image_resize->encode('avif', 80));
            }

            if(in_array($extension, $documentExtensions) || in_array($mimeType, $documentMimeTypes))
            {
                Storage::makeDirectory($folder.'/'.date('F').date('Y'));
                $base_name = Str::random(20);
                
                $extension = $file->getClientOriginalExtension();
                $filename = $base_name.'.'.$extension;
                $path =  $folder.'/'.date('F').date('Y').'/'.$filename;
                Storage::put($path, file_get_contents($file));
            }

            if(env('FILESYSTEM_DRIVER') == 's3'){
                return env('AWS_ENDPOINT').'/'.env('AWS_BUCKET').'/'.env('AWS_ROOT').'/'.$path;    
            }
            return $path;
        } catch (\Throwable $th) {
            \Log::error('Error al guardar la imagen: ' . $th->getMessage());
            return null;
        }
    }

    // public function store_file($file, $folder){
    //     try {
    //         Storage::makeDirectory($folder.'/'.date('F').date('Y'));
    //         $base_name = Str::random(20);

    //         $extension = $file->getClientOriginalExtension();
    //         $filename = $base_name.'.'.$extension;
    //         $path =  $folder.'/'.date('F').date('Y').'/'.$filename;
    //         Storage::put($path, file_get_contents($file));

    //         if(env('FILESYSTEM_DRIVER') == 's3'){
    //             return env('AWS_ENDPOINT').'/'.env('AWS_BUCKET').'/'.env('AWS_ROOT').'/'.$path;    
    //         }
    //         return $path;
    //     } catch (\Throwable $th) {
    //         \Log::error('Error al guardar el archivo: ' . $th->getMessage());
    //         return null;
    //     }
    // }
}
