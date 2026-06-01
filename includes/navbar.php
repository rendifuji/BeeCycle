<?php
session_start();

$loggedIn = isset($_SESSION['studentID']);
$initials = 'U';
if (isset($_SESSION['initials'])) {
    $initials = $_SESSION['initials'];
}

// figure out which section of the site we are on
$page = $_SERVER['PHP_SELF'];
$inAdmin = strpos($page, '/admin/') !== false;
$inAuth = strpos($page, '/auth/') !== false;
$inUser = strpos($page, '/user/') !== false;
$inMarketplace = strpos($page, '/marketplace/') !== false;
$isHomepage = strpos($page, 'homepage.php') !== false;
$isLanding = strpos($page, 'index.php') !== false;
?>

<header class="navbar">
  <div class="container">

    <?php if ($inAdmin) { ?>
      <a href="../index.php" class="logo"><span>Bee</span>Cycle</a>
      <nav>
        <ul>
          <li><a href="dashboard.php">Dashboard</a></li>
          <li><a href="manageUser.php">Manage Users</a></li>
          <li><a href="manageListing.php">Manage Listings</a></li>
        </ul>
      </nav>
      <div class="buttons">
        <div class="avatar">NS</div>
        <button type="button" class="btn" onclick="window.location.href='../index.php'">Exit Admin</button>
      </div>

    <?php } elseif ($inAuth) { ?>
      <a href="../index.php" class="logo"><span>Bee</span>Cycle</a>

    <?php } elseif ($isLanding) { ?>
      <a href="index.php" class="logo"><span>Bee</span>Cycle</a>
      <nav>
        <ul>
          <li><a href="#benefits">How it Works</a></li>
          <li><a href="#categories">Categories</a></li>
          <li><a href="#">About Us</a></li>
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
          <input type="text" placeholder="Search for textbooks, electronics, etc..." />
        </div>
      </nav>
      <div class="buttons">
        <?php if ($loggedIn) { ?>
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
          <input type="text" id="name-search" onchange="search()" placeholder="Search for textbooks, electronics, etc..." />
        </div>
      </nav>
      <div class="buttons">
        <?php if ($loggedIn) { ?>
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
          <input type="text" placeholder="Search for textbooks, electronics, etc..." />
        </div>
      </nav>
      <div class="buttons">
        <?php if ($loggedIn) { ?>
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
