<?php
  include '../includes/student-check.php';
  include '../db_connection.php';
  include '../includes/price-format.php';

  $studentID = $_SESSION['studentID'];

  $query = "SELECT i.itemID, i.itemTitle, i.price, i.COD, i.postedDate, co.conditionName
            FROM wishlist w
            INNER JOIN item i ON w.itemID = i.itemID
            INNER JOIN `condition` co ON i.conditionID = co.conditionID
            WHERE w.studentID = '$studentID'
            ORDER BY i.postedDate DESC";
  $result = mysqli_query($conn, $query);
  $items = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
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
      return $hrs . ($hrs === 1 ? ' hr ago' : ' hrs ago');
    }
    if ($diff < 604800) {
      $days = (int) floor($diff / 86400);
      return $days . ($days === 1 ? ' day ago' : ' days ago');
    }
    return date('M j, Y', $ts);
  }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeeCycle | Wishlist</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="wishlist.css" />
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>

    <main class="wishlist-main">
      <div class="container wishlist-page">
        <header class="wishlist-header">
          <h1>My Saved Items</h1>
          <p>Keep track of the things you want to buy later.</p>
        </header>

        <?php if (count($items) === 0): ?>
          <p class="wishlist-empty">You have no saved items yet. Open a listing and use the heart on the product page to save it.</p>
        <?php else: ?>
        <div class="wishlist">
          <?php foreach ($items as $item): ?>
          <?php
            $badge = $item['conditionName'] === 'LikeNew' ? 'Like New' : $item['conditionName'];
            $detailUrl = '../marketplace/product-detail.php?id=' . $item['itemID'];
          ?>
          <article class="card" onclick="window.location.href='<?php echo($detailUrl); ?>'">
            <div class="badge"><?php echo($badge); ?></div>
            <img src="../marketplace/item-image.php?id=<?php echo($item['itemID']); ?>" alt="<?php echo($item['itemTitle']); ?>" />
            <h3><?php echo htmlspecialchars(formatPriceDisplay($item['price'])); ?></h3>
            <p class="title"><?php echo htmlspecialchars($item['itemTitle']); ?></p>
            <div class="info">
              <span><?php echo($item['COD']); ?></span>
              <span><?php echo timeAgo($item['postedDate']); ?></span>
            </div>
          </article>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
