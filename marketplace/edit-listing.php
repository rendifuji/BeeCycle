<?php
  include '../db_connection.php';
  
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
      categoryID = '$category',
      conditionID = '$condition',
      price = '$price',
      description = '$description',
      COD = '$meetingspot',
      itemPhoto = '$itemphoto'
      WHERE itemID = '$itemID'
      ";

      $p = mysqli_query($conn, $query);
      if($p){
        header("Location: ../user/user-profile-dashboard.php");
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
    <?php include '../includes/navbar.php'; ?>
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
                          <option value="CA003">Textbooks</option>
                          <option value="CA001">Electronics</option>
                          <option value="CA004">Dorm Essentials</option>
                          <option value="CA002">Uniforms</option>
                          <option value="CA005">Art Supplies</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-field">
                      <label for="condition">Condition</label>
                      <div class="select-wrap">
                        <select id="condition" name="condition">
                          <option value="" selected disabled>Select condition</option>
                          <option value="CO001">New</option>
                          <option value="CO002">Like New</option>
                          <option value="CO003">Used</option>
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
                    <a href="../user/user-profile-dashboard.php" class="btn-cancel">Cancel</a>
                    <button type="submit" class="btn-save">Save Changes</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="./edit-listing.js"></script>
  </body>
</html>
