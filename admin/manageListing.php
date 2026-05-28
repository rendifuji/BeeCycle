<?php
include __DIR__.'/../db_connection.php';

$query = "SELECT i.itemID, i.itemTitle, i.category, i.postedDate, u.fullName 
          FROM item i
          INNER JOIN user u ON i.studentID = u.studentID
          ORDER BY i.postedDate DESC";

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
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['itemTitle']); ?></td>
                        <td><?= htmlspecialchars($row['fullName']); ?></td>
                        <td><?= htmlspecialchars($row['category']); ?></td>
                        <td><?= date('F d, Y', strtotime($row['postedDate'])); ?></td>
                        
                      <td class="action">
                        <a  style="text-decoration: none; color: red; display:flex; justify-content:center; " class="delete-btn" href="deleteManageListing.php?id=<?php echo $row['itemID']?>" onclick="return confirm('are you sure you want to do this')">
                          <img src="../assets/icons/trash.svg" alt="trash" />Delete
                        </a>
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

     <footer>
      <div class="container">
        <p class="copyright">
          &copy; 2026 BeeCycle Marketplace. All rights reserved.
        </p>
        <p>Admin Panel v1.0</p>
      </div>
    </footer>

    </script>
  </body>
</html>