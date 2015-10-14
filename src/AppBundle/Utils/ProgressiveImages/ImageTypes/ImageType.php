<?php

namespace AppBundle\Utils\ProgressiveImages\ImageTypes;

/**
 * Class ImageType, base image type
 * @package AppBundle\Utils\ProgressiveImages\ImageTypes
 */
abstract class ImageType
{

    /**
     * \Imagick class object
     * @var \Imagick
     */
    protected $imagickObject;

    /**
     * Image file path
     * @var string
     */
    protected $filePath;

    /**
     * Interlace scheme value
     * @var int
     */
    protected $interlaceScheme;

    public function __construct($filePath)
    {
        if ($filePath && file_exists($filePath)) {
            $this->filePath = $filePath;
            $this->imagickObject = new \Imagick($filePath);
            $this->setInterlaceScheme();
        }
    }

    /**
     * Set image file progressive settings
     */
    protected function processFile()
    {
        $this->imagickObject->setInterlaceScheme($this->getInterlaceScheme());
    }

    /**
     * Process image file
     */
    public function process()
    {
        $this->processFile();
        $this->save();
    }

    /**
     * Save image file
     */
    private function save()
    {
        $this->imagickObject->writeImage($this->filePath);
        $this->imagickObject->clear();
    }

    /**
     * Returns interlace scheme value
     * @return int
     */
    protected function getInterlaceScheme()
    {
        return $this->interlaceScheme;
    }

    /**
     * Set interlace scheme value
     */
    abstract protected function setInterlaceScheme();
}