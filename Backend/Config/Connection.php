<?php
class Connection {
    private $host = "localhost";
    private $dbname = "Mestia";
    private $username = "root";
    private $password = "";
    private $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);
        return $this->conn;
    }
}
?>