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
