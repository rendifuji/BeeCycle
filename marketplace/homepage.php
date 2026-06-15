<?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  include '../db_connection.php';
  include '../includes/price-format.php';

  $sellSuccess = $_SESSION['sell_success'] ?? '';
  unset($_SESSION['sell_success']);

  $searchQ = isset($_GET['q']) ? trim($_GET['q']) : '';
  $categoryFilter = $_GET['category'] ?? '';
  $conditionFilter = $_GET['condition'] ?? '';
  $sort = $_GET['sort'] ?? 'new';
  $campusFilters = isset($_GET['campus']) ? $_GET['campus'] : [];
  if (!is_array($campusFilters)) {
    $campusFilters = [$campusFilters];
  }

  $query = "SELECT i.itemID, i.itemTitle, i.price, i.postedDate, i.COD,
                   c.categoryName, co.conditionName, u.campus
            FROM item i
            INNER JOIN user u ON i.studentID = u.studentID
            INNER JOIN categories c ON i.categoryID = c.categoryID
            INNER JOIN `condition` co ON i.conditionID = co.conditionID
            WHERE 1=1";

  if ($searchQ !== '') {
    $q = mysqli_real_escape_string($conn, $searchQ);
    $query .= " AND i.itemTitle LIKE '%$q%'";
  }

  if ($categoryFilter !== '') {
    $cat = mysqli_real_escape_string($conn, $categoryFilter);
    $query .= " AND i.categoryID = '$cat'";
  }

  if ($conditionFilter !== '') {
    $cond = mysqli_real_escape_string($conn, $conditionFilter);
    $query .= " AND i.conditionID = '$cond'";
  }

  if (count($campusFilters) > 0) {
    $campusList = [];
    foreach ($campusFilters as $campus) {
      $campusList[] = "'" . mysqli_real_escape_string($conn, $campus) . "'";
    }
    $query .= ' AND u.campus IN (' . implode(',', $campusList) . ')';
  }

  if ($sort === 'old') {
    $query .= ' ORDER BY i.postedDate ASC';
  } else {
    $query .= ' ORDER BY i.postedDate DESC';
  }

  $result = mysqli_query($conn, $query);
  $items = [];

  while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
  }

  function campusChecked($campusFilters, $value) {
    return in_array($value, $campusFilters, true) ? 'checked' : '';
  }

  $resetFiltersUrl = 'homepage.php';
  if ($searchQ !== '') {
    $resetFiltersUrl .= '?q=' . urlencode($searchQ);
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
    <title>BeeCycle | Home</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../marketplace.css" />
    <link rel="stylesheet" href="homepage.css">
    <script src="homepage.js" defer></script>
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>

    <main class="marketplace-main">
      <div class="marketplace-shell">
        <form method="GET" action="homepage.php" id="homepage-filters" class="marketplace-layout">
          <input type="hidden" name="q" value="<?php echo htmlspecialchars($searchQ); ?>" />

          <aside class="filter-container">
            <div class="filters">
              <h1>Filters</h1>
              <a href="homepage.php" class="filters-clear">Clear All</a>
            </div>

            <div class="filter-group">
              <h2>Campus</h2>
              <label><input type="checkbox" name="campus[]" value="Binus@Kemanggisan" <?php echo campusChecked($campusFilters, 'Binus@Kemanggisan'); ?>>BINUS @ Kemanggisan</label>
              <label><input type="checkbox" name="campus[]" value="Binus@Alam Sutera" <?php echo campusChecked($campusFilters, 'Binus@Alam Sutera'); ?>>BINUS @ Alam Sutera</label>
              <label><input type="checkbox" name="campus[]" value="Binus@Bekasi" <?php echo campusChecked($campusFilters, 'Binus@Bekasi'); ?>>BINUS @ Bekasi</label>
              <label><input type="checkbox" name="campus[]" value="Binus@Malang" <?php echo campusChecked($campusFilters, 'Binus@Malang'); ?>>BINUS @ Malang</label>
              <label><input type="checkbox" name="campus[]" value="Binus@Semarang" <?php echo campusChecked($campusFilters, 'Binus@Semarang'); ?>>BINUS @ Semarang</label>
              <label><input type="checkbox" name="campus[]" value="Binus@Bandung" <?php echo campusChecked($campusFilters, 'Binus@Bandung'); ?>>BINUS @ Bandung</label>
            </div>

            <div class="filter-group">
              <h2>Categories</h2>
              <label><input type="radio" name="category" value="CA003" <?php echo $categoryFilter === 'CA003' ? 'checked' : ''; ?>>Textbooks</label>
              <label><input type="radio" name="category" value="CA001" <?php echo $categoryFilter === 'CA001' ? 'checked' : ''; ?>>Electronics</label>
              <label><input type="radio" name="category" value="CA004" <?php echo $categoryFilter === 'CA004' ? 'checked' : ''; ?>>Dorm Essentials</label>
              <label><input type="radio" name="category" value="CA002" <?php echo $categoryFilter === 'CA002' ? 'checked' : ''; ?>>Uniforms</label>
              <label><input type="radio" name="category" value="CA005" <?php echo $categoryFilter === 'CA005' ? 'checked' : ''; ?>>Art Supplies</label>
            </div>

            <div class="filter-group">
              <h2>Condition</h2>
              <label><input type="radio" name="condition" value="CO001" <?php echo $conditionFilter === 'CO001' ? 'checked' : ''; ?>>New</label>
              <label><input type="radio" name="condition" value="CO002" <?php echo $conditionFilter === 'CO002' ? 'checked' : ''; ?>>Like New</label>
              <label><input type="radio" name="condition" value="CO003" <?php echo $conditionFilter === 'CO003' ? 'checked' : ''; ?>>Used</label>
            </div>

            <div class="filter-actions">
              <button type="submit" class="filter-apply">Apply</button>
              <a href="<?php echo htmlspecialchars($resetFiltersUrl); ?>" class="filter-reset">Reset filters</a>
            </div>
          </aside>

          <section class="listings">
            <?php if ($sellSuccess !== '') { ?>
              <p class="sell-success"><?php echo htmlspecialchars($sellSuccess); ?></p>
            <?php } ?>

            <header class="listings-header">
              <h2>Fresh Listings</h2>
              <div class="listings-sort">
                <label for="sort">Sort By:</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                  <option value="new" <?php echo $sort === 'new' ? 'selected' : ''; ?>>Newest First</option>
                  <option value="old" <?php echo $sort === 'old' ? 'selected' : ''; ?>>Oldest First</option>
                </select>
              </div>
            </header>

            <div class="grid-container">
              <?php if (count($items) === 0) { ?>
                <p class="listings-empty">No listings match your filters.</p>
              <?php } ?>

              <?php foreach ($items as $item): ?>
              <?php
                $badge = $item['conditionName'] === 'LikeNew' ? 'Like New' : $item['conditionName'];
                $detailUrl = 'product-detail.php?id=' . htmlspecialchars($item['itemID']);
              ?>
              <article class="listing-card" onclick="window.location.href='<?php echo($detailUrl); ?>'">
                <span class="listing-card__badge">&#10022; <?php echo htmlspecialchars($badge); ?></span>
                <img class="listing-card__image" src="item-image.php?id=<?php echo($item['itemID']); ?>" alt="<?php echo htmlspecialchars($item['itemTitle']); ?>" />
                <p class="listing-card__price"><?php echo htmlspecialchars(formatPriceDisplay($item['price'])); ?></p>
                <h3 class="listing-card__title"><?php echo htmlspecialchars($item['itemTitle']); ?></h3>
                <div class="listing-card__meta">
                  <span class="listing-card__location">
                    <img src="../assets/icons/pin.svg" alt="" />
                    <?php echo htmlspecialchars($item['COD']); ?>
                  </span>
                  <span><?php echo timeAgo($item['postedDate']); ?></span>
                </div>
              </article>
              <?php endforeach; ?>
            </div>
          </section>
        </form>
      </div>
    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
