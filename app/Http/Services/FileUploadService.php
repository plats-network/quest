<?php

declare(strict_types=1);

namespace App\Http\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

final class FileUploadService
{
    public function handle(UploadedFile $uploadedFile, &$filename): bool
    {
        $filename = Str::uuid()->toString().'.'.$uploadedFile->getClientOriginalExtension();

        return $uploadedFile
            ->move(storage_path('app/public/'), $filename)
            ->isFile();
    }

    //Function to upload to Cloudinary
    public function uploadToCloudinary(UploadedFile $uploadedFile, &$filename): bool
    {
        $filename = Str::uuid()->toString().'.'.$uploadedFile->getClientOriginalExtension();

        // Upload an image file to cloudinary with one line of code
        $uploadedFileUrl = cloudinary()->upload($uploadedFile->getRealPath())->getSecurePath();

        return $uploadedFileUrl;
    }


}
