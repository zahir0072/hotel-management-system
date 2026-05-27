<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php') ?>
  <title><?php echo $settings_r['site_title'] ?> - Booking Status</title>
</head>

<body class="bg-light">

  <?php require('inc/header.php') ?>

  <div class="container">
    <div class="row">
      <div class="col-12 my-5 mb-3 px-4">
        <h2 class="fw-bold">Booking Status</h2>
      </div>
      <?php
      if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('index.php');
      }
      echo <<<DATA
        <div class="col-12 px-4">
            <p class="fw-bold alert alert-success">
                <i class="bi bi-check-circle-fill"></i>
                Booking Successful.
                <br><br>
                <a href="bookings.php">Go To Bookings</a>
            </p>
        </div>
DATA;

      ?>


    </div>
  </div>
  <?php require('inc/footer.php') ?>
  <script>
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');

    function check_availability() {
      let checkin_val = booking_form.elements['checkin'].value;
      let checkout_val = booking_form.elements['checkout'].value;

      booking_form.elements['book_now'].disabled = true;

      if (checkin_val !== '' && checkout_val !== '') {

        pay_info.classList.add('d-none');
        info_loader.classList.remove('d-none');

        let data = new FormData();
        data.append('check_availability', '');
        data.append('check_in', checkin_val);
        data.append('check_out', checkout_val);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/confrim_booking.php", true);

        xhr.onload = function() {
          let date = JSON.parse(this.responseText);

          if (date.status === 'check_in_out_equal') {
            pay_info.innerText = "You cannot check-out on the same day!";
          } else if (date.status === 'check_out_earlier') {
            pay_info.innerText = "Check-out date is earlier than check-in date!";
          } else if (date.status === 'check_in_earlier') {
            pay_info.innerText = "Check-in date is earlier than today's date!";
          } else if (date.status === 'unavailable') {
            pay_info.innerText = "Room not available for this check-in date!";
          } else {
            pay_info.innerHTML = "No. of Days: " + date.days + "<br>Total Amount to Pay: ₹" + date.payment;
            pay_info.classList.replace('text-danger', 'text-dark');
            booking_form.elements['book_now'].removeAttribute('disabled');
          }

          pay_info.classList.remove('d-none');
          info_loader.classList.add('d-none');
        };

        xhr.send(data);
      }
    }
  </script>
</body>

</html>