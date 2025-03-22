<?php
class Response {
    public bool $isSuccess;
    public bool $isFailure;
    public array $errors;
    public $data;

    public function __construct(bool $isSuccess, $data = null, array $errors = []) {
        $this->isSuccess = $isSuccess;
        $this->isFailure = !$isSuccess; 
        $this->errors = $errors;
        $this->data = $data;  
    }

    public function addError(string $error): void {
        $this->errors[] = $error;
    }

    public function setData($data): void {
        $this->data = $data;
    }
}
?>