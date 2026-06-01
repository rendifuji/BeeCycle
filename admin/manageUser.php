<?php
include '../db_connection.php';
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
    <?php include '../includes/navbar.php'; ?>

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
                        <button type="button" class="delete-btn" onclick="confirmUserDelete('<?php echo htmlspecialchars($row['studentID'], ENT_QUOTES); ?>')">
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
        <a id="confirmUserDeleteBtn" class="btn-danger">Yes, Delete</a>
        <button type="button" onclick="closeUserModal()" class="btn">Cancel</button>
      </div>
    </div>

    <?php include '../includes/footer.php'; ?>

    <script>
      function confirmUserDelete(id) {
        document.getElementById('userDeleteModal').style.display = 'flex';
        document.getElementById('confirmUserDeleteBtn').href = 'deleteManageUser.php?id=' + encodeURIComponent(id);
      }

      function closeUserModal() {
        document.getElementById('userDeleteModal').style.display = 'none';
      }
    </script>
  </body>
</html>