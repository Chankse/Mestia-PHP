<?php
require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/../models/User.php';

class UsersRepository {
    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    public function register(User $user): Response {
        $errors = $user->validate();
        if (!empty($errors)) {
            return new Response(false, null, $errors);
        }

        $sql = "SELECT * FROM users WHERE email = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $user->email);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                return new Response(false, null, ["Email already exists."]);
            }
            $stmt->close();
        }

        $hashedPassword = password_hash($user->password, PASSWORD_BCRYPT);

        $sql = "INSERT INTO users (userName, email, password) VALUES (?, ?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sss", $user->userName, $user->email, $hashedPassword);
            $stmt->execute();
            $stmt->close();
        }

        return new Response(true, ["message" => "User registered successfully."]);
    }
}
?>
