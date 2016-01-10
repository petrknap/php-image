<?php

namespace PetrKnap\Php\Image;

/**
 * Factories for Image class
 *
 * @author   Petr Knap <dev@petrknap.cz>
 * @since    2008-09-04
 * @package  PetrKnap\Php\Image
 * @see      Image
 * @internal For internal use only
 */
trait ImageFactoriesTrait
{
    use ImagePropertiesTrait;

    /**
     * Loads image file to RAM
     *
     * @param string $pathToFile Path to loaded file
     * @throws ImageException
     */
    private function open($pathToFile)
    {
        $this->pathToFile = $pathToFile;
        if (!file_exists($this->pathToFile)) {
            throw new ImageException(
                "File '{$this->pathToFile}' not found.",
                ImageException::AccessException
            );
        }
        $tmpImageSize = getimagesize($this->pathToFile);
        $this->width = (int)$tmpImageSize[0];
        $this->height = (int)$tmpImageSize[1];
        $this->type = (int)$tmpImageSize[2];
        switch ($this->type) {
            case Image::GIF:
                $this->resource = imagecreatefromgif($this->pathToFile);
                break;
            case Image::JPG:
                $this->resource = imagecreatefromjpeg($this->pathToFile);
                break;
            case Image::PNG:
                $this->resource = imagecreatefrompng($this->pathToFile);
                break;
            case Image::BMP:
                $this->resource = imagecreatefromwbmp($this->pathToFile);
                break;
            default:
                throw new ImageException(
                    "Unknown type of file " . ($this->pathToFile) . ".",
                    ImageException::UnsupportedFormatException
                );
                break;
        }
    }

    /**
     * Deletes image resource from RAM
     *
     * @return bool true on success or false on failure.
     */
    public function destroy()
    {
        return @imagedestroy($this->resource);
    }

    /**
     * Creates new Image object from image file
     *
     * @param string $pathToFile Path to image file
     * @return Image
     */
    public static function fromFile($pathToFile)
    {
        /** @var Image $newImage */
        $newImage = new self();
        $newImage->open($pathToFile);
        return $newImage;
    }

    /**
     * Creates new Image object from image resource
     *
     * @param resource $resource Image resource
     * @throws ImageException
     * @return Image
     */
    public static function fromResource($resource)
    {
        /** @var Image $newImage */
        $newImage = new self();
        try {
            $newImage->setResource($resource);
        } catch (\Exception $exception) {
            throw new ImageException(
                $exception->getMessage(),
                ImageException::UnsupportedFormatException,
                $exception);
        }
        return $newImage;
    }

    /**
     * Creates copy of Image object
     *
     * @param Image $image Image object
     * @return Image
     */
    public static function fromImage(Image $image)
    {
        /** @var Image $newImage */
        $newImage = clone $image;
        return $newImage;
    }
}
