<?php
class User {
    public ?int $id;
    public string $userName;
    public string $email;
    public string $password;

    public function __construct(?int $id, string $userName, string $email, string $password) {
        $this->id = $id;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }
}
?>
