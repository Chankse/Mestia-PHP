<?php
class Connection {
    private $host = "localhost";
    private $dbname = "Mestia";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        
        if ($this->conn->connect_error) {
            error_log("❌ [DB ERROR] Connection failed: " . $this->conn->connect_error, 3, __DIR__ . "/../logs/db_errors.log");
            die("Connection failed: " . $this->conn->connect_error);
        }

        error_log("✅ [DB SUCCESS] Connected to database successfully!\n", 3, __DIR__ . "/../logs/db_success.log");
        return $this->conn;
    }
}
?>