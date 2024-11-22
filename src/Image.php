<?php

namespace Square1\Resized;

class Image
{
    public $src;
    public $width;
    public $height;
    public $title;
    public $options;

    public function __construct($src, $width = '', $height = '', $title = null, $options = [])
    {
        $this->src = $src;
        $this->width = $width;
        $this->height = $height;
        $this->title = $title;
        $this->options = $options;
    }

}
