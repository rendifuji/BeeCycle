<?php
  include '../includes/student-check.php';
  include '../db_connection.php';

  $studentID = $_SESSION['studentID'];

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['full-name'];
    $campus = $_POST['campus-location'];
    $whatsapp = $_POST['whatsapp-number'];

    $query = "UPDATE user SET
      fullName = '$fullName',
      campus = '$campus',
      whatsapp = '$whatsapp'
      WHERE studentID = '$studentID'";

    mysqli_query($conn, $query);
    $_SESSION['initials'] = strtoupper(substr($fullName, 0, 2));

    header('Location: user-profile-dashboard.php');
    exit();
  }

  $query = "SELECT * FROM user WHERE studentID = '$studentID'";
  $result = mysqli_query($conn, $query);
  $user = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeeCycle | Edit Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="./edit-profile.css" />
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>
    <main class="edit-profile-main">
      <section class="edit-profile-section">
        <div class="container">
          <div class="edit-profile-shell">
            <div class="edit-profile-heading">
              <h1>Edit Profile</h1>
              <p>Update your contact details and campus location.</p>
            </div>

            <form class="edit-profile-form" action="" method="POST" novalidate>
              <div class="edit-profile-grid">
                <div class="form-field">
                  <label for="binus-email">Binus Email</label>
                  <input
                    id="binus-email"
                    name="binus-email"
                    type="email"
                    placeholder="Enter your Binus email"
                    value="<?php echo($user['email']); ?>"
                    readonly
                  />
                </div>

                <div class="form-field">
                  <label for="student-id">Student ID / NIM</label>
                  <input
                    id="student-id"
                    name="student-id"
                    type="text"
                    placeholder="Enter your student ID"
                    value="<?php echo($user['studentID']); ?>"
                    readonly
                  />
                </div>
              </div>

              <div class="form-field">
                <label for="full-name">Full Name</label>
                <input
                  id="full-name"
                  name="full-name"
                  type="text"
                  placeholder="Enter your full name"
                  value="<?php echo($user['fullName']); ?>"
                />
              </div>

              <div class="form-field">
                <label for="campus-location">Campus Location</label>
                <div class="select-wrap">
                  <select id="campus-location" name="campus-location">
                    <option value="" disabled>Select your campus location</option>
                    <option value="Binus@Kemanggisan" <?php if ($user['campus'] === 'Binus@Kemanggisan') echo 'selected'; ?>>Binus@Kemanggisan</option>
                    <option value="Binus@Alam Sutera" <?php if ($user['campus'] === 'Binus@Alam Sutera') echo 'selected'; ?>>Binus@Alam Sutera</option>
                    <option value="Binus@Bekasi" <?php if ($user['campus'] === 'Binus@Bekasi') echo 'selected'; ?>>Binus@Bekasi</option>
                    <option value="Binus@Malang" <?php if ($user['campus'] === 'Binus@Malang') echo 'selected'; ?>>Binus@Malang</option>
                    <option value="Binus@Semarang" <?php if ($user['campus'] === 'Binus@Semarang') echo 'selected'; ?>>Binus@Semarang</option>
                    <option value="Binus@Bandung" <?php if ($user['campus'] === 'Binus@Bandung') echo 'selected'; ?>>Binus@Bandung</option>
                  </select>
                </div>
              </div>

              <div class="form-field">
                <label for="whatsapp-number">WhatsApp Number</label>
                <input
                  id="whatsapp-number"
                  name="whatsapp-number"
                  type="tel"
                  placeholder="Enter your WhatsApp number"
                  value="<?php echo($user['whatsapp']); ?>"
                />
              </div>

              <div class="edit-profile-actions">
                <a href="./user-profile-dashboard.php" class="btn-cancel">Cancel</a>
                <button type="submit" class="btn-submit">Submit</button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </main>

    <?php include '../includes/footer.php'; ?>
    <script src="./edit-profile.js"></script>
  </body>
</html>
