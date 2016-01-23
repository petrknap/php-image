<?php

namespace PetrKnap\Php\Image;

class ImageException extends \Exception
{
    const
        GENERIC = 0,
        ACCESS = 1,
        ACCESS_MESSAGE = "%s is not accessible",
        UNSUPPORTED = 2,
        UNSUPPORTED_MESSAGE = "%s is unsupported",
        OUT_OF_RANGE = 3,
        OUT_OF_RANGE_MESSAGE = "%s is out of range";

    public function __construct($message = "", $code = 0, \Exception $previous = null) {
        if($code != self::GENERIC && empty($message)) {
            throw new self(
                "Can not create exception #{$code} with empty message",
                self::GENERIC
            );
        }

        parent::__construct($message, $code, $previous);
    }
}
