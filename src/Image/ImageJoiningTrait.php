<?php

namespace PetrKnap\Php\Image;

/**
 * Joining methods for Image class
 *
 * @author   Petr Knap <dev@petrknap.cz>
 * @since    2008-09-04
 * @package  PetrKnap\Php\Image
 * @see      Image
 * @internal For internal use only
 */
trait ImageJoiningTrait
{
    use ImagePropertiesTrait;

    /**
     * Joins images together
     *
     * Puts second image on this image at specific position.
     *
     * @param Image $secondImage Foreground Image object
     * @param ImagePositionEnum $position position of foreground Image object
     * @throws ImageException If couldn't find position.
     */
    public function join(Image $secondImage, ImagePositionEnum $position = null)
    {
        if ($secondImage->getWidth() > $this->width || $secondImage->getHeight() > $this->height) {
            throw new ImageException(
                sprintf(
                    ImageException::OUT_OF_RANGE_MESSAGE,
                    $secondImage
                ),
                ImageException::OUT_OF_RANGE
            );
        }

        if ($position === null) {
            $position = ImagePositionEnum::RIGHT_BOTTOM();
        }

        switch ($position) {
            case ImagePositionEnum::LEFT_TOP():
                $x = 0; // left
                $y = 0; // top
                break;
            case ImagePositionEnum::CENTER_TOP():
                $x = $this->width / 2 - $secondImage->getWidth() / 2; // center
                $y = 0; // top
                break;
            case ImagePositionEnum::RIGHT_TOP():
                $x = $this->width - $secondImage->getWidth(); // right
                $y = 0; // top
                break;
            case ImagePositionEnum::LEFT_CENTER():
                $x = 0; // left
                $y = $this->height / 2 - $secondImage->getHeight() / 2; // center
                break;
            case ImagePositionEnum::CENTER_CENTER():
                $x = $this->width / 2 - $secondImage->getWidth() / 2; // center
                $y = $this->height / 2 - $secondImage->getHeight() / 2; // center
                break;
            case ImagePositionEnum::RIGHT_CENTER():
                $x = $this->width - $secondImage->getWidth(); // right
                $y = $this->height / 2 - $secondImage->getHeight() / 2; // center
                break;
            case ImagePositionEnum::LEFT_BOTTOM():
                $x = 0; // left
                $y = $this->height - $secondImage->getHeight(); // bottom
                break;
            case ImagePositionEnum::CENTER_BOTTOM():
                $x = $this->width / 2 - $secondImage->getWidth() / 2; // center
                $y = $this->height - $secondImage->getHeight(); // bottom
                break;
            case ImagePositionEnum::RIGHT_BOTTOM():
                $x = $this->width - $secondImage->getWidth(); // right
                $y = $this->height - $secondImage->getHeight(); // bottom
                break;
            default:
                throw new ImageException(
                    sprintf(
                        ImageException::UNSUPPORTED_MESSAGE,
                        "Position '%s'"
                    ),
                    ImageException::UNSUPPORTED
                );
                break;
        }
        imagecopy(
            $this->resource,
            $secondImage->getResource(),
            $x, $y, 0, 0,
            $secondImage->getWidth(),
            $secondImage->getHeight()
        );
    }
}
