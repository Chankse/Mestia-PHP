<?php
class Contact {
    public int $id;
    public string $email;
    public ?string $name;
    public ?string $message;

    public function __construct(int $id, string $email, ?string $name, ?string $message) {
        $this->id = $id;
        $this->email = $email;
        $this->name = $name;
        $this->message = $message;
    }

    // Validation method
    public function validate(): array {
        $errors = [];

        // Validate email
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        // Validate name
        if (empty($this->name)) {
            $errors[] = "Name is required.";
        }

        // Validate message length
        if (strlen($this->message) > 1000) {
            $errors[] = "Message cannot exceed 1000 characters.";
        }

        return $errors;
    }
}
?>