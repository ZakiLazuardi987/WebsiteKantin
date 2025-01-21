<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;

interface FileUploadServiceInterface
{
    public function uploadFile(UploadedFile $file, string $path): string;
}