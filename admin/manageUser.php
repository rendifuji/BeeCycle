<?php
include 'db_connection.php';
$result = $conn->query("SELECT * FROM user");
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Manage Users</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
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
            <li><a href="manageUser.php" class="active">Manage Users</a></li>
            <li><a href="manage-listings.php">Manage Listings</a></li>
          </ul>
        </nav>
        <div class="buttons">
          <div class="avatar">NS</div>
          <button class="btn" onclick="window.location.href='index.php'">Exit Admin</button>
        </div>
      </div>
    </header>

    <main>
      <div class="container">
        <section class="manage-users">
          <header>
            <div>
              <h1>Manage Users</h1>
              <p>View and moderate all registered Binusian accounts.</p>
            </div>
            <div class="search">
              <img src="../assets/icons/search.svg" alt="search">
              <input type="text" placeholder="Search Users" />
            </div>
          </header>

          <div class="table-wrap">
            <table>
              <thead>
                <tr>
                  <th>NAME</th>
                  <th>STUDENT ID (NIM)</th>
                  <th>BINUS EMAIL</th>
                  <th>CAMPUS</th>
                  <th>ACTIONS</th>
                </tr>
              </thead>
              <tbody>
                <?php if ($result && $result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                      <td><?= htmlspecialchars($row['fullName']); ?></td>
                      <td><?= htmlspecialchars($row['studentID']); ?></td>
                      <td><?= htmlspecialchars($row['email']); ?></td>
                      <td><span class="pill"><?= htmlspecialchars($row['campus']); ?></span></td>
                      
                      <td class="action">
                        <button class="delete-btn" onclick="confirmUserDelete('<?= $row['studentID']; ?>')">
                          <img src="../assets/icons/trash.svg" alt="trash" />Delete
                        </button>
                      </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td>No registered accounts found.</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </section>
      </div>
    </main>

   <div id="userDeleteModal" class="modal">
    <div class="modal-content">
        <p>Are you sure you want to delete this user?</p>
        <a id="confirmDeleteBtn" class="btn-danger">Yes, Delete</a>
        <button onclick="closeModal()" class="btn">Cancel</button>
    </div>
  </div>

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
        document.getElementById('userDeleteModal').style.display = "flex";
        document.getElementById('confirmDeleteBtn').href = "deleteManageUser.php" + id;
    }

    function closeModal(){
        document.getElementById('userDeleteModal').style.display = 'none';
    }
    </script>
  </body>
</html>