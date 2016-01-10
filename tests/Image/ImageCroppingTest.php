<?php

namespace PetrKnap\Php\Image;

class ImageCroppingTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Image
     */
    private $image;

    /**
     * @var string
     */
    private $pathToResources;

    public function setUp()
    {
        $this->pathToResources = __DIR__ . "/ImageCroppingTest";
        $this->image = Image::fromFile("{$this->pathToResources}/image.png");
    }

    private function cropByRectangle(array $rectangle, Image $expected)
    {
        $pathToResult = "{$this->image->getPathToFile()}.tmp";
        $pathToExpected = "{$expected->getPathToFile()}.tmp";

        $this->image->crop($rectangle);
        $this->image->save($pathToResult);

        $expected->setType($this->image->getType());
        $expected->save($pathToExpected);

        $result = file_get_contents($pathToResult);
        $expected = file_get_contents($pathToExpected);

        unlink($pathToResult);
        unlink($pathToExpected);

        $this->assertEquals($rectangle["width"], $this->image->getWidth());
        $this->assertEquals($rectangle["height"], $this->image->getHeight());
        $this->assertEquals($expected, $result);
    }

    /**
     * @covers Image::crop
     */
    public function testCropBy1pxFromLeft()
    {
        $rectangle = [
            "x" => 1,
            "y" => 0,
            "width" => 2,
            "height" => 3
        ];

        $expected = Image::fromFile("{$this->pathToResources}/image_CropBy1pxFromLeft.png");

        $this->cropByRectangle($rectangle, $expected);
    }

    /**
     * @covers Image::crop
     */
    public function testCropBy1pxFromRight()
    {
        $rectangle = [
            "x" => 0,
            "y" => 0,
            "width" => 2,
            "height" => 3
        ];

        $expected = Image::fromFile("{$this->pathToResources}/image_CropBy1pxFromRight.png");

        $this->cropByRectangle($rectangle, $expected);
    }

    /**
     * @covers Image::crop
     */
    public function testCropBy1pxFromTop()
    {
        $rectangle = [
            "x" => 0,
            "y" => 1,
            "width" => 3,
            "height" => 2
        ];

        $expected = Image::fromFile("{$this->pathToResources}/image_CropBy1pxFromTop.png");

        $this->cropByRectangle($rectangle, $expected);
    }

    /**
     * @covers Image::crop
     */
    public function testCropBy1pxFromBottom()
    {
        $rectangle = [
            "x" => 0,
            "y" => 0,
            "width" => 3,
            "height" => 2
        ];

        $expected = Image::fromFile("{$this->pathToResources}/image_CropBy1pxFromBottom.png");

        $this->cropByRectangle($rectangle, $expected);
    }
}
