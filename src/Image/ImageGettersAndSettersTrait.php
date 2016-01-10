<?php

namespace PetrKnap\Php\Image;

/**
 * Getters and setters for properties trait
 *
 * @author   Petr Knap <dev@petrknap.cz>
 * @since    2008-09-04
 * @package  PetrKnap\Php\Image
 * @see      Image
 * @internal For internal use only
 */
trait ImageGettersAndSettersTrait
{
    use ImagePropertiesTrait;

    /**
     * @return string Path to image file
     */
    public function getPathToFile()
    {
        return $this->pathToFile;
    }

    /**
     * @return int Width of image in pixels
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * @return int Height of image in pixels
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * @return int Type of image (constants GIF, JPG, PNG and BMP)
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type Type of image (constants GIF, JPG, PNG and BMP)
     */
    public function setType($type)
    {
        $this->type = (int)$type;
    }

    /**
     * @return resource RAW image resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Sets image resource as new image
     *
     * @param resource $resource image resource
     */
    public function setResource($resource)
    {
        $this->resource = $resource;
        $this->width = imagesx($resource);
        $this->height = imagesy($resource);
    }

    /**
     * @return int Background color in hexadecimal `0xAARRGGBB` (ARGB) format
     */
    public function getBackgroundColor()
    {
        return $this->backgroundColor;
    }

    /**
     * @param int $backgroundColor Background color in hexadecimal `0xAARRGGBB` (ARGB) format
     */
    public function setBackgroundColor($backgroundColor)
    {
        $this->backgroundColor = (int)$backgroundColor;
        $tmpImage = imagecreatetruecolor($this->width, $this->height);
        imagefilledrectangle($tmpImage, 0, 0, $this->width, $this->height, $this->backgroundColor);
        imagecopy($tmpImage, $this->resource, 0, 0, 0, 0, $this->width, $this->height);
        $this->resource = $tmpImage;
    }

    /**
     * @return null|int Transparent color in hexadecimal `0xAARRGGBB` (ARGB) format
     */
    public function getTransparentColor()
    {
        return $this->transparentColor;
    }

    /**
     * @param int $color Transparent color in hexadecimal `0xAARRGGBB` (ARGB) format
     */
    public function setTransparent($color)
    {
        $this->transparentColor = $color;
        imagecolortransparent($this->resource, (int)$this->transparentColor);
    }

    /**
     * @return int JPG quality in percents (from 1 to 100)
     */
    public function getJpgQuality()
    {
        return $this->jpgQuality;
    }

    /**
     * @param int $jpgQuality JPG quality in percents (from 1 to 100)
     * @throws ImageException
     */
    public function setJpgQuality($jpgQuality)
    {
        if ($jpgQuality < 1 || $jpgQuality > 100) {
            throw new ImageException(
                "Value must be between 1 and 100.",
                ImageException::OutOfRangeException
            );
        }
        $this->jpgQuality = (int)$jpgQuality;
    }
}
