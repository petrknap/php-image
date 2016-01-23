<?php

namespace PetrKnap\Php\Image;

/**
 * Properties for Image class
 *
 * @author   Petr Knap <dev@petrknap.cz>
 * @since    2008-09-04
 * @package  PetrKnap\Php\Image
 * @see      Image
 * @internal For internal use only
 */
trait ImagePropertiesTrait
{
    private $pathToFile;
    private $width;
    private $height;

    /**
     * @var ImageTypeEnum
     */
    private $type;

    /**
     * @var resource
     */
    private $resource;
    private $backgroundColor;
    private $transparentColor;
    private $jpgQuality;
}
