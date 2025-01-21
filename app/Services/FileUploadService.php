<?php

namespace App\Services;

use App\Services\FileUploadServiceInterface;
use Illuminate\Http\UploadedFile;

class FileUploadService implements FileUploadServiceInterface
{
    public function uploadFile(UploadedFile $file, string $path): string
    {
        $fileName = time() . '.' . $file->getClientOriginalName();
        $file->move($path, $fileName);
        return $path . $fileName;
    }
}
