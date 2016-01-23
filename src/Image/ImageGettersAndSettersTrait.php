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

    private static function ImageGettersAndSettersTrait_IsValidColor($color)
    {
        return is_integer($color) && $color >= 0x00000000 && $color <= 0xFFFFFFFF;
    }

    private static function ImageGettersAndSettersTrait_GetColorId($resource, $color)
    {
        if(!self::ImageGettersAndSettersTrait_IsValidColor($color)) {
            throw new ImageException(
                sprintf(
                    ImageException::OUT_OF_RANGE_MESSAGE,
                    "Input '{$color}'"
                ),
                ImageException::OUT_OF_RANGE
            );
        }

        $alpha = ($color & 0xFF000000) >> 24;
        $red = ($color & 0x00FF0000) >> 16;
        $green = ($color & 0x0000FF00) >> 8;
        $blue = ($color & 0x000000FF) >> 0;

        $colorIdentifier = imagecolorallocatealpha($resource, $red, $green, $blue, $alpha);

        if($colorIdentifier === false) {
            throw new ImageException(
                "imagecolorallocatealpha for '{$color}' returned 'false'",
                ImageException::GENERIC
            );
        }
        return $colorIdentifier;
    }

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
     * @return ImageTypeEnum Type of image
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param ImageTypeEnum $type Type of image
     */
    public function setType(ImageTypeEnum $type)
    {
        $this->type = $type;
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
     * @throws ImageException
     */
    public function setBackgroundColor($backgroundColor)
    {
        $resource = imagecreatetruecolor($this->width, $this->height);
        imagefilledrectangle(
            $resource, 0, 0, $this->width, $this->height,
            self::ImageGettersAndSettersTrait_GetColorId($resource, $backgroundColor)
        );
        imagecopy($resource, $this->resource, 0, 0, 0, 0, $this->width, $this->height);
        $this->resource = $resource;
        $this->backgroundColor = $backgroundColor;
    }

    /**
     * @return null|int Transparent color in hexadecimal `0xAARRGGBB` (ARGB) format
     */
    public function getTransparentColor()
    {
        return $this->transparentColor;
    }

    /**
     * @param int $transparentColor Transparent color in hexadecimal `0xAARRGGBB` (ARGB) format
     * @throws ImageException
     */
    public function setTransparentColor($transparentColor)
    {
        $transparentColorId = self::ImageGettersAndSettersTrait_GetColorId($this->resource, $transparentColor);
        $identifierOfTransparentColor = imagecolortransparent(
            $this->resource,
            $transparentColorId
        );
        if($identifierOfTransparentColor !== $transparentColorId) {
            throw new ImageException(
                sprintf(
                    "imagecolortransparent for '%s' returned '%s'",
                    $transparentColorId,
                    $identifierOfTransparentColor
                ),
                ImageException::GENERIC
            );
        }
        $this->transparentColor = $transparentColor;
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
                sprintf(
                    ImageException::OUT_OF_RANGE_MESSAGE,
                    "Input '{$jpgQuality}'"
                ),
                ImageException::OUT_OF_RANGE
            );
        }
        $this->jpgQuality = (int)$jpgQuality;
    }
}
