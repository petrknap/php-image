<?php

namespace PetrKnap\Php\Image\Test;

use PetrKnap\Php\Image\Image;

abstract class ImageTestCase extends \PHPUnit_Framework_TestCase
{
    const SKIPPED_NOT_FOR_PUBLIC_USE = "Not for public use";

    /**
     * @var string
     */
    protected $pathToResources;

    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $this->pathToResources = __DIR__ . "/" . str_replace(__NAMESPACE__ . "\\", "", get_called_class());
    }

    /**
     * @param Image $expected
     * @param Image $actual
     * @param string $message
     */
    public function assertImageEquals(Image $expected, $actual, $message = '')
    {
        $this->assertInstanceOf(get_class($expected), $actual, $message);
        $this->assertEquals($expected->getWidth(), $actual->getWidth(), $message);
        $this->assertEquals($expected->getHeight(), $actual->getHeight(), $message);

        $tmpExpected = "{$expected->getPathToFile()}.tmp";
        $tmpActual = "{$actual->getPathToFile()}.tmp";

        $actual->setType($expected->getType());

        $expected->save($tmpExpected);
        $actual->save($tmpActual);

        $contentExpected = file_get_contents($tmpExpected);
        $contentActual = file_get_contents($tmpActual);

        unlink($tmpExpected);
        unlink($tmpActual);

        $this->assertEquals($contentExpected, $contentActual, $message);
    }
}
