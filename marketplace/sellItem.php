<?php
session_start();
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $itemTitle = $_POST['itemTitle'];
    $category = $_POST['category'];
    $itemCondition = $_POST['itemCondition'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $COD = $_POST['COD'];
    $itemPhoto = $_POST['itemPhoto'];

    $stmt = $conn -> prepare("INSERT INTO item
    (itemTitle, category, itemCondition, price, description, COD, itemPhoto)
    VALUES (?, ?, ?, ?, ?, ?, ?)");


    $stmt->bind_param(
        "issssssb",
        $itemTitle,
        $category,
        $itemCondition,
        $price,
        $description,
        $COD,
        $itemPhoto
    );
    $stmt->execute();

    $stmt->close();
    $conn->close();

    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeeCycle</title>
    <link rel="stylesheet" href="Sellitem.css">
</head>
<body>

    <header class="navbar">
      <div class="container">
        <div class="logo"><span>Bee</span>Cycle</div> 
        <nav>
          <div class="search">
            <img src="BeeCycle-main/assets/icons/search.svg" />
            <input type="text" placeholder="Search for textbooks, electronics, etc..." />
          </div>
        </nav>

        <div class="right-section">
             <div class="buttons">
             <a href="sell.item.html">+ Sell item</a>
             </div>

            <div class="pic">YS</div>
        </div>
    </header>
  
    <div class="judul">
        <h1>List an Item for Sell</h1>
        <p>Declutter your dorm and make some extra cash, Fill out the detail below.</p>
    </div>

    <main class="ListingSection">

        <form class="itemForm" action="sellItem.php" method="POST" enctype="multipart/form-data">

            <div class="form-item">
                <label>Item Title</label>
                <input type="text" id="itemTitle" name="itemTitle" placeholder="e.g.,Laptop">
                <small class="helper">Keep it clear and descriptive.</small>
                <small class="error" id="ItemTitleError"></small>
            </div>

            <div class="row1">
                <div class="form-item">
                    <label>Category</label>
                    <select id="category" name="category" placeholder="Select a category...">
                        <option value="" disabled selected>Select category...</option>
                        <option value="Textbooks">Textbooks</option>
                        <option value="Electronics">Electronics</option>
                        <option value="DormEssentails">Dorm Essentails</option>
                        <option value="Uniforms">Uniforms</option>
                        <option value="ArtSupplies">Art Supplies</option>
                    </select>
                    <small class="error" id="CategoryError"></small>
                </div>
                <div class="form-item">
                    <label>Condition</label>
                    <select id="itemCondition" name="itemCondition" placeholder="Select condition...">
                        <option value="" disabled selected>Select condition...</option>
                        <option value="New">New</option>
                        <option value="LikeNew">Like New</option>
                        <option value="Used">Used</option>
                    </select>
                    <small class="error" id="ConditionError"></small>
                </div>
            </div>

            <div class="form-item">
                <label>Price</label>
                <input type="text" id="price" name="price" placeholder="e.g.,Rp150.000">
                <small class="error" id="PriceError"></small>
            </div>

            <div class="form-item">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" placeholder="Describe the item's features, any flaws, and reason for selling..."></textarea>
                <small class="error" id="DescriptionError"></small>
            </div>

            <div class="form-item">
                <label>Preferred Meeting Spot(COD)</label>
                <Input type="text" id="COD" name="COD" placeholder="e.g.,BeeHub" >
                <small class="error" id="CODError"></small>   
            </div>
            
            <div class="form-item">
                <label>Item Photo</label>
                <input type="file" id="itemPhoto" name="itemPhoto" accept="image/*">
                <small class="helper">Upload a clear picture of your item (JPG or PNG only)</small>
                <small class="error" id="ItemPhotoError"></small>
            </div>

            <div class="button-group">
                <button type="button" id="Cancel">Cancel</button>
                <button type="submit" id="Post">Post Listing</button>
            </div>
        </form>
    </main>

    <footer>
          &copy; 2026 BeeCycle Marketplace. All rights reserved.
      </div>
    </footer>

    <!-- <script src="Sellitem.js" defer></script> -->
    
</body>
</html>