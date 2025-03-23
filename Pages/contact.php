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
  <meta
    name="description"
    content="Get in touch with us to learn more about Mestia or plan your visit. Contact details and location information available here." />

  <title>Contact Us</title>
  <link
    href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="../normalize.css" />
  <link rel="stylesheet" href="../style.css" />
</head>

<body>
  <header>
    <nav>
      <div class="row">
        <a href="../index.php" aria-label="Go to home page" class="logo">
          <img src="../Assets/logo.png" alt="Website Logo" />
          <p>Mestia</p>
        </a>
        <ul class="main-nav">
          <li><a href="../index.php">Home</a></li>
          <li><a href="sights.php">Sights</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="tours.php">Tours</a></li>
          <li><a href="contact.php">Contact</a></li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <li><a href="myPage.php">My Page</a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php else: ?>
            <li><a href="signIn.php">Sign In</a></li>
            <li><a href="signUp.php">Sign Up</a></li>
          <?php endif; ?>
        </ul>

        <div class="mobile-nav-icon">
          <svg
            width="48px"
            height="48px"
            viewBox="0 0 24 24"
            fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path
              d="M5 12H20"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round" />
            <path
              d="M5 17H20"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round" />
            <path
              d="M5 7H20"
              stroke="#000000"
              stroke-width="2"
              stroke-linecap="round" />
          </svg>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="row">
      <h2>We're happy to hear from you</h2>
    </div>

    <div class="row message">
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
      <form method="POST" action="contact.php" class="contact-form">
        <div class="row">
          <div class="col span-full">
            <label for="name">Name</label>
          </div>
          <div class="col span-full">
            <input
              type="text"
              name="name"
              id="name"
              placeholder="Your name"
              required />
          </div>
        </div>

        <div class="row">
          <div class="col span-full">
            <label for="email">Email</label>
          </div>
          <div class="col span-full">
            <input
              type="text"
              name="email"
              id="email"
              placeholder="Your email"
              required />
          </div>
        </div>

        <div class="row">
          <div class="col span-full">
            <label>How can we help you?</label>
          </div>
          <div class="col span-full">
            <textarea name="message" placeholder="Your massage"></textarea>
          </div>
        </div>

        <div class="row">
          <div class="col span-full center">
            <input type="submit" value="Send it!" />
          </div>
        </div>
      </form>
    </div>
  </main>

  <footer>
    <div class="row">
      <div class="col span-1-of-2">
        <ul class="footer-nav">
          <li><a href="../index.php">Home</a></li>
          <li><a href="sights.php">Sights</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="tours.php">Tours</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul>
      </div>
      <div class="col span-1-of-2">
        <ul class="social-links">
          <li>
            <a
              href="https://example.com/facebook"
              aria-label="Visit our Facebook Page"
              target="_blank"
              rel="me">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill">
                <path
                  d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
              </svg>
            </a>
          </li>
          <li>
            <a
              href="https://example.com/twitter"
              aria-label="Visit our Twitter Page"
              target="_blank"
              rel="me">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill">
                <path
                  d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
              </svg>
            </a>
          </li>
          <li>
            <a
              href="https://example.com/instagram"
              aria-label="Visit our Instagram Page"
              target="_blank"
              rel="me">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                class="fill">
                <path
                  d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z" />
              </svg>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <p>
        Created By: Giorgi Chankseliani, Giorgi Machavariani, Tamar Jalaghonia
        and Tornike Jajanidze
      </p>
    </div>
  </footer>

  <script src="../script.js"></script>
</body>

</html>