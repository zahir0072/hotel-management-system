<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=\, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
  <?php require('inc/links.php') ?>
  <title><?php echo $settings_r['site_title'] ?> - About</title>
  <style>
    .box {
      border-top-color: var(--teal) !important;
    }
  </style>
</head>

<body class="bg-light">

  <?php require('inc/header.php') ?>

  <div class="my-5 px-4">
    <h2 class="fw-bold h-font text-center">About Us</h2>
    <div class="h-line bg-dark"></div>
    <p class="text-center mt-3">
      Our hotel is dedicated to providing a comfortable and memorable experience to every guest. With modern amenities, friendly staff, and excellent service, <br>we aim to make your stay relaxing and enjoyable. Whether you’re here for business or leisure,we offer a perfect blend of luxury, convenience, and hospitality.
    </p>
  </div>

  <div class="container">
    <div class="row justify-content-between align-items-center">
      <div class="col-lg-6 col-md-5 mb-4 order-lg-1 order-md-1 order-2">
        <h5 class="mb-3">Lorem ipsum dolor sit</h5>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
          Aliquid ipsam nobis, repudiandae quis asperiores neque?
          Lorem ipsum, dolor sit amet consectetur adipisicing elit.
          Aliquid ipsam nobis, repudiandae quis asperiores neque?
        </p>
      </div>
      <div class="col-lg-5 col-md-5 mb-4 order-lg-2 order-md-2 order-1">
        <img src="image/about.jpg" class="w-100">
      </div>
    </div>
  </div>

  <div class="container mt-5">
    <div class="row">
      <div class="col-lg-3 col-md-6 mb-4 px-4 ">
        <div class="bg-white rouunded shadow p-4 border-top border-4 text-center box">
          <img src="image/about/hotel.svg" width="70px">
          <h4 class="mt-3">100+ ROOMS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4 ">
        <div class="bg-white rouunded shadow p-4 border-top border-4 text-center box">
          <img src="image/about/people.png" width="70px">
          <h4 class="mt-3">200+CUSTOMERS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4 ">
        <div class="bg-white rouunded shadow p-4 border-top border-4 text-center box">
          <img src="image/about/rating.png" width="70px">
          <h4 class="mt-3">150+ REVIEWS</h4>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 mb-4 px-4 ">
        <div class="bg-white rouunded shadow p-4 border-top border-4 text-center box">
          <img src="image/about/staff.png" width="70px">
          <h4 class="mt-3">200+ STAFFS</h4>
        </div>
      </div>
    </div>
  </div>
  <h3 class="my-5 fw-bold h-font text-center">Management Team</h3>
  <div class="container px-4">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper mb-5">
        <?php
        $about_r = selectAll('team_details');
        $path = ABOUT_IMG_PATH;
        while ($row = mysqli_fetch_assoc($about_r)) {
          echo <<<data
              <div class="swiper-slide bg-white text-center overflow-hidden rounded">
                <img src="$path$row[picture]" class="w-100">
                <h5 class="mt-2">$row[name]</h5>
              </div>
            data;
        }
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
  <?php require('inc/footer.php') ?>
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      slidesPerView: 4,
      spaceBetween: 40,
      pagination: {
        el: ".swiper-pagination",
        dynamicBullets: true,
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
        },
        640: {
          slidesPerView: 1,
        },
        768: {
          slidesPerView: 3,
        },
        1024: {
          slidesPerView: 3,
        },
      }
    });
  </script>
</body>

</html>