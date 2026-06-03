<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeeCycle Landing Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="landing.css" />
  </head>
  <body>
    <?php include 'includes/navbar.php'; ?>
    <main>
      <section class="hero">
        <div class="container">
          <div class="left">
            <h1>Your Campus,<br />Your Marketplace.</h1>
            <p>
              Buy, sell, and trade textbooks, electronics, and dorm essentials
              exclusively within the Binus community. Safe, zero shipping fees,
              and strictly for Binusians.
            </p>
            <a class="btn btn-primary" href="auth/logIn.php">Login with Binus Email</a>
            <div class="desc">
              <img src="./assets/icons/lock.svg" />
              <small>Exclusively for @binus.ac.id emails</small>
            </div>
          </div>

          <div class="right">
            <img src="./assets/HeroImage.png" alt="Students using BeeCycle" />
          </div>
        </div>
      </section>

      <div class="trust">
        <div class="container">
          <p>Trusted by students across:</p>
          <span><img src="./assets/icons/pin.svg" />Anggrek</span>
          <span><img src="./assets/icons/pin.svg" />Alam Sutera</span>
          <span><img src="./assets/icons/pin.svg" />Bekasi</span>
          <span><img src="./assets/icons/pin.svg" />Malang</span>
          <span><img src="./assets/icons/pin.svg" />Bandung</span>
          <span><img src="./assets/icons/pin.svg" />Semarang</span>
        </div>
      </div>

      <section class="benefits" id="benefits">
        <div class="container">
          <div class="section-title">
            <h2>Designed for the <span>Binusian</span> life.</h2>
            <p>
              Simple, safe, and built to keep your wallet happy while you study.
            </p>
          </div>

          <div class="cards">
            <article>
              <div class="icon">
                <img src="./assets/Money.png" alt="Money icon" />
              </div>
              <div class="content">
                <h3>Don't pay full price.</h3>
                <p>
                  Grab pre-loved textbooks and lab gear for a fraction of the
                  original cost.
                </p>
              </div>
            </article>

            <article>
              <div class="icon">
                <img src="./assets/People.png" alt="People icon" />
              </div>
              <div class="content">
                <h3>No strangers.</h3>
                <p>
                  Every user is verified using their active Binus email. Trade
                  with peace of mind.
                </p>
              </div>
            </article>

            <article>
              <div class="icon">
                <img src="./assets/Economy.png" alt="Economy icon" />
              </div>
              <div class="content">
                <h3>Support Circular Economy.</h3>
                <p>
                  Moving out? Pass your dorm essentials to freshmen instead of
                  throwing them away.
                </p>
              </div>
            </article>
          </div>
        </div>
      </section>

      <section class="categories" id="categories">
        <div class="container">
          <div class="section-title">
            <h2><span>Everything</span> you need to survive the semester.</h2>
            <p>
              From calculus books to dorm decor, find it all inside the BeeCycle
              marketplace.
            </p>
          </div>

          <div class="category-row">
            <a href="marketplace/homepage.php?category=CA003" class="category">
              <img src="./assets/Textbooks.png" alt="Textbooks" />
              <div class="label">
                <span class="tag">120+ items</span>
                <h3>Textbooks</h3>
              </div>
            </a>

            <a href="marketplace/homepage.php?category=CA001" class="category">
              <img src="./assets/Electronics.png" alt="Electronics" />
              <div class="label">
                <span class="tag">120+ items</span>
                <h3>Electronics</h3>
              </div>
            </a>

            <a href="marketplace/homepage.php?category=CA004" class="category">
              <img src="./assets/DormEssentials.png" alt="Dorm Essentials" />
              <div class="label">
                <span class="tag">120+ items</span>
                <h3>Dorm Essentials</h3>
              </div>
            </a>

            <a href="marketplace/homepage.php?category=CA005" class="category">
              <img src="./assets/ArtSupplies.png" alt="Art Supplies" />
              <div class="label">
                <span class="tag">120+ items</span>
                <h3>Art Supplies</h3>
              </div>
            </a>

            <a href="marketplace/homepage.php?category=CA002" class="category">
              <img src="./assets/Uniforms.png" alt="Uniforms" />
              <div class="label">
                <span class="tag">120+ items</span>
                <h3>Uniforms</h3>
              </div>
            </a>
          </div>
        </div>
      </section>

      <section class="cta">
        <div class="container">
          <div class="box">
            <div>
              <h3>Ready to declutter your dorm?</h3>
              <p>
                Join thousands of Binusians buying and selling safely on campus
                today.
              </p>
              <button class="btn btn-secondary">
                <a href="auth/register.php">Join BeeCycle Today</a>
              </button>
            </div>

            <img src="./assets/Box.png" alt="Box with school supplies" />
          </div>
        </div>
      </section>
    </main>

    <?php include 'includes/footer.php'; ?>
  </body>
</html>
