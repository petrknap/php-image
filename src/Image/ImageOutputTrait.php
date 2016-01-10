<?php

namespace PetrKnap\Php\Image;

/**
 * Outputs for Image class
 *
 * @author   Petr Knap <dev@petrknap.cz>
 * @since    2008-09-04
 * @package  PetrKnap\Php\Image
 * @see      Image
 * @internal For internal use only
 */
trait ImageOutputTrait
{
    use ImagePropertiesTrait;

    /**
     * Sends image resource to standard output
     *
     * Content-Type header is generated automatically.
     *
     * @see $type
     * @throws ImageException If couldn't find image type.
     */
    public function show()
    {
        switch ($this->type) {
            case Image::GIF:
                header("Content-Type: image/gif");
                imagegif($this->resource);
                break;
            case Image::JPG:
                header("Content-Type: image/jpeg");
                imagejpeg($this->resource, null, $this->jpgQuality);
                break;
            case Image::PNG:
                header("Content-Type: image/png");
                imagepng($this->resource);
                break;
            case Image::BMP:
                header("Content-Type: image/wbmp");
                imagewbmp($this->resource);
                break;
            default:
                throw new ImageException(
                    "Unknown type of file {$this->pathToFile}.",
                    ImageException::UnsupportedFormatException
                );
                break;
        }
    }

    /**
     * Saves image resource to file
     *
     * @param string $pathToFile Path to file
     * @param int $type Output type of image
     * @param int $jpgQuality Output JPG quality in percents (from 1 to 100)
     * @throws ImageException If couldn't find image type.
     */
    public function save($pathToFile = null, $type = null, $jpgQuality = null)
    {
        if ($pathToFile === null) $pathToFile = $this->pathToFile;
        if ($type === null) $type = $this->type;
        if ($jpgQuality === null) $jpgQuality = $this->jpgQuality;
        switch ($type) {
            case Image::GIF:
                imagegif($this->resource, $pathToFile);
                break;
            case Image::JPG:
                imagejpeg($this->resource, $pathToFile, $jpgQuality);
                break;
            case Image::PNG:
                imagepng($this->resource, $pathToFile);
                break;
            case Image::BMP:
                imagewbmp($this->resource, $pathToFile);
                break;
            default:
                throw new ImageException(
                    "Unknown type of file '{$this->pathToFile}'.",
                    ImageException::UnsupportedFormatException
                );
                break;
        }
        $this->pathToFile = $pathToFile;
    }
}
