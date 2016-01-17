<?php

namespace PetrKnap\Php\Image\Test;

use PetrKnap\Php\Image\Image;
use PetrKnap\Php\Image\ImageException;

class ImageFactoriesTest extends ImageTestCase
{
    /**
     * @var resource
     */
    private $imageResource;

    /**
     * @var resource
     */
    private $nonImageResource;

    public function setUp()
    {
        $this->imageResource = imagecreatetruecolor(2, 2);
        $this->nonImageResource = fopen("{$this->pathToResources}/image.txt", "r");
    }

    public function tearDown()
    {
        @imagedestroy($this->imageResource);
        @fclose($this->nonImageResource);
    }

    public function createImageFromFileProvider()
    {
        return [
            "GIF" => [
                Image::GIF,
                "gif"
            ],
            "JPG" => [
                Image::JPG,
                "jpg"
            ],
            "PNG" => [
                Image::PNG,
                "png"
            ],
            "WBMP" => [
                Image::WBMP,
                "wbmp"
            ]
        ];
    }

    /**
     * @covers       Image::fromFile
     * @dataProvider createImageFromFileProvider
     *
     * @param int $type
     * @param string $extension
     */
    public function testCreateImageFromFile($type, $extension)
    {
        $image = Image::fromFile("{$this->pathToResources}/image.{$extension}");

        $this->assertNotNull($image);
        $this->assertEquals($type, $image->getType());
        $this->assertEquals(2, $image->getWidth());
        $this->assertEquals(2, $image->getHeight());
    }

    /**
     * @covers Image::fromFile
     */
    public function testCreateImageFromNonImageFile()
    {
        $this->setExpectedException(
            get_class(new ImageException()),
            "",
            ImageException::UnsupportedFormatException
        );

        Image::fromFile("{$this->pathToResources}/image.txt");
    }

    /**
     * @covers Image::fromFile
     */
    public function testCreateImageFromNonExistingFile()
    {
        $this->setExpectedException(
            get_class(new ImageException()),
            "",
            ImageException::AccessException
        );

        Image::fromFile("{$this->pathToResources}/image.not_found");
    }

    /**
     * @covers Image::fromImage
     */
    public function testCreateImageFromAnotherImage()
    {
        $anotherImage = Image::fromFile("{$this->pathToResources}/image.png");

        $image = Image::fromImage($anotherImage);

        $this->assertInstanceOf(get_class($anotherImage), $image);
        $this->assertEquals($anotherImage->getPathToFile(), $image->getPathToFile());
        $this->assertEquals($anotherImage->getWidth(), $image->getWidth());
        $this->assertEquals($anotherImage->getHeight(), $image->getHeight());
        $this->assertEquals($anotherImage->getType(), $image->getTransparentColor());
        $this->assertEquals($anotherImage->getBackgroundColor(), $image->getBackgroundColor());
        $this->assertEquals($anotherImage->getTransparentColor(), $image->getTransparentColor());
        $this->assertEquals($anotherImage->getJpgQuality(), $image->getJpgQuality());
    }

    /**
     * @covers Image::fromResource
     */
    public function testCreateImageFromImageResource()
    {
        $image = Image::fromResource($this->imageResource);

        $this->assertEquals(2, $image->getWidth());
        $this->assertEquals(2, $image->getHeight());
    }

    /**
     * @covers Image::fromResource
     */
    public function testCreateImageFromNonImageResource()
    {
        $this->setExpectedException(
            get_class(new ImageException()),
            "",
            ImageException::UnsupportedFormatException
        );

        Image::fromResource($this->nonImageResource);
    }
}
