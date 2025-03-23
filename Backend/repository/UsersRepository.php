<?php
require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Response.php';
require_once __DIR__ . '/../auth/TokenGenerator.php';
require_once __DIR__ . '/../models/RegisterRequest.php';

class UsersRepository {
    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    public function register(RegisterRequest $user): Response {
        $errors = $user->validate();
        if (!empty($errors)) {
            return new Response(false, null, $errors);
        }

        // Check if email already exists
        if ($this->getUserByEmail($user->email) !== null) {
            return new Response(false, null, ["Email already exists."]);
        }

        // Hash password
        $hashedPassword = password_hash($user->password, PASSWORD_BCRYPT);

        // Insert into DB
        $sql = "INSERT INTO users (userName, email, password) VALUES (?, ?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sss", $user->userName, $user->email, $hashedPassword);
            $stmt->execute();
            $stmt->close();
        }

        return new Response(true, ["message" => "User registered successfully."]);
    }

    public function getUserByEmail(string $email): ?User {
        $sql = "SELECT id, userName, email, password FROM users WHERE email = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($row = $result->fetch_assoc()) {
                return new User(
                    $row['id'],
                    $row['userName'],
                    $row['email'],
                    $row['password'] // Hashed password
                );
            }
            $stmt->close();
        }
        return null;
    }

    public function signIn(string $email, string $password): Response {
        echo "<script>console.log('email: " . addslashes($email) . "and passwprd: " . addslashes($password) . "');</script>";

        $user = $this->getUserByEmail($email);
        if (!$user) {
            return new Response(false, null, ["User Doesnt exist."]);
        }

        if (!password_verify($password, $user->password)) {
            echo "<script>console.log('Checking password: " . addslashes($password) . " vs hash: " . addslashes($user->password) . "');</script>";
            return new Response(false, null, ["Invalid password."]);
        }

        // Generate a token
        $token = TokenGenerator::generateToken($user->email);

        // Store token in DB
        $sql = "INSERT INTO userTokens (user_id, token) VALUES (?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("is", $user->id, $token);
            $stmt->execute();
            $stmt->close();
        }

        return new Response(true, ["token" => $token]);
    }

    public function signOut(string $token): Response {
        $response = TokenGenerator::validateToken($token);
        if (!$response->isSuccess) {
            return $response; // Token is invalid
        }

        $email = $response->data;
        $user = $this->getUserByEmail($email);
        if (!$user) {
            return new Response(false, null, ["User not found."]);
        }

        // Remove all tokens for this user
        $sql = "DELETE FROM userTokens WHERE user_id = ?";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $user->id);
            $stmt->execute();
            $stmt->close();
        }

        return new Response(true, ["message" => "User signed out successfully."]);
    }
}
?>
