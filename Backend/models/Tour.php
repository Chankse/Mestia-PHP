<?php
class Tour
{
    public string $name;
    public string $title;
    public string $location;
    public string $description;
    public string $season;
    public string $duration;
    public string $difficulty;
    public string $distance;
    public string $image_path;
    public string $alt_text;
    public bool $is_popular;

    public function __construct(
        string $name,
        string $title,
        string $location,
        string $description,
        string $season,
        string $duration,
        string $difficulty,
        string $distance,
        string $image_path,
        string $alt_text,
        bool $is_popular
    ) {
        $this->name = $name;
        $this->title = $title;
        $this->location = $location;
        $this->description = $description;
        $this->season = $season;
        $this->duration = $duration;
        $this->difficulty = $difficulty;
        $this->distance = $distance;
        $this->image_path = $image_path;
        $this->alt_text = $alt_text;
        $this->is_popular = $is_popular;
    }
}
