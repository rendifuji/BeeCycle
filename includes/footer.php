<?php
$page = $_SERVER['PHP_SELF'];
$inAdmin = strpos($page, '/admin/') !== false;
$isLanding = strpos($page, 'index.php') !== false;
?>

<footer>
  <div class="container">
    <?php if ($isLanding) { ?>
      <div class="top">
        <a href="index.php" class="logo"><span>Bee</span>Cycle</a>
        <img class="sdg" src="assets/SDG12.png" alt="SDG 12 badge" />
      </div>
    <?php } ?>
    <p class="copyright">&copy; 2026 BeeCycle Marketplace. All rights reserved.</p>
    <?php if ($inAdmin) { ?>
      <p>Admin Panel v1.0</p>
    <?php } ?>
  </div>
</footer>
