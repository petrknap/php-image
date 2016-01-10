<?php

namespace PetrKnap\Php\Image;

/**
 * Cropping methods for Image class
 *
 * @author   Petr Knap <dev@petrknap.cz>
 * @since    2008-09-04
 * @package  PetrKnap\Php\Image
 * @see      Image
 * @internal For internal use only
 */
trait ImageCroppingTrait
{
    use ImagePropertiesTrait;

    /**
     * Crops image via rectangle
     *
     * @param array $rectangle
     * @throws ImageException If couldn't crop image.
     */
    public function crop(array $rectangle)
    {
        $croppedImage = @imagecrop($this->resource, $rectangle);
        if ($croppedImage === false) {
            $rectangleAsString = json_encode($rectangle);
            throw new ImageException(
                "Can not crop image {$this} via rectangle {$rectangleAsString}.",
                ImageException::GenericException
            );
        }
        $this->resource = $croppedImage;
        $this->width = $rectangle["width"];
        $this->height = $rectangle["height"];
    }
}
