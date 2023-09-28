<?php

namespace App\Generators;

use App\Models\Crater\Estimate;
use App\Models\Crater\Invoice;
use App\Models\Crater\Payment;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;

class CustomPathGenerator implements PathGenerator
{
    public function getPath(Media $media): string
    {
        return $this->getBasePath($media).'/';
    }

    public function getPathForConversions(Media $media): string
    {
        return $this->getBasePath($media).'/conversations/';
    }

    public function getPathForResponsiveImages(Media $media): string
    {
        return $this->getBasePath($media).'/responsive-images/';
    }

    /*
     * Get a unique base path for the given media.
     */
    protected function getBasePath(Media $media): string
    {
        $folderName = null;

        if ($media->model_type == Invoice::class) {
            $folderName = 'Invoices';
        } elseif ($media->model_type == Estimate::class) {
            $folderName = 'Estimates';
        } elseif ($media->model_type == Payment::class) {
            $folderName = 'Payments';
        } else {
            $folderName = $media->getKey();
        }

        return $folderName;
    }
}
