<?php

namespace PetrKnap\Php\Image;

class ImageException extends \Exception
{
    const
        GenericException = 0,
        AccessException = 1,
        UnsupportedFormatException = 2,
        OutOfRangeException = 3;
}
