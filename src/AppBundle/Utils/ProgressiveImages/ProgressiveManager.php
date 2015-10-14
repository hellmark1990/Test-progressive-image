<?php

namespace AppBundle\Utils\ProgressiveImages;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class ProgressiveManager
 * @package AppBundle\Utils\ProgressiveImages
 */
class ProgressiveManager
{
    /**
     * @var UploadedFile
     */
    private $file;

    /**
     * Supported image types
     * @var array
     */
    private static $IMAGE_TYPES = [
        'jpeg' => [
            'mime_types' => [
                'image/jpeg',
                'image/pjpeg',
            ],
            'class' => 'AppBundle\\Utils\\ProgressiveImages\\ImageTypes\\Jpeg'
        ],
        'png' => [
            'mime_types' => [
                'image/png',
            ],
            'class' => 'AppBundle\\Utils\\ProgressiveImages\\ImageTypes\\Png'
        ],
    ];

    /**
     * Process image file, make it progressive
     * @param UploadedFile $file
     */
    public function processFile(UploadedFile $file)
    {
        $this->file = $file;
        foreach (self::$IMAGE_TYPES as $type) {
            if (in_array($this->file->getMimeType(), $type['mime_types'])) {
                $filePath = $this->file->getRealPath();
                $typeObject = new $type['class']($filePath);
                $typeObject->process();
                break;
            }
        }
    }
}