<?php

class SightsIntro {
    public int $id;
    public string $title;
    public string $content;
    public string $image_path;
    public string $image_alt;

    public function __construct(int $id, string $title, string $content, string $image_path, string $image_alt) {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->image_path = $image_path;
        $this->image_alt = $image_alt;
    }
}

class SightsCard {
    public int $id;
    public string $image_path;
    public string $alt_text;
    public string $label;

    public function __construct(int $id, string $image_path, string $alt_text, string $label) {
        $this->id = $id;
        $this->image_path = $image_path;
        $this->alt_text = $alt_text;
        $this->label = $label;
    }
}

class SightsSection {
    public int $section_id;
    public string $title;
    /** @var SightsCard[] */
    public array $cards;

    public function __construct(int $section_id, string $title, array $cards) {
        $this->section_id = $section_id;
        $this->title = $title;
        $this->cards = $cards;
    }
}

class Sights {
    /** @var SightsSection[] */
    public array $sections;

    public function __construct(array $sections) {
        $this->sections = $sections;
    }
}
