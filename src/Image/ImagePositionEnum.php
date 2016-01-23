<?php

namespace PetrKnap\Php\Image;

use PetrKnap\Php\Enum\AbstractEnum;

/**
 * Image position enum
 *
 * @author  Petr Knap <dev@petrknap.cz>
 * @since   2016-01-23
 * @package PetrKnap\Php\Image
 *
 * @method static ImageTypeEnum LEFT_TOP() returns enum for LEFT_TOP
 * @method static ImageTypeEnum CENTER_TOP() returns enum for CENTER_TOP
 * @method static ImageTypeEnum RIGHT_TOP() returns enum for RIGHT_TOP
 * @method static ImageTypeEnum LEFT_CENTER() returns enum for LEFT_CENTER
 * @method static ImageTypeEnum CENTER_CENTER() returns enum for CENTER_CENTER
 * @method static ImageTypeEnum RIGHT_CENTER() returns enum for RIGHT_CENTER
 * @method static ImageTypeEnum LEFT_BOTTOM() returns enum for LEFT_BOTTOM
 * @method static ImageTypeEnum CENTER_BOTTOM() returns enum for CENTER_BOTTOM
 * @method static ImageTypeEnum RIGHT_BOTTOM() returns enum for RIGHT_BOTTOM
 */
class ImagePositionEnum extends AbstractEnum
{
    public function __construct($type)
    {
        $this->setItems(
            [
                "LEFT_TOP" => 1,
                "CENTER_TOP" => 2,
                "RIGHT_TOP" => 3,
                "LEFT_CENTER" => 4,
                "CENTER_CENTER" => 5,
                "RIGHT_CENTER" => 6,
                "LEFT_BOTTOM" => 7,
                "CENTER_BOTTOM" => 8,
                "RIGHT_BOTTOM" => 9
            ]
        );

        parent::__construct($type);
    }
}
