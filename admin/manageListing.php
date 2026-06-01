<?php
include '../db_connection.php';

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
                    <?php while ($row = mysqli_fetch_array($result)): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['itemTitle']); ?></td>
                        <td><?= htmlspecialchars($row['fullName']); ?></td>
                        <td><?= htmlspecialchars($row['category']); ?></td>
                        <td><?= date('F d, Y', strtotime($row['postedDate'])); ?></td>
                        
                      <td class="action">
                        <a  style="text-decoration: none; color: red; display:flex; justify-content:center; " class="delete-btn" href="deleteManageItem.php?id=<?php echo $row['itemID']?>" onclick="return confirm('are you sure you want to do this')">
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

    <?php include '../includes/footer.php'; ?>
  </body>
</html>