<?php
  include '../db_connection.php';
  


  $itemID= isset($_GET['id']) ? intval($_GET['id']): 0;

  if($itemID ===0){
    die("invalid ID");
  }
  else{
    $query = "SELECT i.itemID, i.itemTitle, i.price, i.description, i.COD, u.fullName, u.campus, u.whatsapp, i.postedDate, c.categoryName
    FROM item i JOIN user u ON i.studentID = u.studentID JOIN categories c ON i.categoryID = c.categoryID WHERE i.itemID = $itemID";
  
    $result = mysqli_query($conn, $query);
    $item = mysqli_fetch_assoc($result);
    $posted = $item['postedDate'];
    $created= date("Y-m-d H:i:s", strtotime($posted));

  }



?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeeCycle | Product Detail</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../marketplace.css" />
    <link rel="stylesheet" href="prodetail.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>
    <main>
      <div class="det-container">
        <nav>
          Home /<?php echo($item['categoryName']); echo("/"); echo($item['itemTitle'])?>
        </nav>

        <section class="prodetail-container">
          <img src="item-image.php?id=<?php echo($item['itemID']); ?>" alt="headphones">
          <div class="prodetail">
            <span class="like">Like New</span>
            <h1><?php echo($item['itemTitle'])?></h1>
            <span class="price"> <h1><?php echo($item['price'])?></h1></span>
            <div class="tags">
              <?php echo($item['categoryName'])?>
              <span class="gray"><?php echo $created?></span>
            </div>

            <h3>Description</h3>
            <p><?php echo($item['description'])?></p>

            <contact>
              <div class="selldata">
                <div class="avatar">YS</div>


                <div class="">
                  <h3><?php echo($item['fullName'])?></h3>
                  <span class="gray"><?php echo($item['COD'])?></span>
                </div>

                <div class="">
                  <h3>Verified Binusian</h3>
                  <span class="gray">Joined Mar 2026</span>
                </div>
              </div>
            </contact>

            <div class="contact" onclick="window.location.href = 'https://wa.me/6282124201160'">
              <button type="button" id="seller">
                <i class="fa-brands fa-whatsapp"></i>
                <?php echo($item['whatsapp'])?>
              </button>
              
              <button type="button" id="heart">
                <i class="fa-solid fa-heart" ></i>

              </button>
            </div>
          </div>
          

        </section>


        <section class="more">
          <?php
            $query =  "SELECT i.itemID, i.itemTitle, i.price, i.description, i.COD, u.fullName, u.campus, u.whatsapp, i.postedDate FROM item i JOIN user u ON i.studentID = u.studentID";
            $result =mysqli_query($conn,$query);
            $items = [];
            while ($row = mysqli_fetch_assoc($result)){
              $items[] = $row;
            }
          ?>
          <h1>More Items like this</h1>

          <div class="grid-container">
            <?php foreach($items as $similiaritem):?>
              <div class="card" onclick="window.location.href = 'product-detail.php?id=<?php echo htmlspecialchars($similiaritem['itemID'] ?? '');?>'">
                <span class="like">Like New</span>
                <img src="item-image.php?id=<?php echo($similiaritem['itemID']); ?>" alt="">
                <span class="price"><?php echo($similiaritem['price'])?></span>
                <h3><?php echo ($similiaritem['itemTitle'])?> </h3>
                <div class="cardbot"> 
                  <span><?php echo($similiaritem['COD'])?></span>
                  <span>2 hrs ago</span>
                </div>
              </div>
            <?php endforeach;?>
            </div>

          
        </section>

      </div>


    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
