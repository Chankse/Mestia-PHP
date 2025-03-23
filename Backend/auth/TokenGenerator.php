<?php

require_once __DIR__ . '/../models/Response.php';

class TokenGenerator {
    private static string $secretKey = "your_secret_key"; // Change this to a strong secret key

    /**
     * Generates a simple token by encoding the email.
     *
     * @param string $email
     * @return string
     */
    public static function generateToken(string $email): string {
        $encodedEmail = base64_encode($email);
        $hash = hash_hmac('sha256', $encodedEmail, self::$secretKey);
        return $encodedEmail . "." . $hash;
    }

    /**
     * Validates a token and extracts the email if valid.
     *
     * @param string $token
     * @return Response
     */
    public static function validateToken(string $token): Response {
        $parts = explode('.', $token);
        if (count($parts) !== 2) {
            return new Response(false, null, ["Invalid token format."]);
        }

        [$encodedEmail, $providedHash] = $parts;
        $expectedHash = hash_hmac('sha256', $encodedEmail, self::$secretKey);

        if (!hash_equals($expectedHash, $providedHash)) {
            return new Response(false, null, ["Invalid token signature."]);
        }

        $email = base64_decode($encodedEmail);
        if ($email === false) {
            return new Response(false, null, ["Failed to decode email."]);
        }

        return new Response(true, $email);
    }
}

?>
