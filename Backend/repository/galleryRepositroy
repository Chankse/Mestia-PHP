<?php
require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/../models/Gallery.php';

class GalleryRepository {
    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    // Fetch all gallery items
    public function getAll() {
        $sql = "SELECT id, path, alt_text, name FROM gallery";
        $result = $this->conn->query($sql);
        
        $gallery = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $gallery[] = new Gallery($row["id"], $row["path"], $row["alt_text"], $row["name"]);
            }
        }

        return $gallery;
    }
}
?>
