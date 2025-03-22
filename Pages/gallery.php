<!DOCTYPE html>
<html lang="en">

<?php
  session_start();
  require_once __DIR__ . '/../Backend/repository/GalleryRepository.php';
  $repo = new GalleryRepository();
  $galleryItems = $repo->getAll();
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description"
    content="Explore the beauty of Mestia through stunning images. A curated gallery showcasing its landscapes, culture, and iconic landmarks." />

  <title>Photo Reports of Mestia</title>
  <link href="https://fonts.googleapis.com/css?family=Lato:100,300,300i,400&display=swap" rel="stylesheet" />
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
          <li><a href="sights.html">Sights</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="tours.html">Tours</a></li>
          <li><a href="contact.html">Contact</a></li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <li><a href="#"><?php echo $_SESSION['user_name']; ?></a></li>
            <li><a href="logout.php">Logout</a></li>
          <?php else: ?>  
            <li><a href="signIn.php">Sign In</a></li>
            <li><a href="signUp.php">Sign Up</a></li>
          <?php endif; ?>
        </ul>

        <div class="mobile-nav-icon">
          <svg width="48px" height="48px" viewBox="0 0 24 24" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path d="M5 12H20" stroke="#000000" stroke-width="2" stroke-linecap="round" />
            <path d="M5 17H20" stroke="#000000" stroke-width="2" stroke-linecap="round" />
            <path d="M5 7H20" stroke="#000000" stroke-width="2" stroke-linecap="round" />
          </svg>
        </div>
      </div>
    </nav>
  </header>

  <main>
    <div class="row">
      <h2>Photo reports of Mestia</h2>
    </div>

    <div class="gallery-grid">
  <?php if (!empty($galleryItems)): ?>
    <?php foreach ($galleryItems as $item): ?>
      <figure aria-label="<?php echo htmlspecialchars($item->getAltText() . ' with text saying ' . $item->getName()); ?>">
        <img src="..<?php echo htmlspecialchars($item->getPath()); ?>" alt="<?php echo htmlspecialchars($item->getAltText()); ?>" />
        <h3><?php echo nl2br(htmlspecialchars($item->getName())); ?></h3>
      </figure>
    <?php endforeach; ?>
  <?php else: ?>
    <p>No images found in the gallery.</p>
  <?php endif; ?>
</div>


  </main>

  <footer>
    <div class="row">
      <div class="col span-1-of-2">
        <ul class="footer-nav">
          <li><a href="../index.php">Home</a></li>
          <li><a href="sights.html">Sights</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li><a href="tours.html">Tours</a></li>
          <li><a href="contact.html">Contact</a></li>
        </ul>
      </div>
      <div class="col span-1-of-2">
        <ul class="social-links">
          <li>
            <a href="https://example.com/facebook" aria-label="Visit our Facebook Page" target="_blank" rel="me">
              <!-- Facebook Icon -->
            </a>
          </li>
          <li>
            <a href="https://example.com/twitter" aria-label="Visit our Twitter Page" target="_blank" rel="me">
              <!-- Twitter Icon -->
            </a>
          </li>
          <li>
            <a href="https://example.com/instagram" aria-label="Visit our Instagram Page" target="_blank" rel="me">
              <!-- Instagram Icon -->
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="row">
      <p class="citation">
        Some images on this page are free to use under the
        <a href="https://unsplash.com/license" target="_blank" rel="noopener noreferrer">Unsplash License</a>.
        Image courtesy of
        <a href="https://unsplash.com" target="_blank" rel="noopener noreferrer">Unsplash</a>.
      </p>
    </div>
    <div class="row">
      <p>
        Created By: Giorgi Chankseliani, Giorgi Machavariani, Tamar Jalaghonia and Tornike Jajanidze
      </p>
    </div>
  </footer>

  <script src="../script.js"></script>
</body>
</html>
