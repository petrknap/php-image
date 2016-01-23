<?php

namespace PetrKnap\Php\Image;

use PetrKnap\Php\Enum\AbstractEnum;

/**
 * Image type enum
 *
 * @author  Petr Knap <dev@petrknap.cz>
 * @since   2016-01-23
 * @package PetrKnap\Php\Image
 *
 * @method static ImageTypeEnum GIF() returns enum for GIF
 * @method static ImageTypeEnum JPG() returns enum for JPG
 * @method static ImageTypeEnum PNG() returns enum for PNG
 * @method static ImageTypeEnum WBMP() returns enum for WBMP
 */
class ImageTypeEnum extends AbstractEnum
{
    public function __construct($type)
    {
        $this->setItems(
            [
                "GIF" => IMAGETYPE_GIF,
                "JPG" => IMAGETYPE_JPEG,
                "PNG" => IMAGETYPE_PNG,
                "WBMP" => IMAGETYPE_WBMP
            ]
        );

        parent::__construct($type);
    }
}
