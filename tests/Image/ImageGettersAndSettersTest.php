<?php

namespace PetrKnap\Php\Image\Test;

use PetrKnap\Php\Image\Image;
use PetrKnap\Php\Image\ImageException;
use PetrKnap\Php\Image\ImageTypeEnum;

class ImageGettersAndSettersTest extends ImageTestCase
{
    /**
     * @var string
     */
    private $pathToImageFile;

    /**
     * @var Image
     */
    private $image;

    public function setUp()
    {
        $this->pathToImageFile = "{$this->pathToResources}/image.gif";
        $this->image = Image::fromFile($this->pathToImageFile);
    }

    /**
     * @covers Image::getPathToFile
     */
    public function testCanGetPathToFile()
    {
        $this->assertEquals($this->pathToImageFile, $this->image->getPathToFile());
    }

    /**
     * @covers Image::setPathToFile
     */
    public function testCanSetPathToFile()
    {
        $this->markTestSkipped(self::SKIPPED_NOT_FOR_PUBLIC_USE);
    }

    /**
     * @covers Image::getWidth
     */
    public function testCanGetWidth()
    {
        $this->assertEquals(2, $this->image->getWidth());
    }

    /**
     * @covers Image::setWidth
     */
    public function testCanSetWidth()
    {
        $this->markTestSkipped(self::SKIPPED_NOT_FOR_PUBLIC_USE);
    }

    /**
     * @covers Image::getHeight
     */
    public function testCanGetHeight()
    {
        $this->assertEquals(3, $this->image->getHeight());
    }

    /**
     * @covers Image::setHeight
     */
    public function testCanSetHeight()
    {
        $this->markTestSkipped(self::SKIPPED_NOT_FOR_PUBLIC_USE);
    }

    /**
     * @covers Image::getType
     */
    public function testCanGetType()
    {
        $this->assertEquals(ImageTypeEnum::GIF(), $this->image->getType());
    }

    /**
     * @covers Image::setType
     */
    public function testCanSetType()
    {
        $jpg = ImageTypeEnum::JPG();

        $this->image->setType($jpg);

        $this->assertEquals($jpg, $this->image->getType());
    }

    /**
     * @covers Image::getResource
     */
    public function testCanGetResource()
    {
        $this->assertInternalType("resource", $this->image->getResource());
    }

    /**
     * @covers Image::setResource
     */
    public function testCanSetResource()
    {
        $this->image->setResource(imagecreatetruecolor(11, 22));

        $this->assertEquals(11, $this->image->getWidth());
        $this->assertEquals(22, $this->image->getHeight());
    }

    /**
     * @covers Image::getBackgroundColor
     */
    public function testCanGetBackgroundColor()
    {
        $this->assertEquals(0x00FFFFFF, $this->image->getBackgroundColor());
    }

    /**
     * @covers Image::setBackgroundColor
     */
    public function testCanSetValidBackgroundColor()
    {
        $backgroundColor = 0x004488BB;

        $this->image->setBackgroundColor($backgroundColor);

        $this->assertEquals($backgroundColor, $this->image->getBackgroundColor());

        $this->assertImageEquals(
            Image::fromFile("{$this->pathToResources}/image_CanSetValidBackgroundColor.gif"),
            $this->image
        );
    }

    public function invalidBackgroundColorProvider()
    {
        return [
            "overflow" => [
                0xFFFFFFFFFF
            ],
            "int" => [
                -1
            ],
            "null" => [
                null
            ],
            "string" => [
                ""
            ]
        ];
    }

    /**
     * @covers       Image::setBackgroundColor
     * @dataProvider invalidBackgroundColorProvider
     *
     * @param mixed $value
     */
    public function testCanNotSetInvalidBackgroundColor($value)
    {
        $this->setExpectedException(
            get_class(new ImageException()),
            "",
            ImageException::OUT_OF_RANGE
        );

        $this->image->setBackgroundColor($value);
    }

    /**
     * @covers Image::getTransparentColor
     */
    public function testCanGetTransparentColor()
    {
        $this->assertEquals(null, $this->image->getTransparentColor());
    }

    /**
     * @covers Image::setTransparentColor
     */
    public function testCanSetValidTransparentColor()
    {
        $transparentColor = 0x00404040;

        $this->image->setTransparentColor($transparentColor);

        $this->assertEquals($transparentColor, $this->image->getTransparentColor());

        $this->assertImageEquals(
            Image::fromFile("{$this->pathToResources}/image_CanSetTransparentColor.gif"),
            $this->image
        );
    }

    public function invalidTransparentColorProvider()
    {
        return [
            "overflow" => [
                0xFFFFFFFFFF
            ],
            "int" => [
                -1
            ],
            "null" => [
                null
            ],
            "string" => [
                ""
            ]
        ];
    }

    /**
     * @covers       Image::setTransparentColor
     * @dataProvider invalidTransparentColorProvider
     *
     * @param mixed $value
     */
    public function testCanNotSetInvalidTransparentColor($value)
    {
        $this->setExpectedException(
            get_class(new ImageException()),
            "",
            ImageException::OUT_OF_RANGE
        );

        $this->image->setTransparentColor($value);
    }

    /**
     * @covers Image::getJpgQuality
     */
    public function testCanGetJpgQuality()
    {
        $this->assertEquals(85, $this->image->getJpgQuality());
    }

    /**
     * @covers Image::setJpgQuality
     */
    public function testCanSetValidJpgQuality()
    {
        $jpgQuality = 75;

        $this->image->setJpgQuality($jpgQuality);

        $this->assertEquals($jpgQuality, $this->image->getJpgQuality());
    }

    public function invalidJpgQualityProvider()
    {
        return [
            "101 %" => [
                101
            ],
            "0 %" => [
                0
            ],
            "negative" => [
                -1
            ],
            "null" => [
                null
            ],
            "string" => [
                ""
            ]
        ];
    }

    /**
     * @covers       Image::setJpgQuality
     * @dataProvider invalidJpgQualityProvider
     *
     * @param mixed $value
     */
    public function testCanNotSetInvalidJpgQuality($value)
    {
        $this->setExpectedException(
            get_class(new ImageException()),
            "",
            ImageException::OUT_OF_RANGE
        );

        $this->image->setJpgQuality($value);
    }
}
