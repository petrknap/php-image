<?php

namespace PetrKnap\Php\Image\Test;

use PetrKnap\Php\Image\Image;
use PetrKnap\Php\Image\ImageException;
use PetrKnap\Php\Image\ImagePositionEnum;

class ImageJoiningTest extends ImageTestCase
{
    /**
     * @var Image
     */
    private $background;

    /**
     * @var Image
     */
    private $foreground;

    public function setUp()
    {
        $this->background = Image::fromFile("{$this->pathToResources}/image_background.png");
        $this->foreground = Image::fromFile("{$this->pathToResources}/image_foreground.png");
    }

    /**
     * @covers Image::join
     */
    public function testCanJoinSmallerImage()
    {
        $this->background->join($this->foreground);

        $this->assertImageEquals(
            Image::fromFile("{$this->pathToResources}/image_CanJoinSmallerImage.png"),
            $this->background
        );
    }

    /**
     * @covers Image::join
     */
    public function testCanNotJoinBiggerImage()
    {
        $this->setExpectedException(
            get_class(new ImageException()),
            "",
            ImageException::OUT_OF_RANGE
        );

        $this->foreground->join($this->background);
    }

    public function canJoinImageAtSpecificPositionProvider()
    {
        return [
            [
                ImagePositionEnum::LEFT_TOP(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionLT.png")
            ],
            [
                ImagePositionEnum::CENTER_TOP(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionCT.png")
            ],
            [
                ImagePositionEnum::RIGHT_TOP(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionRT.png")
            ],
            [
                ImagePositionEnum::LEFT_CENTER(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionLC.png")
            ],
            [
                ImagePositionEnum::CENTER_CENTER(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionCC.png")
            ],
            [
                ImagePositionEnum::RIGHT_CENTER(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionRC.png")
            ],
            [
                ImagePositionEnum::LEFT_BOTTOM(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionLB.png")
            ],
            [
                ImagePositionEnum::CENTER_BOTTOM(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionCB.png")
            ],
            [
                ImagePositionEnum::RIGHT_BOTTOM(),
                Image::fromFile("{$this->pathToResources}/image_CanJoinImageAtSpecificPositionRB.png")
            ]
        ];
    }

    /**
     * @covers       Image::join
     * @dataProvider canJoinImageAtSpecificPositionProvider
     *
     * @param ImagePositionEnum $position
     * @param Image $expected
     */
    public function testCanJoinImageAtSpecificPosition(ImagePositionEnum $position, Image $expected)
    {
        $this->background->join($this->foreground, $position);

        $this->assertImageEquals($expected, $this->background);
    }
}
