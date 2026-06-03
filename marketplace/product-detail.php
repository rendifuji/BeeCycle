<?php
  session_start();
  include '../db_connection.php';
  include '../includes/price-format.php';

  $itemID = isset($_GET['id']) ? intval($_GET['id']) : 0;

  if ($itemID === 0) {
    die('Invalid ID');
  }

  $query = "SELECT i.itemID, i.itemTitle, i.price, i.description, i.COD, i.postedDate,
            i.categoryID, c.categoryName, co.conditionName,
            u.fullName, u.campus, u.whatsapp
            FROM item i
            JOIN user u ON i.studentID = u.studentID
            JOIN categories c ON i.categoryID = c.categoryID
            JOIN `condition` co ON i.conditionID = co.conditionID
            WHERE i.itemID = $itemID";

  $result = mysqli_query($conn, $query);
  $item = mysqli_fetch_assoc($result);

  if (!$item) {
    die('Item not found.');
  }

  function timeAgo($datetime) {
    $ts = strtotime($datetime);
    if ($ts === false) {
      return 'Recently';
    }
    $diff = time() - $ts;
    if ($diff < 60) {
      return 'Just now';
    }
    if ($diff < 3600) {
      $mins = (int) floor($diff / 60);
      return $mins . ($mins === 1 ? ' min ago' : ' mins ago');
    }
    if ($diff < 86400) {
      $hrs = (int) floor($diff / 3600);
      return $hrs . ($hrs === 1 ? ' hour ago' : ' hours ago');
    }
    if ($diff < 604800) {
      $days = (int) floor($diff / 86400);
      return $days . ($days === 1 ? ' day ago' : ' days ago');
    }
    return date('M j, Y', $ts);
  }

  function formatCampusLabel($campus) {
    return str_replace('Binus@', 'BINUS @ ', $campus);
  }

  $conditionLabel = $item['conditionName'] === 'LikeNew' ? 'Like New' : $item['conditionName'];
  $sellerInitials = strtoupper(substr($item['fullName'], 0, 2));
  $waMessage = 'Halo! Saya mau beli ' . $item['itemTitle'] . ' dari BeeCycle.';
  $whatsappLink = 'https://wa.me/' . preg_replace('/\D/', '', $item['whatsapp'])
    . '?text=' . rawurlencode($waMessage);
  $campusLabel = formatCampusLabel($item['campus']);

  $inWishlist = false;
  if (isset($_SESSION['studentID'])) {
    $studentID = mysqli_real_escape_string($conn, trim($_SESSION['studentID']));
    $wishQuery = "SELECT itemID FROM wishlist WHERE studentID = '$studentID' AND itemID = $itemID";
    $wishResult = mysqli_query($conn, $wishQuery);
    $inWishlist = $wishResult && mysqli_num_rows($wishResult) > 0;
  }

  $categoryID = mysqli_real_escape_string($conn, $item['categoryID']);
  $similarQuery = "SELECT i.itemID, i.itemTitle, i.price, co.conditionName
                   FROM item i
                   JOIN `condition` co ON i.conditionID = co.conditionID
                   WHERE i.itemID != $itemID
                     AND i.categoryID = '$categoryID'
                   ORDER BY i.postedDate DESC
                   LIMIT 5";
  $similarResult = mysqli_query($conn, $similarQuery);
  $similarItems = [];
  while ($row = mysqli_fetch_assoc($similarResult)) {
    $similarItems[] = $row;
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeeCycle | <?php echo htmlspecialchars($item['itemTitle']); ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../marketplace.css" />
    <link rel="stylesheet" href="prodetail.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css"
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>

    <main class="product-detail-main">
      <div class="product-detail-shell">
        <nav class="breadcrumb" aria-label="Breadcrumb">
          <a href="homepage.php">Home</a>
          <span>/</span>
          <span><?php echo htmlspecialchars($item['categoryName']); ?></span>
          <span>/</span>
          <span class="breadcrumb__current"><?php echo htmlspecialchars($item['itemTitle']); ?></span>
        </nav>

        <section class="product-detail">
          <div class="product-detail__media">
            <img
              src="item-image.php?id=<?php echo($item['itemID']); ?>"
              alt="<?php echo htmlspecialchars($item['itemTitle']); ?>"
            />
          </div>

          <div class="product-detail__info">
            <span class="product-detail__badge">&#10022; <?php echo htmlspecialchars($conditionLabel); ?></span>
            <h1 class="product-detail__title"><?php echo htmlspecialchars($item['itemTitle']); ?></h1>
            <p class="product-detail__price"><?php echo htmlspecialchars(formatPriceDisplay($item['price'])); ?></p>

            <div class="product-detail__meta">
              <span class="product-detail__category"><?php echo htmlspecialchars($item['categoryName']); ?></span>
              <span class="product-detail__time"><?php echo timeAgo($item['postedDate']); ?></span>
            </div>

            <h2 class="product-detail__heading">Description</h2>
            <p class="product-detail__description"><?php echo htmlspecialchars($item['description']); ?></p>

            <div class="seller-card">
              <div class="seller-card__avatar"><?php echo htmlspecialchars($sellerInitials); ?></div>
              <div class="seller-card__primary">
                <p class="seller-card__name"><?php echo htmlspecialchars($item['fullName']); ?></p>
                <p class="seller-card__verified">
                  <i class="fa-solid fa-circle-check" aria-hidden="true"></i>
                  Verified Binusian
                </p>
              </div>
              <div class="seller-card__secondary">
                <p><?php echo htmlspecialchars($campusLabel); ?></p>
                <p class="seller-card__joined">Joined Jun 2026</p>
              </div>
            </div>

            <div class="product-detail__actions">
              <button type="button" class="btn-whatsapp" onclick="window.open('<?php echo htmlspecialchars($whatsappLink, ENT_QUOTES, 'UTF-8'); ?>', '_blank')">
                <i class="fa-brands fa-whatsapp" aria-hidden="true"></i>
                Contact Seller Whatsapp
              </button>

              <?php if (isset($_SESSION['studentID'])) { ?>
              <a
                href="toggle-wishlist.php?id=<?php echo($itemID); ?>"
                class="btn-wishlist<?php echo $inWishlist ? ' btn-wishlist--active' : ''; ?>"
                title="<?php echo $inWishlist ? 'Remove from wishlist' : 'Save to wishlist'; ?>"
                aria-label="<?php echo $inWishlist ? 'Remove from wishlist' : 'Save to wishlist'; ?>"
              >
                <?php if ($inWishlist) { ?>
                <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                  <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" fill="currentColor" />
                </svg>
                <?php } else { ?>
                <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                  <path d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z" fill="currentColor" />
                </svg>
                <?php } ?>
              </a>
              <?php } else { ?>
              <a href="../auth/logIn.php" class="btn-wishlist" aria-label="Log in to save to wishlist">
                <svg viewBox="0 0 24 24" width="22" height="22" aria-hidden="true">
                  <path
                    d="M16.5 3c-1.74 0-3.41.81-4.5 2.09C10.91 3.81 9.24 3 7.5 3 4.42 3 2 5.42 2 8.5c0 3.78 3.4 6.86 8.55 11.54L12 21.35l1.45-1.32C18.6 15.36 22 12.28 22 8.5 22 5.42 19.58 3 16.5 3zm-4.4 15.55l-.1.1-.1-.1C7.14 14.24 4 11.39 4 8.5 4 6.5 5.5 5 7.5 5c1.54 0 3.04.99 3.57 2.36h1.87C13.46 5.99 14.96 5 16.5 5c2 0 3.5 1.5 3.5 3.5 0 2.89-3.14 5.74-7.9 10.05z"
                    fill="currentColor"
                  />
                </svg>
              </a>
              <?php } ?>
            </div>
          </div>
        </section>

        <?php if (count($similarItems) > 0) { ?>
        <section class="similar-items" aria-labelledby="similar-title">
          <h2 id="similar-title" class="similar-items__title">More items like this</h2>
          <div class="similar-items__grid">
            <?php foreach ($similarItems as $similar): ?>
            <?php
              $badge = $similar['conditionName'] === 'LikeNew' ? 'Like New' : $similar['conditionName'];
              $url = 'product-detail.php?id=' . htmlspecialchars($similar['itemID']);
            ?>
            <article class="similar-card" onclick="window.location.href='<?php echo($url); ?>'">
              <span class="similar-card__badge">&#10022; <?php echo htmlspecialchars($badge); ?></span>
              <img src="item-image.php?id=<?php echo($similar['itemID']); ?>" alt="<?php echo htmlspecialchars($similar['itemTitle']); ?>" />
              <p class="similar-card__price"><?php echo htmlspecialchars(formatPriceDisplay($similar['price'])); ?></p>
              <h3><?php echo htmlspecialchars($similar['itemTitle']); ?></h3>
            </article>
            <?php endforeach; ?>
          </div>
        </section>
        <?php } ?>
      </div>
    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
