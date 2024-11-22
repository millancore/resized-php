<?php

namespace Square1\Resized;

class ProcessBuilder
{
    private $resized;
    private $image;

    public function __construct(Resized $resized)
    {
        $this->resized = $resized;
    }

    public static function new(Resized $resized) : self
    {
        return new self($resized);
    }

    public function getImage() : Image
    {
        return $this->image;
    }

    public function process($url) : self
    {
        $this->image = new Image($url);
        return $this;
    }

    public function width($width) : self
    {
        $this->image->width = $width;
        return $this;
    }

    public function height($height) : self
    {
        $this->image->height = $height;
        return $this;
    }

    public function title($title) : self
    {
        $this->image->title = $title;
        return $this;
    }

    public function output($output) : self
    {
        $this->image->options['output'] = $output;
        return $this;
    }

    public function quality($quality) : self
    {
        $this->image->options['quality'] = $quality;
        return $this;
    }

    public function options(array $options) : self
    {
        $this->image->options = array_merge(
            $this->image->options,
            $options
        );

        return $this;
    }

    public function url() : string
    {
        return $this->resized->process(
            $this->image->src,
            $this->image->width,
            $this->image->height,
            $this->image->title,
            $this->image->options
        );
    }




}
