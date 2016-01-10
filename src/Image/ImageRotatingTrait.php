<?php

namespace PetrKnap\Php\Image;

/**
 * Rotating methods for Image class
 *
 * @author   Petr Knap <dev@petrknap.cz>
 * @since    2008-09-04
 * @package  PetrKnap\Php\Image
 * @see      Image
 * @internal For internal use only
 */
trait ImageRotatingTrait
{
    use ImagePropertiesTrait;

    /**
     * Rotates an image with a given angle
     *
     * @param float $angle Rotation angle in degrees
     */
    public function rotate($angle)
    {
        /** @var Image $this */
        $this->setResource(imagerotate($this->resource, $angle, $this->getBackgroundColor()));
    }

    /**
     * Rotates image left (90°)
     */
    public function rotateLeft()
    {
        $this->rotate(90);
    }

    /**
     * Rotates image right (270°)
     */
    public function rotateRight()
    {
        $this->rotate(270);
    }
}
