<?php
session_start();
$loginErrors = $_SESSION['login_errors'] ?? [];
unset($_SESSION['login_errors']);
$registerSuccess = $_SESSION['register_success'] ?? '';
unset($_SESSION['register_success']);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeeCycle | Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="../auth.css">
    
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>
    <main>
      <section class="hero">
        <div class="hero-box">
          <h2>BeeCycle</h2>
          <h1>Welcome back to you campus marketplace</h1>
          <p>Discover Deals, sell your old gear, and connect with other binusaians</p>
          <div class="box-image">
          <img src="../assets/Box.png" alt="box image">
          </div>
          <p class="add-info"><img src="../assets/icons/lock.svg" alt="lock icon">Exclusively for <strong>Binus.ac.id</strong> emails </p>
        </div>

        <form method="post" action="processLogIn.php" class="login-form" novalidate>
          <h2>Login</h2>
          <p>New to BeeCycle? <a href="register.php">Create an Account</a></p>

          <?php if ($registerSuccess !== '') { ?>
            <p style="color: green;"><?php echo($registerSuccess); ?></p>
          <?php } ?>

          <?php if (!empty($loginErrors)) { ?>
            <ul style="color: red;">
              <?php foreach ($loginErrors as $error) { ?>
                <li><?php echo($error); ?></li>
              <?php } ?>
            </ul>
          <?php } ?>

          <label for="email">Binus Email Address</label>
          <input type="email" id="email" name="email" placeholder="name@binus.ac.id" />
          <small class="error" id="emailError"></small>

          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="*******" />
          <small class="error" id="passwordError"></small>


          <button type="submit">Log in</button>
        </form> 
      </section>
    </main>

    <?php include '../includes/footer.php'; ?>

    <script src="logIn.js" defer></script>
  </body>
</html>