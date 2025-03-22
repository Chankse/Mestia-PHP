<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once __DIR__ . '/../Backend/repository/TourRepository.php';
$repo = new TourRepository();
$tourItems = $repo->getAll();
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta
    name="description"
    content="Plan your adventure in Mestia. Explore guided tours to its mountains, waterfalls, and historic villages." />

  <title>Explore Mestia</title>
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
        <a href="../index.html" aria-label="Go to home page" class="logo">
          <img src="../Assets/logo.png" alt="Website Logo" />
          <p>Mestia</p>
        </a>
        <ul class="main-nav">
          <li><a href="index.php">Home</a></li>
          <li><a href="./Pages/sights.html">Sights</a></li>
          <li><a href="./Pages/gallery.php">Gallery</a></li>
          <li><a href="./Pages/tours.php">Tours</a></li>
          <li><a href="./Pages/contact.php">Contact</a></li>
          <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
            <li><a href="#">
                <?php echo $_SESSION['user_name']; ?>
              </a></li>
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
  </header>

  <main>
    <div class="row">
      <h2>Explore Mestia - Guided Tours & Adventures</h2>
      <p class="info-text">
        Embark on a journey through Mestia with our expertly guided tours.
        Whether you’re looking to explore the town’s historical landmarks,
        trek through its breathtaking mountains, or immerse yourself in local
        traditions, our tours offer a unique way to experience the heart of
        Svaneti. Discover hidden gems and gain insider knowledge about this
        stunning Georgian destination with a tour that suits your interests.
      </p>
    </div>

    <section class="popular-tours-section">
      <div class="row">
        <h2>Popular tours</h2>
      </div>
      <div class="row">
        <div class="popular-tours-grid">
          <?php foreach ($tourItems as $tour): ?>
            <?php if ($tour->is_popular): ?>
              <div class="card">
                <img
                  src="..<?php echo htmlspecialchars($tour->image_path); ?>"
                  alt="<?php echo htmlspecialchars($tour->alt_text); ?>" />
                <p><?php echo htmlspecialchars($tour->title); ?></p>
              </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
      <div class="row">
        <div class="col span-full center">
          <input type="submit" value="See More!" />
        </div>
      </div>
    </section>

    <div class="row">
      <h2>Magical routes of Mestia</h2>
    </div>
    <div class="all-tours-section">
      <?php foreach ($tourItems as $tour): ?>
        <div class="row tour-section h-event">
          <div class="col span-1-of-2">
            <figure aria-label="<?php echo htmlspecialchars($tour->alt_text); ?>">
              <img
                src="..<?php echo htmlspecialchars($tour->image_path); ?>"
                alt="<?php echo htmlspecialchars($tour->alt_text); ?>"
                class="u-photo" />
              <h3 class="p-name"><?php echo htmlspecialchars($tour->title); ?></h3>
              <p class="p-location"><?php echo htmlspecialchars($tour->location); ?></p>
            </figure>
          </div>
          <div class="col span-1-of-2 tour-info">
            <h4 class="tour-title p-name"><?php echo htmlspecialchars($tour->title); ?></h4>
            <p class="tour-description p-description">
              <?php echo htmlspecialchars($tour->description); ?>
            </p>
            <div class="tour-highlight">
              <span><?php echo htmlspecialchars($tour->season); ?></span>
              <span><?php echo htmlspecialchars($tour->duration); ?></span>
            </div>
            <div class="tour-highlight">
              <span><?php echo htmlspecialchars($tour->difficulty); ?></span>
              <span class="tour-distance"><?php echo htmlspecialchars($tour->distance); ?></span>
            </div>
            <input type="submit" value="More Details!" />
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </main>

  <footer>
    <div class="row">
      <div class="col span-1-of-2">
        <ul class="footer-nav">
          <li><a href="../index.html">Home</a></li>
          <li><a href="sights.html">Sights</a></li>
          <li><a href="gallery.html">Gallery</a></li>
          <li><a href="tours.php">Tours</a></li>
          <li><a href="contact.html">Contact</a></li>
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
      <p class="citation">
        Some images on this page are free to use under the
        <a
          href="https://unsplash.com/license"
          target="_blank"
          rel="noopener noreferrer">Unsplash License</a>. Image courtesy of
        <a
          href="https://unsplash.com"
          target="_blank"
          rel="noopener noreferrer">Unsplash</a>.
      </p>
    </div>
    <div class="row">
      <p class="citation">
        Information about Tours and some images were sourced from
        <a
          href="https://georgiantravelguide.com/"
          target="_blank"
          rel="noopener noreferrer">Georgian Travel Guide</a>.
      </p>
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