<?php
class User {
    public string $userName;
    public string $email;
    public string $password;

    public function __construct(string $userName, string $email, string $password) {
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }

    public function validate(): array {
        $errors = [];

        if (empty($this->userName)) {
            $errors[] = "User name is required.";
        }

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email format.";
        }

        if (empty($this->email)) {
            $errors[] = "Email is required.";
        }

        if (empty($this->password)) {
            $errors[] = "Password is required.";
        } elseif (strlen($this->password) < 6) {
            $errors[] = "Password must be at least 6 characters.";
        }

        return $errors;
    }
}
?>
