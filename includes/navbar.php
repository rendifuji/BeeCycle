<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

$loggedIn = isset($_SESSION['studentID']);
$initials = 'U';
if (isset($_SESSION['initials'])) {
    $initials = $_SESSION['initials'];
}

$page = $_SERVER['PHP_SELF'];
$inAdmin = strpos($page, '/admin/') !== false;
$inAuth = strpos($page, '/auth/') !== false;
$inUser = strpos($page, '/user/') !== false;
$inMarketplace = strpos($page, '/marketplace/') !== false;
$isHomepage = strpos($page, 'homepage.php') !== false;
$isLanding = strpos($page, 'index.php') !== false;

$marketplaceHome = 'homepage.php';
if ($inUser || $inAuth || $inAdmin) {
    $marketplaceHome = '../marketplace/homepage.php';
}

$searchValue = '';
if (isset($_GET['q'])) {
    $searchValue = htmlspecialchars(trim($_GET['q']));
}

$showNavbarSearch = $inUser || $inMarketplace || $isHomepage;

$adminPage = $inAdmin ? basename($page) : '';
?>

<header class="navbar">
  <div class="container">

    <?php if ($inAdmin) { ?>
      <a href="../index.php" class="logo"><span>Bee</span>Cycle</a>
      <nav>
        <ul>
          <li><a href="dashboard.php"<?php echo $adminPage === 'dashboard.php' ? ' class="active"' : ''; ?>>Dashboard</a></li>
          <li><a href="manageUser.php"<?php echo $adminPage === 'manageUser.php' ? ' class="active"' : ''; ?>>Manage Users</a></li>
          <li><a href="manageListing.php"<?php echo $adminPage === 'manageListing.php' ? ' class="active"' : ''; ?>>Manage Listings</a></li>
        </ul>
      </nav>
      <div class="buttons">
        <div class="avatar">AD</div>
        <button type="button" class="btn" onclick="window.location.href='../index.php'">Exit Admin</button>
      </div>

    <?php } elseif ($inAuth) { ?>
      <a href="../index.php" class="logo"><span>Bee</span>Cycle</a>

    <?php } elseif ($isLanding) { ?>
      <a href="index.php" class="logo"><span>Bee</span>Cycle</a>
      <nav>
        <ul>
          <li><a href="marketplace/homepage.php">Marketplace</a></li>
          <li><a href="#benefits">How it Works</a></li>
          <li><a href="#categories">Categories</a></li>
        </ul>
      </nav>
      <div class="buttons">
        <?php if ($loggedIn) { ?>
          <a href="marketplace/homepage.php">Browse Marketplace</a>
          <a class="btn btn-secondary" href="user/user-profile-dashboard.php">My Profile</a>
        <?php } else { ?>
          <a href="auth/logIn.php">Log In</a>
          <a class="btn btn-secondary" href="auth/register.php">Sign Up</a>
        <?php } ?>
      </div>

    <?php } elseif ($inUser) { ?>
      <a href="../marketplace/homepage.php" class="logo"><span>Bee</span>Cycle</a>
      <nav>
        <div class="search">
          <img src="../assets/icons/search.svg" alt="" />
          <input type="text" id="navbar-search" value="<?php echo $searchValue; ?>" placeholder="Search for textbooks, electronics, etc..." onkeydown="if(event.key==='Enter'){goMarketplaceSearch();}" />
        </div>
      </nav>
      <div class="buttons">
        <?php if ($loggedIn) { ?>
          <a href="wishlist.php">Wishlist</a>
          <a class="btn btn-secondary" href="../marketplace/sellItem.php"><img src="../assets/icons/plus.svg" alt="" />Sell Item</a>
          <a class="avatar" href="user-profile-dashboard.php"><?php echo $initials; ?></a>
          <a href="../auth/logout.php">Log out</a>
        <?php } else { ?>
          <a href="../auth/logIn.php">Log In</a>
          <a class="btn btn-secondary" href="../auth/register.php">Sign Up</a>
        <?php } ?>
      </div>

    <?php } elseif ($isHomepage) { ?>
      <a href="homepage.php" class="logo"><span>Bee</span>Cycle</a>
      <nav>
        <div class="search">
          <img src="../assets/icons/search.svg" alt="" />
          <input type="text" id="navbar-search" value="<?php echo $searchValue; ?>" placeholder="Search for textbooks, electronics, etc..." onkeydown="if(event.key==='Enter'){goMarketplaceSearch();}" />
        </div>
      </nav>
      <div class="buttons">
        <?php if ($loggedIn) { ?>
          <a href="../user/wishlist.php">Wishlist</a>
          <a class="btn btn-secondary" href="sellItem.php"><img src="../assets/icons/plus.svg" alt="" />Sell Item</a>
          <a class="avatar" href="../user/user-profile-dashboard.php"><?php echo $initials; ?></a>
          <a href="../auth/logout.php">Log out</a>
        <?php } else { ?>
          <a href="../auth/logIn.php">Log In</a>
          <a class="btn btn-secondary" href="../auth/register.php">Sign Up</a>
        <?php } ?>
      </div>

    <?php } elseif ($inMarketplace) { ?>
      <a href="homepage.php" class="logo"><span>Bee</span>Cycle</a>
      <nav>
        <div class="search">
          <img src="../assets/icons/search.svg" alt="" />
          <input type="text" id="navbar-search" value="<?php echo $searchValue; ?>" placeholder="Search for textbooks, electronics, etc..." onkeydown="if(event.key==='Enter'){goMarketplaceSearch();}" />
        </div>
      </nav>
      <div class="buttons">
        <?php if ($loggedIn) { ?>
          <a href="../user/wishlist.php">Wishlist</a>
          <a class="btn btn-secondary" href="sellItem.php"><img src="../assets/icons/plus.svg" alt="" />Sell Item</a>
          <a class="avatar" href="../user/user-profile-dashboard.php"><?php echo $initials; ?></a>
          <a href="../auth/logout.php">Log out</a>
        <?php } else { ?>
          <a href="../auth/logIn.php">Log In</a>
          <a class="btn btn-secondary" href="../auth/register.php">Sign Up</a>
        <?php } ?>
      </div>
    <?php } ?>

  </div>
</header>

<?php if ($showNavbarSearch) { ?>
<script>
function goMarketplaceSearch() {
  var input = document.getElementById('navbar-search');
  if (!input) return;

  var q = input.value.trim();
  var form = document.getElementById('homepage-filters');

  if (form) {
    var qField = form.querySelector('input[name="q"]');
    if (!qField) {
      qField = document.createElement('input');
      qField.type = 'hidden';
      qField.name = 'q';
      form.appendChild(qField);
    }
    qField.value = q;
    form.submit();
    return;
  }

  var url = '<?php echo $marketplaceHome; ?>';
  if (q) {
    url += '?q=' + encodeURIComponent(q);
  }
  window.location.href = url;
}
</script>
<?php } ?>
