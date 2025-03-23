<?php
require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/../utils/TokenGenerator.php';
require_once __DIR__ . '/../models/Response.php';
require_once __DIR__ . '/../repositories/UsersRepository.php';
require_once __DIR__ . '/../repositories/ToursRepository.php';

class UserToursRepository {
    private $conn;
    private $usersRepo;
    private $toursRepo;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
        $this->usersRepo = new UsersRepository();
        $this->toursRepo = new ToursRepository();
    }

    public function addToTour(string $token, string $tourName): Response {
        // Validate Token
        $response = TokenGenerator::validateToken($token);
        if (!$response->isSuccess) {
            return new Response(false, null, ["Invalid or expired token."]);
        }

        // Extract email
        $email = $response->data;

        // Get user by email
        $user = $this->usersRepo->getUserByEmail($email);
        if (!$user) {
            return new Response(false, null, ["User not found."]);
        }

        // Get tour ID by tour name from ToursRepository
        $tourId = $this->toursRepo->getTourIdByName($tourName);
        if (!$tourId) {
            return new Response(false, null, ["Tour not found."]);
        }

        // Insert into userTours
        $sql = "INSERT INTO userTours (user_id, tour_id) VALUES (?, ?)";
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("ii", $user->id, $tourId);
            $stmt->execute();
            $stmt->close();
        }

        return new Response(true, ["message" => "User added to tour successfully."]);
    }

    public function myTours(string $token): Response {
        // Validate Token
        $response = TokenGenerator::validateToken($token);
        if (!$response->isSuccess) {
            return new Response(false, null, ["Invalid or expired token."]);
        }

        // Extract email
        $email = $response->data;

        // Get user by email
        $user = $this->usersRepo->getUserByEmail($email);
        if (!$user) {
            return new Response(false, null, ["User not found."]);
        }

        // Retrieve all tour IDs the user is part of
        $sql = "SELECT tour_id FROM userTours WHERE user_id = ?";
        
        $tourIds = [];
        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("i", $user->id);
            $stmt->execute();
            $result = $stmt->get_result();
            
            while ($row = $result->fetch_assoc()) {
                $tourIds[] = $row['tour_id'];
            }

            $stmt->close();
        }

        // Check if the user is part of any tours
        if (empty($tourIds)) {
            return new Response(true, []); // Return empty array if no tours are found
        }

        // Get tours based on the tour IDs
        $tours = $this->toursRepo->getToursByIds($tourIds);
        
        return new Response(true, $tours);
    }
}
?>
