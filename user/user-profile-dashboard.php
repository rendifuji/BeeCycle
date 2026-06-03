<?php
  include '../includes/student-check.php';
  include '../db_connection.php';
  include '../includes/price-format.php';

  $studentID = trim($_SESSION['studentID']);

  $query = "SELECT * FROM user WHERE studentID = '" . mysqli_real_escape_string($conn, $studentID) . "'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);

  $campus = $user['campus'] ?? $user['Campus'] ?? '';
  $whatsapp = $user['whatsapp'] ?? $user['Whatsapp'] ?? $user['phone'] ?? '';
  $email = $user['email'] ?? $user['Email'] ?? ($_SESSION['email'] ?? '');
  $fullName = $user['fullName'] ?? $user['full_name'] ?? '';

  $listQuery = "SELECT i.itemID, i.itemTitle, i.price, i.description, i.COD, i.postedDate, co.conditionName
                FROM item i
                JOIN `condition` co ON i.conditionID = co.conditionID
                WHERE i.studentID = '$studentID'
                ORDER BY i.postedDate DESC";
  $listResult = mysqli_query($conn, $listQuery);
  $listings = [];
  while ($row = mysqli_fetch_assoc($listResult)) {
    $listings[] = $row;
  }

  $initials = $_SESSION['initials'];

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
    <title>BeeCycle | User Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="profile.css" />
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>
    <main class="profile-dashboard-main">
      <section class="profile-dashboard">
        <div class="container profile-dashboard__layout">
          <article class="profile-card">
            <div class="profile-card__top">
              <div class="profile-card__avatar"><?php echo($initials); ?></div>
              <a href="edit-profile.php" class="profile-card__edit">Edit Profile</a>
            </div>

            <div class="profile-card__identity">
              <h1><?php echo htmlspecialchars($fullName); ?></h1>
              <p><?php echo htmlspecialchars($studentID); ?></p>
            </div>

            <dl class="profile-card__details">
              <div class="profile-card__row">
                <dt>Campus</dt>
                <dd><?php echo htmlspecialchars($campus !== '' ? $campus : '—'); ?></dd>
              </div>
              <div class="profile-card__row">
                <dt>Phone</dt>
                <dd><?php echo htmlspecialchars($whatsapp !== '' ? $whatsapp : '—'); ?></dd>
              </div>
              <div class="profile-card__row">
                <dt>Email</dt>
                <dd><?php echo htmlspecialchars($email !== '' ? $email : '—'); ?></dd>
              </div>
            </dl>
          </article>

          <section class="listing-panel" aria-labelledby="active-listings-title">
            <div class="listing-panel__header">
              <h2 id="active-listings-title">My Active Listings</h2>
              <a href="../marketplace/sellItem.php" class="listing-panel__action">Add New Item</a>
            </div>

            <div class="listing-grid">
              <?php foreach ($listings as $listing): ?>
              <?php
                $badge = $listing['conditionName'] === 'LikeNew' ? 'Like New' : $listing['conditionName'];
                $editUrl = '../marketplace/edit-listing.php?id=' . $listing['itemID'];
              ?>
              <article
                class="listing-card"
                onclick="window.location.href='<?php echo($editUrl); ?>'"
                onkeydown="if(event.key==='Enter' || event.key===' '){ event.preventDefault(); window.location.href='<?php echo($editUrl); ?>'; }"
                tabindex="0"
                role="link"
                aria-label="Open edit listing page for <?php echo($listing['itemTitle']); ?>"
              >
                <div class="listing-card__badge"><?php echo($badge); ?></div>
                <img src="../marketplace/item-image.php?id=<?php echo($listing['itemID']); ?>" alt="<?php echo($listing['itemTitle']); ?>" class="listing-card__image" />
                <div class="listing-card__content">
                  <p class="listing-card__price"><?php echo htmlspecialchars(formatPriceDisplay($listing['price'])); ?></p>
                  <h3><?php echo($listing['itemTitle']); ?></h3>
                  <p class="listing-card__subtitle"><?php echo($listing['description']); ?></p>
                  <div class="listing-card__meta">
                    <span class="listing-card__location">
                      <img src="../assets/icons/pin.svg" alt="" />
                      <?php echo($listing['COD']); ?>
                    </span>
                    <span><?php echo timeAgo($listing['postedDate']); ?></span>
                  </div>
                </div>
              </article>
              <?php endforeach; ?>
            </div>
          </section>
        </div>
      </section>
    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
