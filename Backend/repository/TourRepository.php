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

    // Fetch tours by an array of IDs
    public function getToursByIds(array $ids)
    {
        $placeholders = implode(',', array_fill(0, count($ids), '?')); // Create placeholders for prepared statement
        $sql = "SELECT name, title, location, description, season, duration, difficulty, distance, image_path, alt_text, is_popular FROM tours WHERE id IN ($placeholders)";

        if ($stmt = $this->conn->prepare($sql)) {
            $types = str_repeat('i', count($ids)); // The 'i' type is for integers
            $stmt->bind_param($types, ...$ids); // Bind the values dynamically
            $stmt->execute();
            $result = $stmt->get_result();

            $tours = [];
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

            $stmt->close();
            return $tours;
        }

        return [];
    }

    // Fetch tour id by name
    public function getTourIdByName(string $tourName): ?int {
        $sql = "SELECT id FROM tours WHERE name = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $tourName);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                return $row['id'];
            }

            $stmt->close();
        }
        return null;
    }
}
