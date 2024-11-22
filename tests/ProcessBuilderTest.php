<?php

namespace Square1\Resized\Test;

use PHPUnit\Framework\TestCase;
use Square1\Resized\ProcessBuilder;
use Square1\Resized\Resized;

class ProcessBuilderTest extends TestCase
{
    private $resized;

    public function setUp(): void
    {
        $this->resized = new Resized('key', 'secret-d0be2dc421be4fcd0172e5afceea3970e2f3d940');
    }

    public function testProcessBuilder()
    {
        $processBuilder = $this->resized->builder('http://www.example.com/some-image-to-resize.jpg');

        $this->assertInstanceOf(ProcessBuilder::class, $processBuilder);
    }

    public function testProcessBuilderFull()
    {
        $partialImage = $this->resized->builder('http://www.example.com/some-image-to-resize.jpg')
            ->width(100)
            ->height(100)
            ->output('webp')
            ->title('A nice title')
            ->options(['quality' => 80])
            ->getImage();

        $this->assertEquals($partialImage->src, 'http://www.example.com/some-image-to-resize.jpg');
        $this->assertEquals($partialImage->width, 100);
        $this->assertEquals($partialImage->height, 100);
        $this->assertEquals($partialImage->options, ['output' => 'webp', 'quality' => 80]);
        $this->assertEquals($partialImage->title, 'A nice title');
    }

    public function testProcessBuilderOptionsWillBeMerge()
    {
        $partialImage = $this->resized->builder('http://www.example.com/some-image-to-resize.jpg')
            ->width(100)
            ->height(100)
            ->quality(70)
            ->output('webp')
            ->title('A nice title')
            ->options(['quality' => 80])
            ->options(['output' => 'jpeg'])
            ->getImage();

        $this->assertEquals($partialImage->options, ['output' => 'jpeg', 'quality' => 80]);
    }

}
