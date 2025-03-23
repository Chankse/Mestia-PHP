<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once __DIR__ . '/../Backend/repository/TourRepository.php';
require_once __DIR__ . '/../Backend/repository/UserToursRepository.php';

$repo = new TourRepository();
$tourItems = $repo->getAll();

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_tour']) && isset($_POST['tour_name'])) {
  $token = $_SESSION['user_token'] ?? '';
  $tourName = $_POST['tour_name'];

  echo "<script>console.log('Debug: " . addslashes($tourName) . "');</script>";
  echo "<script>console.log('Debug: " . addslashes($token) . "');</script>";

  $userToursRepo = new UserToursRepository();
  $response = $userToursRepo->addToTour($token, $tourName);

  if ($response->isSuccess) {
    $message = "Successfully added to tour: " . htmlspecialchars($tourName);
  } else {
    $message = "Error: " . htmlspecialchars(implode(', ', $response->errors));
  }
}
?>

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="Plan your adventure in Mestia. Explore guided tours to its mountains, waterfalls, and historic villages." />

  <title>Explore Mestia</title>
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
          <svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
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

    <?php if (!empty($message)): ?>
      <div class="row message">
        <?php if (str_starts_with($message, 'Error:')): ?>
          <p class="form-errors"><?php echo $message; ?></p>
        <?php else: ?>
          <p class="form-success"><?php echo $message; ?></p>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <section class="popular-tours-section">
      <div class="row">
        <h2>Popular tours</h2>
      </div>
      <div class="row">
        <div class="popular-tours-grid">
          <?php foreach ($tourItems as $tour): ?>
            <?php if ($tour->is_popular): ?>
              <div class="card">
                <img src="..<?php echo htmlspecialchars($tour->image_path); ?>" alt="<?php echo htmlspecialchars($tour->alt_text); ?>" />
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
              <img src="..<?php echo htmlspecialchars($tour->image_path); ?>" alt="<?php echo htmlspecialchars($tour->alt_text); ?>" class="u-photo" />
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

            <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true): ?>
              <form method="POST" style="margin-top: 1rem;">
                <input type="hidden" name="tour_name" value="<?php echo htmlspecialchars($tour->name); ?>">
                <input type="submit" name="save_tour" value="Save!" />
              </form>
            <?php else: ?>
              <p class="info-text">Please <a href="signIn.php">sign in</a> to save tours.</p>
            <?php endif; ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

  </main>

  <footer>
    <!-- footer stays unchanged -->
  </footer>

  <script src="../script.js"></script>
</body>

</html>