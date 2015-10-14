<?php

namespace AppBundle\Utils\ProgressiveImages\ImageTypes;

use AppBundle\Utils\ProgressiveImages\ImageTypes\ImageType as BaseImageType;

/**
 * Class Jpeg
 * @package AppBundle\Utils\ProgressiveImages\ImageTypes
 */
class Jpeg extends BaseImageType
{

    public function __construct($filePath)
    {
        parent::__construct($filePath);

    }

    /**
     * Set image interlace scheme
     * @return int
     */
    protected function setInterlaceScheme()
    {
        $this->interlaceScheme = \Imagick::INTERLACE_JPEG;
    }

    /**
     * Set image file optimization options
     */
    protected function processFile()
    {
        parent::processFile();

        $this->imagickObject->setImageCompression(\Imagick::COMPRESSION_JPEG);
        $this->imagickObject->setImageCompressionQuality($this->imagickObject->getImageCompressionQuality());
    }

}