<?php
include '../includes/admin-check.php';
include '../db_connection.php';

$query = "SELECT i.itemID, i.itemTitle, c.categoryName, i.postedDate, u.fullName
          FROM item i
          INNER JOIN user u ON i.studentID = u.studentID
          INNER JOIN categories c ON i.categoryID = c.categoryID
          ORDER BY i.postedDate DESC";

$result = $conn->query($query);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Manage Listings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../admin.css" />
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>

    <main>
      <div class="container">
        <section class="manage-listings">
          <header>
            <div>
              <h1>Manage Listings</h1>
              <p>Review and moderate all active marketplace items.</p>
            </div>
          </header>

          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>ITEM TITLE</th>
                  <th>SELLER</th>
                  <th>CATEGORY</th>
                  <th>POSTED DATE</th>
                  <th>ACTIONS</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['itemTitle']); ?></td>
                        <td><?= htmlspecialchars($row['fullName']); ?></td>
                        <td><?= htmlspecialchars($row['categoryName']); ?></td>
                        <td><?= date('F d, Y', strtotime($row['postedDate'])); ?></td>
                        <td class="action">
                          <button type="button" class="delete-btn" onclick="confirmListingDelete(<?= (int) $row['itemID']; ?>)">
                            <img src="../assets/icons/trash.svg" alt="trash" />Delete
                          </button>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td>No items found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </main>

    <div id="listingDeleteModal" class="modal">
      <div class="modal-content">
        <p>Are you sure you want to delete this listing?</p>
        <a id="confirmListingDeleteBtn" class="btn-danger">Yes, Delete</a>
        <button type="button" onclick="closeListingModal()" class="btn">Cancel</button>
      </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
      function confirmListingDelete(id) {
        document.getElementById('listingDeleteModal').style.display = 'flex';
        document.getElementById('confirmListingDeleteBtn').href = 'deleteManageItem.php?id=' + encodeURIComponent(id);
      }

      function closeListingModal() {
        document.getElementById('listingDeleteModal').style.display = 'none';
      }
    </script>
  </body>
</html>