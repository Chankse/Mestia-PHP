<?php
class Response {
    public bool $isSuccess;
    public bool $isFailure;
    public array $errors;

    public function __construct(bool $isSuccess, array $errors = []) {
        $this->isSuccess = $isSuccess;
        $this->isFailure = !$isSuccess;  // If isSuccess is false, isFailure will be true
        $this->errors = $errors;
    }

    // You can add additional helper methods if needed
    public function addError(string $error): void {
        $this->errors[] = $error;
    }
}
?>