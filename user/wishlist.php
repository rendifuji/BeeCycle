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

    <div class="judul">
      <h1>My Saved Items</h1>
      <p>Keep track of the things you want to buy later.</p>
    </div>

    <main class="container wishlist-page">
      <div class="wishlist">
        <?php for ($i = 0; $i < 6; $i++) { ?>
        <div class="card">
          <div class="badge">Like New</div>
          <div class="heart">&#10084;</div>
          <img src="../assets/headphones.jpeg" alt="Sony WH-1000XM4 Wireless Headphones" />
          <h3>Rp 1.850.000</h3>
          <p class="title">Sony WH-1000XM4 Wireless Headphones</p>
          <div class="info">
            <span>Kampus Anggrek</span>
            <span>2 hrs ago</span>
          </div>
        </div>
        <?php } ?>
      </div>
    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
