<?php

namespace PetrKnap\Php\Image;

/**
 * Class designed to simplify the image processing in PHP
 *
 * @author  Petr Knap <dev@petrknap.cz>
 * @since   2008-09-04
 * @package PetrKnap\Php\Image
 * @version 1.0.0
 * @license https://github.com/petrknap/php-image/blob/master/LICENSE MIT
 */
class Image
{
    use ImagePropertiesTrait;
    use ImageGettersAndSettersTrait;
    use ImageFactoriesTrait;
    use ImageResizingTrait;
    use ImageRotatingTrait;
    use ImageCroppingTrait;
    use ImageJoiningTrait;
    use ImageOutputTrait;

    /**
     * @const int Positions
     */
    const
        LEFT_TOP = 1,
        CENTER_TOP = 2,
        RIGHT_TOP = 3,
        LEFT_CENTER = 4,
        CENTER_CENTER = 5,
        RIGHT_CENTER = 6,
        LEFT_BOTTOM = 7,
        CENTER_BOTTOM = 8,
        RIGHT_BOTTOM = 9;

    /**
     * @const int Image types
     */
    const
        GIF = IMAGETYPE_GIF,
        JPG = IMAGETYPE_JPEG,
        PNG = IMAGETYPE_PNG,
        WBMP = IMAGETYPE_WBMP;

    /**
     * Creates empty instance
     */
    private function __construct()
    {
        $this->backgroundColor = 0x00FFFFFF;
        $this->transparentColor = null;
        $this->jpgQuality = 85;
    }

    /**
     * Automatically frees RAM
     */
    public function __destruct()
    {
        try {
            $this->destroy();
        } catch (\Exception $ignore) {
            // Ignore exceptions
        }
    }

    /**
     * Converts object into string
     *
     * @return string
     */
    public function __toString()
    {
        return sprintf("%s(%s, width %u px, height %u px)", get_class($this), $this->resource, $this->width, $this->height);
    }
}
