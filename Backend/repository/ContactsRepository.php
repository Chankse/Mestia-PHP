<?php
require_once __DIR__ . '/../config/Connection.php';
require_once __DIR__ . '/../models/Contact.php';
require_once __DIR__ . '/../models/Response.php';  // Include Response class

class ContactsRepository {
    private $conn;

    public function __construct() {
        $database = new Connection();
        $this->conn = $database->connect();
    }

    // Submit contact and validate the contact object
    public function submitContact(Contact $contact): Response {
        // Validate the contact object
        $errors = $contact->validate();

        if (!empty($errors)) {
            // If there are validation errors, return them in the Response object
            return new Response(false, $errors);
        }

        // If no errors, proceed to insert into the database
        $sql = "INSERT INTO Contacts (email, name, message) VALUES (?, ?, ?)";

        if ($stmt = $this->conn->prepare($sql)) {
            $stmt->bind_param("sss", $contact->email, $contact->name, $contact->message);
            $stmt->execute();
            $stmt->close();

            // Return success response
            return new Response(true, []);
        }

        // Return failure response if query execution fails
        return new Response(false, ["Failed to submit contact"]);
    }
}
?>
