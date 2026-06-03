<?php
include '../includes/student-check.php';

$sellErrors = $_SESSION['sell_errors'] ?? [];
unset($_SESSION['sell_errors']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BeeCycle | Sell Item</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../marketplace.css" />
    <link rel="stylesheet" href="Sellitem.css">
</head>
<body>

    <?php include '../includes/navbar.php'; ?>

    <main class="sell-main">
        <div class="sell-shell">
            <header class="sell-header">
                <h1>List an Item for Sale</h1>
                <p>Declutter your dorm and make some extra cash. Fill out the details below.</p>
                <?php if (!empty($sellErrors)) { ?>
                <ul class="sell-errors">
                    <?php foreach ($sellErrors as $error) { ?>
                    <li><?php echo htmlspecialchars($error); ?></li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </header>

            <div class="sell-card">
                <form class="itemForm" action="processSellItem.php" method="POST" enctype="multipart/form-data">
                    <div class="form-item">
                        <label for="itemTitle">Item Title</label>
                        <input type="text" id="itemTitle" name="itemTitle" placeholder="e.g., Laptop" />
                        <small class="helper">Keep it clear and descriptive.</small>
                        <small class="error" id="ItemTitleError"></small>
                    </div>

                    <div class="form-row">
                        <div class="form-item">
                            <label for="category">Category</label>
                            <select id="category" name="category">
                                <option value="" disabled selected>Select category...</option>
                                <option value="CA003">Textbooks</option>
                                <option value="CA001">Electronics</option>
                                <option value="CA004">Dorm Essentials</option>
                                <option value="CA002">Uniforms</option>
                                <option value="CA005">Art Supplies</option>
                            </select>
                            <small class="error" id="CategoryError"></small>
                        </div>
                        <div class="form-item">
                            <label for="itemCondition">Condition</label>
                            <select id="itemCondition" name="itemCondition">
                                <option value="" disabled selected>Select condition...</option>
                                <option value="CO001">New</option>
                                <option value="CO002">Like New</option>
                                <option value="CO003">Used</option>
                            </select>
                            <small class="error" id="ConditionError"></small>
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="price">Price (IDR)</label>
                        <input type="number" id="price" name="price" min="1" step="1" placeholder="e.g. 150000" />
                        <small class="helper">Numbers only — shown as Rp 150.000 on listings.</small>
                        <small class="error" id="PriceError"></small>
                    </div>

                    <div class="form-item">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" rows="4" placeholder="Describe the item's features, any flaws, and reason for selling..."></textarea>
                        <small class="error" id="DescriptionError"></small>
                    </div>

                    <div class="form-row">
                        <div class="form-item">
                            <label for="CampusLocation">Campus Location</label>
                            <select id="CampusLocation" name="CampusLocation">
                                <option value="" disabled selected>Select your campus...</option>
                                <option value="Binus@Kemanggisan">Binus@Kemanggisan</option>
                                <option value="Binus@Alam Sutera">Binus@Alam Sutera</option>
                                <option value="Binus@Bekasi">Binus@Bekasi</option>
                                <option value="Binus@Malang">Binus@Malang</option>
                                <option value="Binus@Semarang">Binus@Semarang</option>
                                <option value="Binus@Bandung">Binus@Bandung</option>
                            </select>
                            <small class="error" id="LocationError"></small>
                        </div>

                        <div class="form-item">
                            <label for="COD">Preferred Meeting Spot (COD)</label>
                            <input type="text" id="COD" name="COD" placeholder="e.g., BeeHub" />
                            <small class="error" id="CODError"></small>
                        </div>
                    </div>

                    <div class="form-item">
                        <label for="itemPhoto">Item Photo</label>
                        <input type="file" id="itemPhoto" name="itemPhoto" accept="image/*" />
                        <small class="helper">Upload a clear picture of your item (JPG or PNG only)</small>
                        <small class="error" id="ItemPhotoError"></small>
                    </div>

                    <div class="button-group">
                        <button type="button" id="Cancel" onclick="window.location.href='homepage.php'">Cancel</button>
                        <button type="submit" id="Post">Post Listing</button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="Sellitem.js" defer></script>
</body>
</html>
