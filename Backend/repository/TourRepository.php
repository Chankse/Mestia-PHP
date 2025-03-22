<?php
require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/../models/Tour.php';

class TourRepository
{
    private $conn;

    public function __construct()
    {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    // Fetch all tours
    public function getAll()
    {
        $sql = "SELECT name, title, location, description, season, duration, difficulty, distance, image_path, alt_text, is_popular FROM tours";
        $result = $this->conn->query($sql);

        $tours = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $tours[] = new Tour(
                    $row["name"],
                    $row["title"],
                    $row["location"],
                    $row["description"],
                    $row["season"],
                    $row["duration"],
                    $row["difficulty"],
                    $row["distance"],
                    $row["image_path"],
                    $row["alt_text"],
                    (bool)$row["is_popular"]
                );
            }
        }

        return $tours;
    }

    // Fetch only popular tours
    public function getPopular()
    {
        $sql = "SELECT name, title, location, description, season, duration, difficulty, distance, image_path, alt_text, is_popular FROM tours WHERE is_popular = 1";
        $result = $this->conn->query($sql);

        $popular_tours = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $popular_tours[] = new Tour(
                    $row["name"],
                    $row["title"],
                    $row["location"],
                    $row["description"],
                    $row["season"],
                    $row["duration"],
                    $row["difficulty"],
                    $row["distance"],
                    $row["image_path"],
                    $row["alt_text"],
                    (bool)$row["is_popular"]
                );
            }
        }

        return $popular_tours;
    }
}
