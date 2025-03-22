<?php
class Gallery
{
    public $id;
    public $path;
    public $alt_text;
    public $name;

    public function __construct($id, $path, $alt_text, $name)
    {
        $this->id = $id;
        $this->path = $path;
        $this->alt_text = $alt_text;
        $this->name = $name;
    }
}
