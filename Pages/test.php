<!DOCTYPE html>

<?php
session_start();

// Form handling
require_once __DIR__ . '/../Backend/repository/ContactsRepository.php';

$success_message = '';
$error_messages = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $email = trim($_POST["email"]);
  $name = trim($_POST["name"]);
  $message = trim($_POST["message"]);

  $contact = new Contact(0, $email, $name, $message);
  $repository = new ContactsRepository();
  $response = $repository->submitContact($contact);

  if ($response->isSuccess) {
    $success_message = "Thank you! Your message has been sent successfully.";
  } else {
    $error_messages = $response->errors;
  }
}
?>


<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Test</title>
  <link
    href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../normalize.css" />
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <main>
    <div class="row">
      <h2>გეიტესტება ბლატ?!</h2>
    </div>

    <div class="row form-result">
      <?php if (!empty($success_message)): ?>
        <div class="form-success">
          <?php echo htmlspecialchars($success_message); ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($error_messages)): ?>
        <div class="form-errors">
          <ul>
            <?php foreach ($error_messages as $error): ?>
              <li><?php echo htmlspecialchars($error); ?></li>
            <?php endforeach; ?>
          </ul>
        </div>
      <?php endif; ?>
    </div>

    <div class="row">
        <div class="row">
          <div class="col span-full center">
            <input type="submit" value="ტესტე" />
          </div>
        </div>
      </form>
    </div>
  </main>

</body>

</html>