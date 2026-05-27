<?php
include 'db_connection.php';

$query = "SELECT i.itemID, i.itemTitle, i.category, i.postedDate, u.fullName 
          FROM item i
          INNER JOIN user u ON i.studentID = u.studentID
          ORDER BY item.PostedDate DESC";

$result = $conn->query($query);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Manage Listings</title>
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../admin.css" />
  </head>
  <body>
    <header class="navbar">
      <div class="container">
        <a href="index.php" class="logo"><span>Bee</span>Cycle</a>
        <nav>
          <ul>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="manage-users.html">Manage Users</a></li>
            <li><a href="manage-listings.php" class="active">Manage Listings</a></li>
          </ul>
        </nav>
        <div class="buttons">
          <div class="avatar">NS</div>
          <button class="btn">Exit Admin</button>
        </div>
      </div>
    </header>

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
                        <td><?= htmlspecialchars($row['categeory']); ?></td>
                        <td><?= date('F d, Y', strtotime($row['postedDate'])); ?></td>
                        
                        <td class="action">
                            <button class="delete-btn" onclick="confirmListingDelete(<?= $row['itemID']; ?>)">
                              Delete
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

          <div id="listingDeleteModal" class="modal">
            <div class="modal-content">
                <p>Are you sure you want to delete this listing?</p>
                <a id="confirmListingDeleteBtn" class="btn-danger">Yes, Delete</a>
                <button onclick="closeModal()" class="btn">Cancel</button>
            </div>
          </div>

        </section>
      </div>
    </main>

     <footer>
      <div class="container">
        <p class="copyright">
          &copy; 2026 BeeCycle Marketplace. All rights reserved.
        </p>
        <p>Admin Panel v1.0</p>
      </div>
    </footer>

    <script>
    function confirmDelete(id){
        document.getElementById('listingDeleteModal').style.display = "flex";
        document.getElementById('confirmDeleteBtn').href = "deleteManageItem.php" + id;
    }

    function closeModal(){
        document.getElementById('listingDeleteModal').style.display = 'none';
    }
    </script>
  </body>
</html>