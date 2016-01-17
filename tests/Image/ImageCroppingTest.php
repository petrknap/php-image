<?php

namespace PetrKnap\Php\Image\Test;

use PetrKnap\Php\Image\Image;

class ImageCroppingTest extends ImageTestCase
{
    /**
     * @var Image
     */
    private $image;

    public function setUp()
    {
        $this->image = Image::fromFile("{$this->pathToResources}/image.png");
    }

    public function cropByRectangleProvider()
    {
        return [
            [
                [
                    "x" => 1,
                    "y" => 0,
                    "width" => 2,
                    "height" => 3
                ],
                Image::fromFile("{$this->pathToResources}/image_CropBy1pxFromLeft.png")
            ],
            [
                [
                    "x" => 0,
                    "y" => 0,
                    "width" => 2,
                    "height" => 3
                ],
                Image::fromFile("{$this->pathToResources}/image_CropBy1pxFromRight.png")
            ],
            [
                [
                    "x" => 0,
                    "y" => 1,
                    "width" => 3,
                    "height" => 2
                ],
                Image::fromFile("{$this->pathToResources}/image_CropBy1pxFromTop.png")
            ],
            [
                [
                    "x" => 0,
                    "y" => 0,
                    "width" => 3,
                    "height" => 2
                ],
                Image::fromFile("{$this->pathToResources}/image_CropBy1pxFromBottom.png")
            ]
        ];
    }

    /**
     * @covers       Image::fromFile
     * @dataProvider cropByRectangleProvider
     *
     * @param array $rectangle
     * @param Image $expected
     */
    public function testCropByRectangle(array $rectangle, Image $expected)
    {
        $this->image->crop($rectangle);

        $this->assertImageEquals($expected, $this->image);
    }
}
