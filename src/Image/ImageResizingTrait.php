<?php

namespace PetrKnap\Php\Image;

/**
 * Resizing methods for Image class
 *
 * @author   Petr Knap <dev@petrknap.cz>
 * @since    2008-09-04
 * @package  PetrKnap\Php\Image
 * @see      Image
 * @internal For internal use only
 */
trait ImageResizingTrait
{
    use ImagePropertiesTrait;

    /**
     * Changes the image resolution
     *
     * @param int $width New width in pixels
     * @param int $height New height in pixels
     */
    public function resize($width, $height)
    {
        $width = (int)$width;
        $height = (int)$height;
        $tmpImage = imagecreatetruecolor($width, $height);
        imagefilledrectangle(
            $tmpImage,
            0, 0,
            $width, $height,
            $this->backgroundColor
        );
        imagecopyresampled(
            $tmpImage,
            $this->resource,
            0, 0,
            0, 0,
            $width, $height,
            $this->width, $this->height
        );
        $this->width = $width;
        $this->height = $height;
        $this->resource = $tmpImage;
    }

    /**
     * Semi-automatic image resize
     *
     * New height is computed from aspect ratio.
     *
     * @see resize
     * @param int $width New width in pixels
     */
    public function resizeToSpecificWidth($width)
    {
        $tmpHeight = $width / $this->width * $this->height;
        $this->resize((int)$width, (int)$tmpHeight);
    }

    /**
     * Semi-automatic image resize
     *
     * New width is computed from aspect ratio.
     *
     * @see resize
     * @param int $height New height in pixels
     */
    public function resizeToSpecificHeight($height)
    {
        $tmpWidth = $height / $this->height * $this->width;
        $this->resize((int)$tmpWidth, (int)$height);
    }
}
