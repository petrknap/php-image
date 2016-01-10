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
     * Acceptable positions are:
     *
     * +--------------------+----------------------+---------------------+
     * | Image::LEFT_TOP    | Image::CENTER_TOP    | Image::RIGHT_TOP    |
     * +--------------------+----------------------+---------------------+
     * | Image::LEFT_CENTER | Image::CENTER_CENTER | Image::RIGHT_CENTER |
     * +--------------------+----------------------+---------------------+
     * | Image::LEFT_BOTTOM | Image::CENTER_BOTTOM | Image::RIGHT_BOTTOM |
     * +--------------------+----------------------+---------------------+
     *
     * @param Image $secondImage Foreground Image object
     * @param int $position Predefined position of foreground Image object
     * @throws ImageException If couldn't find position.
     */
    public function join(Image $secondImage, $position = Image::RIGHT_BOTTOM)
    {
        if ($secondImage->getWidth() > $this->width || $secondImage->getHeight() > $this->height) {
            throw new ImageException(
                "Cannot insert bigger {$secondImage} into smaller {$this}.",
                ImageException::OutOfRangeException
            );
        }
        switch ($position) {
            case Image::LEFT_TOP:
                $x = 0; // left
                $y = 0; // top
                break;
            case Image::CENTER_TOP:
                $x = $this->width / 2 - $secondImage->getWidth() / 2; // center
                $y = 0; // top
                break;
            case Image::RIGHT_TOP:
                $x = $this->width - $secondImage->getWidth(); // right
                $y = 0; // top
                break;
            case Image::LEFT_CENTER:
                $x = 0; // left
                $y = $this->height / 2 - $secondImage->getHeight() / 2; // center
                break;
            case Image::CENTER_CENTER:
                $x = $this->width / 2 - $secondImage->getWidth() / 2; // center
                $y = $this->height / 2 - $secondImage->getHeight() / 2; // center
                break;
            case Image::RIGHT_CENTER:
                $x = $this->width - $secondImage->getWidth(); // right
                $y = $this->height / 2 - $secondImage->getHeight() / 2; // center
                break;
            case Image::LEFT_BOTTOM:
                $x = 0; // left
                $y = $this->height - $secondImage->getHeight(); // bottom
                break;
            case Image::CENTER_BOTTOM:
                $x = $this->width / 2 - $secondImage->getWidth() / 2; // center
                $y = $this->height - $secondImage->getHeight(); // bottom
                break;
            case Image::RIGHT_BOTTOM:
                $x = $this->width - $secondImage->getWidth(); // right
                $y = $this->height - $secondImage->getHeight(); // bottom
                break;
            default:
                throw new ImageException(
                    "Position '{$position}' not found.",
                    ImageException::OutOfRangeException
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
