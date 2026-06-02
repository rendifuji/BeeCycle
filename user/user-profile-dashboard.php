<?php include '../includes/student-check.php'; ?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BeeCycle | User Profile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="../style.css" />
    <link rel="stylesheet" href="profile.css" />
  </head>
  <body>
    <?php include '../includes/navbar.php'; ?>
    <main class="profile-dashboard-main">
      <section class="profile-dashboard">
        <div class="container profile-dashboard__layout">
          <article class="profile-card">
            <div class="profile-card__top">
              <div class="profile-card__avatar">YS</div>
              <a href="edit-profile.php" class="profile-card__edit">Edit Profile</a>
            </div>

            <div class="profile-card__identity">
              <h1>Yohannes Elia Suryawan</h1>
              <p>2802472493</p>
            </div>

            <dl class="profile-card__details">
              <div class="profile-card__row">
                <dt>Campus</dt>
                <dd>BINUS @ Alam Sutera</dd>
              </div>
              <div class="profile-card__row">
                <dt>Phone</dt>
                <dd>081234567890</dd>
              </div>
              <div class="profile-card__row">
                <dt>Email</dt>
                <dd>yohannes.suryawan@binus.ac.id</dd>
              </div>
            </dl>
          </article>

          <section class="listing-panel" aria-labelledby="active-listings-title">
            <div class="listing-panel__header">
              <h2 id="active-listings-title">My Active Listings</h2>
              <a href="../marketplace/sellItem.php" class="listing-panel__action">Add New Item</a>
            </div>

            <div class="listing-grid">
              <article
                class="listing-card"
                onclick="window.location.href='../marketplace/edit-listing.php'"
                onkeydown="if(event.key==='Enter' || event.key===' '){ event.preventDefault(); window.location.href='../marketplace/edit-listing.php'; }"
                tabindex="0"
                role="link"
                aria-label="Open edit listing page for Sony WH-1000XM4"
              >
                <div class="listing-card__badge">Like New</div>
                <img src="../assets/Headphones.jpeg" alt="Sony WH-1000XM4 Wireless Headphones" class="listing-card__image" />
                <div class="listing-card__content">
                  <p class="listing-card__price">Rp 1.850.000</p>
                  <h3>Sony WH-1000XM4</h3>
                  <p class="listing-card__subtitle">Wireless Headphones</p>
                  <div class="listing-card__meta">
                    <span class="listing-card__location">
                      <img src="../assets/icons/pin.svg" alt="" />
                      Kampus Anggrek
                    </span>
                    <span>2 hrs ago</span>
                  </div>
                </div>
              </article>

              <article
                class="listing-card"
                onclick="window.location.href='../marketplace/edit-listing.php'"
                onkeydown="if(event.key==='Enter' || event.key===' '){ event.preventDefault(); window.location.href='../marketplace/edit-listing.php'; }"
                tabindex="0"
                role="link"
                aria-label="Open edit listing page for Sony WH-1000XM4"
              >
                <div class="listing-card__badge">Like New</div>
                <img src="../assets/Headphones.jpeg" alt="Sony WH-1000XM4 Wireless Headphones" class="listing-card__image" />
                <div class="listing-card__content">
                  <p class="listing-card__price">Rp 1.850.000</p>
                  <h3>Sony WH-1000XM4</h3>
                  <p class="listing-card__subtitle">Wireless Headphones</p>
                  <div class="listing-card__meta">
                    <span class="listing-card__location">
                      <img src="../assets/icons/pin.svg" alt="" />
                      Kampus Anggrek
                    </span>
                    <span>2 hrs ago</span>
                  </div>
                </div>
              </article>

              <article
                class="listing-card"
                onclick="window.location.href='../marketplace/edit-listing.php'"
                onkeydown="if(event.key==='Enter' || event.key===' '){ event.preventDefault(); window.location.href='../marketplace/edit-listing.php'; }"
                tabindex="0"
                role="link"
                aria-label="Open edit listing page for Sony WH-1000XM4"
              >
                <div class="listing-card__badge">Like New</div>
                <img src="../assets/Headphones.jpeg" alt="Sony WH-1000XM4 Wireless Headphones" class="listing-card__image" />
                <div class="listing-card__content">
                  <p class="listing-card__price">Rp 1.850.000</p>
                  <h3>Sony WH-1000XM4</h3>
                  <p class="listing-card__subtitle">Wireless Headphones</p>
                  <div class="listing-card__meta">
                    <span class="listing-card__location">
                      <img src="../assets/icons/pin.svg" alt="" />
                      Kampus Anggrek
                    </span>
                    <span>2 hrs ago</span>
                  </div>
                </div>
              </article>

              <article
                class="listing-card"
                onclick="window.location.href='../marketplace/edit-listing.php'"
                onkeydown="if(event.key==='Enter' || event.key===' '){ event.preventDefault(); window.location.href='../marketplace/edit-listing.php'; }"
                tabindex="0"
                role="link"
                aria-label="Open edit listing page for Sony WH-1000XM4"
              >
                <div class="listing-card__badge">Like New</div>
                <img src="../assets/Headphones.jpeg" alt="Sony WH-1000XM4 Wireless Headphones" class="listing-card__image" />
                <div class="listing-card__content">
                  <p class="listing-card__price">Rp 1.850.000</p>
                  <h3>Sony WH-1000XM4</h3>
                  <p class="listing-card__subtitle">Wireless Headphones</p>
                  <div class="listing-card__meta">
                    <span class="listing-card__location">
                      <img src="../assets/icons/pin.svg" alt="" />
                      Kampus Anggrek
                    </span>
                    <span>2 hrs ago</span>
                  </div>
                </div>
              </article>

              <article
                class="listing-card"
                onclick="window.location.href='../marketplace/edit-listing.php'"
                onkeydown="if(event.key==='Enter' || event.key===' '){ event.preventDefault(); window.location.href='../marketplace/edit-listing.php'; }"
                tabindex="0"
                role="link"
                aria-label="Open edit listing page for Sony WH-1000XM4"
              >
                <div class="listing-card__badge">Like New</div>
                <img src="../assets/Headphones.jpeg" alt="Sony WH-1000XM4 Wireless Headphones" class="listing-card__image" />
                <div class="listing-card__content">
                  <p class="listing-card__price">Rp 1.850.000</p>
                  <h3>Sony WH-1000XM4</h3>
                  <p class="listing-card__subtitle">Wireless Headphones</p>
                  <div class="listing-card__meta">
                    <span class="listing-card__location">
                      <img src="../assets/icons/pin.svg" alt="" />
                      Kampus Anggrek
                    </span>
                    <span>2 hrs ago</span>
                  </div>
                </div>
              </article>
            </div>
          </section>
        </div>
      </section>
    </main>

    <?php include '../includes/footer.php'; ?>
  </body>
</html>
