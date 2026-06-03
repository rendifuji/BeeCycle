<?php
  include '../includes/student-check.php';
  include '../db_connection.php';
  include '../includes/price-format.php';

  $itemID = isset($_GET['id']) ? intval($_GET['id']) : 0;
  $studentID = $_SESSION['studentID'];

  if ($itemID === 0) {
    die('invalid ID');
  }

  $query = "SELECT * FROM item WHERE itemID = $itemID AND studentID = '$studentID'";
  $result = mysqli_query($conn, $query);
  $item = mysqli_fetch_assoc($result);

  if (!$item) {
    die('Listing not found.');
  }

  $userQuery = "SELECT campus FROM user WHERE studentID = '$studentID'";
  $userResult = mysqli_query($conn, $userQuery);
  $user = mysqli_fetch_assoc($userResult);

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $itemtitle = $_POST['item-title'];
    $category = $_POST['category'];
    $condition = $_POST['condition'];
    $price = normalizePriceInput($_POST['price'] ?? '');
    if (!isValidPriceInput($price)) {
      die('Invalid price.');
    }
    $description = $_POST['description'];
    $campuslocation = $_POST['campus-location'];
    $meetingspot = $_POST['meeting-spot'];

    $hasNewPhoto = isset($_FILES['item-photo']) && $_FILES['item-photo']['error'] === UPLOAD_ERR_OK;
    $itemPhotoBlob = null;
    if ($hasNewPhoto) {
      $itemPhotoBlob = file_get_contents($_FILES['item-photo']['tmp_name']);
    }

    if ($hasNewPhoto && $itemPhotoBlob !== false && strlen($itemPhotoBlob) > 0) {
      $stmt = $conn->prepare(
        "UPDATE item SET itemTitle = ?, categoryID = ?, conditionID = ?, price = ?, description = ?, COD = ?, itemPhoto = ?
         WHERE itemID = ? AND studentID = ?"
      );
      $blobParam = null;
      $stmt->bind_param(
        'ssssssbis',
        $itemtitle,
        $category,
        $condition,
        $price,
        $description,
        $meetingspot,
        $blobParam,
        $itemID,
        $studentID
      );
      $stmt->send_long_data(6, $itemPhotoBlob);
      $updated = $stmt->execute();
      $stmt->close();
    } else {
      $stmt = $conn->prepare(
        "UPDATE item SET itemTitle = ?, categoryID = ?, conditionID = ?, price = ?, description = ?, COD = ?
         WHERE itemID = ? AND studentID = ?"
      );
      $stmt->bind_param(
        'ssssssis',
        $itemtitle,
        $category,
        $condition,
        $price,
        $description,
        $meetingspot,
        $itemID,
        $studentID
      );
      $updated = $stmt->execute();
      $stmt->close();
    }

    if ($campuslocation != '') {
      $campusQuery = "UPDATE user SET campus = '$campuslocation' WHERE studentID = '$studentID'";
      mysqli_query($conn, $campusQuery);
    }

    if ($updated) {
      header('Location: ../user/user-profile-dashboard.php');
      exit();
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

            <form class="edit-listing-form" action="edit-listing.php?id=<?php echo($itemID); ?>" method="POST" enctype="multipart/form-data" novalidate>
              <div class="edit-listing-layout">
                <aside class="listing-photo-panel">
                  <div class="listing-photo-preview">
                    <img src="item-image.php?id=<?php echo($itemID); ?>" alt="Listing item preview" />
                  </div>

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
                      value="<?php echo($item['itemTitle']); ?>"
                    />
                  </div>

                  <div class="edit-listing-grid">
                    <div class="form-field">
                      <label for="category">Category</label>
                      <div class="select-wrap">
                        <select id="category" name="category">
                          <option value="" disabled>Select a category</option>
                          <option value="CA003" <?php if ($item['categoryID'] == 'CA003') echo 'selected'; ?>>Textbooks</option>
                          <option value="CA001" <?php if ($item['categoryID'] == 'CA001') echo 'selected'; ?>>Electronics</option>
                          <option value="CA004" <?php if ($item['categoryID'] == 'CA004') echo 'selected'; ?>>Dorm Essentials</option>
                          <option value="CA002" <?php if ($item['categoryID'] == 'CA002') echo 'selected'; ?>>Uniforms</option>
                          <option value="CA005" <?php if ($item['categoryID'] == 'CA005') echo 'selected'; ?>>Art Supplies</option>
                        </select>
                      </div>
                    </div>

                    <div class="form-field">
                      <label for="condition">Condition</label>
                      <div class="select-wrap">
                        <select id="condition" name="condition">
                          <option value="" disabled>Select condition</option>
                          <option value="CO001" <?php if ($item['conditionID'] == 'CO001') echo 'selected'; ?>>New</option>
                          <option value="CO002" <?php if ($item['conditionID'] == 'CO002') echo 'selected'; ?>>Like New</option>
                          <option value="CO003" <?php if ($item['conditionID'] == 'CO003') echo 'selected'; ?>>Used</option>
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="form-field">
                    <label for="price">Price (IDR)</label>
                    <input
                      id="price"
                      name="price"
                      type="number"
                      min="1"
                      step="1"
                      placeholder="e.g. 150000"
                      value="<?php echo htmlspecialchars(normalizePriceInput($item['price'])); ?>"
                    />
                  </div>

                  <div class="form-field">
                    <label for="description">Description</label>
                    <textarea
                      id="description"
                      name="description"
                      placeholder="Describe your item's features, flaws, and reason for selling..."
                    ><?php echo($item['description']); ?></textarea>
                  </div>

                  <div class="edit-listing-grid">
                    <div class="form-field">
                      <label for="campus-location">Campus Location</label>
                      <div class="select-wrap">
                        <select id="campus-location" name="campus-location">
                          <option value="" disabled>Select your campus location</option>
                          <option value="Binus@Kemanggisan" <?php if ($user['campus'] == 'Binus@Kemanggisan') echo 'selected'; ?>>Binus@Kemanggisan</option>
                          <option value="Binus@Alam Sutera" <?php if ($user['campus'] == 'Binus@Alam Sutera') echo 'selected'; ?>>Binus@Alam Sutera</option>
                          <option value="Binus@Bekasi" <?php if ($user['campus'] == 'Binus@Bekasi') echo 'selected'; ?>>Binus@Bekasi</option>
                          <option value="Binus@Malang" <?php if ($user['campus'] == 'Binus@Malang') echo 'selected'; ?>>Binus@Malang</option>
                          <option value="Binus@Semarang" <?php if ($user['campus'] == 'Binus@Semarang') echo 'selected'; ?>>Binus@Semarang</option>
                          <option value="Binus@Bandung" <?php if ($user['campus'] == 'Binus@Bandung') echo 'selected'; ?>>Binus@Bandung</option>
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
                        value="<?php echo($item['COD']); ?>"
                      />
                    </div>
                  </div>

                  <div class="edit-listing-actions">
                    <button type="button" class="btn-delete" id="open-delete-modal">
                      <img src="../assets/icons/trash.svg" alt="" aria-hidden="true" />
                      Delete Listing
                    </button>
                    <div class="edit-listing-actions__primary">
                      <a href="../user/user-profile-dashboard.php" class="btn-cancel">Cancel</a>
                      <button type="submit" class="btn-save">Save Changes</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>

    <div id="listing-delete-modal" class="listing-delete-modal" hidden>
      <div class="listing-delete-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="listing-delete-title">
        <h2 id="listing-delete-title">Delete this listing?</h2>
        <p>This cannot be undone. The listing will be removed from the marketplace.</p>
        <form method="POST" action="delete-listing.php" class="listing-delete-modal__form">
          <input type="hidden" name="itemID" value="<?php echo (int) $itemID; ?>" />
          <div class="listing-delete-modal__actions">
            <button type="button" class="btn-modal-cancel" id="close-delete-modal">Cancel</button>
            <button type="submit" class="btn-modal-delete">
              <img src="../assets/icons/trash.svg" alt="" aria-hidden="true" />
              Yes, Delete
            </button>
          </div>
        </form>
      </div>
    </div>

    <?php include '../includes/footer.php'; ?>
    <script src="./edit-listing.js"></script>
  </body>
</html>
