<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeeCycle</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="Sellitem.css">
</head>
<body>

    <?php include '../includes/navbar.php'; ?>
  
    <div class="judul">
        <h1>List an Item for Sell</h1>
        <p>Declutter your dorm and make some extra cash, Fill out the detail below.</p>
    </div>

    <main class="ListingSection">

        <form class="itemForm" action="processSellItem.php" method="POST" enctype="multipart/form-data">

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

    <?php include '../includes/footer.php'; ?>

    <!-- <script src="Sellitem.js" defer></script> -->
    
</body>
</html>