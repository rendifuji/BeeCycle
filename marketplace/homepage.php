<?php
  include '../db_connection.php';

  $query = "SELECT * from item";
  
  $result = mysqli_query($conn , $query);
  $items = [];

  while( $row = mysqli_fetch_assoc($result)){
    $items[] = $row;
  };





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

    <main>
      <div class="list-container">
        <section class="filter-container">
          <div class="filters">
            <h1>Filters</h1> <span class="gray">Clear all</span>
          </div>
          <article class="campus">
            <h2>Campus</h2>
            <label><input type="checkbox" name="campuses" id="kmg">Binus@Kemanggisan</label>
            <label><input type="checkbox" name="campuses" id="alsut">Binus@Alam Sutera</label>
            <label><input type="checkbox" name="campuses" id="bks">Binus@Bekasi</label>
            <label><input type="checkbox" name="campuses" id="mal">Binus@Malang</label>
            <label><input type="checkbox" name="campuses" id="sem">Binus@Semarang</label>
            <label><input type="checkbox" name="campuses" id="ban">Binus@Bandung</label>
          </article>

          <article class="categories">
            <h2>Categories</h2>
            <label><input type="radio" name="categories" id="text">Textbook</label>
            <label><input type="radio" name="categories" id="elec">Electronics</label>
            <label><input type="radio" name="categories" id="dorm">Dorm Essentials</label>
            <label><input type="radio" name="categories" id="unif">Uniforms</label>
            <label><input type="radio" name="categories" id="arts">Art Supplies</label>
          </article>

          <button type="button">Apply</button>
        </section>

        <section class="listings">
          <nav>
            <h2>Fresh Listings</h2>
            <sorting>
              <label for="sort">Sort By:</label>
              <select name="sort" id="options">
                <option value="placeholder" disabled hidden selected>Sort By:</option>
                <option value="new">Newest First</option>
                <option value="old">Oldest First</option>
              </select>
            </sorting>
          </nav>
          <div class="grid-container">
            <?php foreach($items as $item):?>
            <div class="card" onclick="window.location.href = 'product-detail.php?id=<?php echo htmlspecialchars($item['itemID'] ?? '');?>'">
              <span class="like">Like New</span>
              <img src="item-image.php?id=<?php echo($item['itemID']); ?>" alt="">
              <span class="price"><?php echo($item['price'])?></span>
              <span class="name"><h3><?php echo ($item['itemTitle'])?></h3></span>
              <div class="cardbot"> 
                <span>Binus Kemanggisan</span>
                <span><?php echo htmlspecialchars($item['postedDate'] ?? 'Recently');?></span>
              </div>
            </div>
            <?php endforeach;?>
          </div>
        </section>
        </div>
      </div>


    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
