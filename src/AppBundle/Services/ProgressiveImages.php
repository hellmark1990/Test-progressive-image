<?php

namespace AppBundle\Services;
use AppBundle\Utils\ProgressiveImages\ProgressiveManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * Class ProgressiveImages
 * @package AppBundle\Services
 */
class ProgressiveImages
{

    /**
     * Process image file, make it progressive
     * @param UploadedFile $file
     */
    public function processFile(UploadedFile $file)
    {
        (new ProgressiveManager())->processFile($file);
    }
}