<?php
  include __DIR__.("/../db_connection.php");
  
  $itemID= isset($_GET['id']) ? intval($_GET['id']): 0;
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $itemphoto = $_POST['item-photo'];
    $itemtitle = $_POST['item-title'];
    $category = $_POST['category'];
    $condition = $_POST ['condition'];
    $price = $_POST ['price'];
    $description = $_POST ['description'];
    $campuslocation = $_POST ['campus-location'];
    $meetingspot = $_POST ['meeting-spot'];


    if($itemID ===0){
      die("invalid ID");
    }else{
      $query = "UPDATE item SET 
      itemTitle = '$itemtitle',
      category = '$category',
      itemCondition = '$condition',
      price = '$price',
      description = '$description',
      COD = '$meetingspot',
      itemPhoto = '$itemphoto'
      WHERE id = '$itemID'
      ";

      $p = mysqli_query($conn, $query);
      if($p){
        header("Location: ../user/user-profile-dashboard.html ");
      }
    }





  }





?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeeCycle | Edit Listing</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="./edit-listing.css" />
  </head>
  <body>
    <header class="navbar">
      <div class="container">
        <a href="homepage.php" class="logo"><span>Bee</span>Cycle</a>
        <nav>
          <div class="search">
            <img src="../assets/icons/search.svg" />
            <input type="text" placeholder="Search for textbooks, electronics, etc..." />
          </div>
        </nav>
        <div class="buttons">
          <a class="btn btn-secondary" href="sellItem.php"><img src="../assets/icons/plus.svg" alt="" />Sell Item</a>
          <div class="avatar">YS</div>
        </div>
      </div>
    </header>
    <main class="edit-listing-main">
      <section class="edit-listing-section">
        <div class="container">
          <div class="edit-listing-shell">
            <div class="edit-listing-heading">
              <h1>Edit Listing</h1>
              <p>Update your item's details, price, or upload a new photo.</p>
            </div>

            <form class="edit-listing-form" action="" method="POST" novalidate>
              <div class="edit-listing-layout">
                <aside class="listing-photo-panel">
                  <div class="listing-photo-preview">
                    <img src="../assets/Headphones.jpeg" alt="Listing item preview" />
                  </div>

                  <input type="hidden" name="item-id" value="<?php echo($itemID)?>">

                  <div class="form-field form-field--file">
                    <label for="item-photo">Item Photo</label>
                    <input id="item-photo" name="item-photo" type="file" accept=".jpg,.jpeg,.png" />
                    <p>Upload a clear picture of your item (JPG or PNG only)</p>
                  </div>
                </aside>

                <div class="listing-form-panel">
                  <div class="form-field">
                    <label for="item-title">Item Title</label>
                    <input
                      id="item-title"
                      name="item-title"
                      type="text"
                      placeholder="Enter your item title"
                    />
                  </div>

                  <div class="edit-listing-grid">
                    <div class="form-field">
                      <label for="category">Category</label>
                      <div class="select-wrap">
                        <select id="category" name="category">
                          <option value="" selected disabled>Select a category</option>
                          <option>Textbooks</option>
                          <option>Electronics</option>                         
                          <option>Dorm Essentials</option>
                          <option>Uniforms</option>
                          <option>Art Supplies</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-field">
                      <label for="condition">Condition</label>
                      <div class="select-wrap">
                        <select id="condition" name="condition">
                          <option value="" selected disabled>Select condition</option>
                          <option>Like New</option>
                          <option>Good</option>
                          <option>Fair</option>
                          <option>Used</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-field">
                    <label for="price">Price</label>
                    <input
                      id="price"
                      name="price"
                      type="text"
                      placeholder="Enter your item price"
                    />
                  </div>

                  <div class="form-field">
                    <label for="description">Description</label>
                    <textarea
                      id="description"
                      name="description"
                      placeholder="Describe your item's features, flaws, and reason for selling..."
                    ></textarea>
                  </div>

                  <div class="edit-listing-grid">
                    <div class="form-field">
                      <label for="campus-location">Campus Location</label>
                      <div class="select-wrap">
                        <select id="campus-location" name="campus-location">
                          <option value="" selected disabled>Select your campus location</option>
                          <option>BINUS @ Kemanggisan</option>
                          <option>BINUS @ Alam Sutera</option>
                          <option>BINUS @ Bekasi</option>
                          <option>BINUS @ Malang</option>
                          <option>BINUS @ Semarang</option>
                          <option>BINUS @ Bandung</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-field">
                      <label for="meeting-spot">Preferred Meeting Spot (COD)</label>
                      <input
                        id="meeting-spot"
                        name="meeting-spot"
                        type="text"
                        placeholder="Enter preferred meeting spot"
                      />
                    </div>
                  </div>

                  <div class="edit-listing-actions">
                    <a href="../user/user-profile-dashboard.html" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Save Changes</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>

    <footer>
      <div class="container">
        <p class="copyright">
          &copy; 2026 BeeCycle Marketplace. All rights reserved.
        </p>
      </div>
    </footer>
    <script src="./edit-listing.js"></script>
  </body>
</html>
