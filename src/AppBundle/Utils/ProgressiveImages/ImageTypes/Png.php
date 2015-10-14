<?php

namespace AppBundle\Utils\ProgressiveImages\ImageTypes;

use AppBundle\Utils\ProgressiveImages\ImageTypes\ImageType as BaseImageType;

/**
 * Class Png
 * @package AppBundle\Utils\ProgressiveImages\ImageTypes
 */
class Png extends BaseImageType
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
        $this->interlaceScheme = \Imagick::INTERLACE_PNG;
    }
}