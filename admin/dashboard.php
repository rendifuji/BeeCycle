<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../admin.css" />
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>

    <main>
      <div class="container">
        <section class="overview">
          <header>
            <h1>System Overview</h1>
            <p>
              Welcome back. Here is the current status of the BeeCycle platform.
            </p>
          </header>
          <div class="cards">
            <div class="users">
              <div>
                <p>Total Registered Users</p>
                <span>1,248</span>
              </div>
              <img src="../assets/icons/users.svg" />
            </div>
            <div class="listings">
              <div>
                <p>Total Active Listings</p>
                <span>853</span>
              </div>
              <img src="../assets/icons/box.svg" />
            </div>
          </div>
        </section>
        <section class="tools">
          <header>
            <h1>Moderation Tools</h1>
          </header>
          <div>
            <a href="manageUser.php" class="card">
              <p>Review &amp; Manage Users</p>
              <img src="../assets/icons/right.svg" alt="arrow" />
            </a>
            <a href="manageListing.php" class="card">
              <p>Review &amp; Remove Listings</p>
              <img src="../assets/icons/right.svg" alt="arrow" />
            </a>
          </div>
        </section>
      </div>
    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
