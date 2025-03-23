<!DOCTYPE html>
<html lang="en">

<?php
session_start();
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta
    name="description"
    content="Welcome to Mestia, Georgia's mountain gem. Learn about its breathtaking sights, culture, and outdoor adventures." />

  <title>Path To Mestia</title>
  <link
    href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400&display=swap"
    rel="stylesheet" />
  <link rel="stylesheet" href="normalize.css" />
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <header class="home">
    <nav>
      <div class="row">
        <a href="index.php" aria-label="Go to home page" class="logo">
          <img src="Assets/logo.png" alt="Website Logo" />
          <p>Mestia</p>
        </a>
        <ul class="main-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="./Pages/sights.php">Sights</a></li>
          <li><a href="./Pages/gallery.php">Gallery</a></li>
          <li><a href="./Pages/tours.php">Tours</a></li>
          <li><a href="./Pages/contact.php">Contact</a></li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <li><a href="./Pages/myPage.php">My Page</a></li>
            <li><a href="./Pages/logout.php">Logout</a></li>
          <?php else: ?>
            <li><a href="./Pages/signIn.php">Sign In</a></li>
            <li><a href="./Pages/signUp.php">Sign Up</a></li>
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

    <div class="hero-text-box">
      <h1>Path To Mestia</h1>
      <h1>
        Explore beautiful mountains of Georgia<br />With unforgettable food,
        culture and sightseeings.
      </h1>
      <a class="btn btn-full" href="Pages/sights.php">Learn More</a>
      <a class="btn btn-ghost" href="Pages/tours.php">Select Tour</a>
    </div>

    <div class="row authors">
      <p>
        Created By:
        <span>Giorgi Chankseliani, Giorgi Machavariani, Tamar Jalaghonia and
          Tornike Jajanidze</span>
      </p>
    </div>
  </header>

  <script src="script.js"></script>
</body>

</html>