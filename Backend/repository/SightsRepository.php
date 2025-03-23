<?php
require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/../models/Sights.php';

class SightsRepository
{
    private $conn;

    public function __construct()
    {
        $db = new Connection();
        $this->conn = $db->connect();
    }

    public function getIntro(): ?SightsIntro
    {
        $query = "SELECT * FROM sights_intro LIMIT 1";
        $result = $this->conn->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            return new SightsIntro(
                $row['id'],
                $row['title'],
                $row['content'],
                $row['image_path'],
                $row['image_alt']
            );
        }

        return null;
    }

    public function getAll(): Sights
    {
        $sections = [];

        $sectionQuery = "SELECT * FROM sights_sections";
        $sectionResult = $this->conn->query($sectionQuery);

        while ($section = $sectionResult->fetch_assoc()) {
            $cards = [];
            $cardQuery = "SELECT * FROM sights_cards WHERE section_id = " . $section['id'];
            $cardResult = $this->conn->query($cardQuery);

            while ($card = $cardResult->fetch_assoc()) {
                $cards[] = new SightsCard(
                    $card['id'],
                    $card['image_path'],
                    $card['alt_text'],
                    $card['label']
                );
            }

            $sections[] = new SightsSection(
                $section['id'],
                $section['title'],
                $cards
            );
        }

        return new Sights($sections);
    }
}
