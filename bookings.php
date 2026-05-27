<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php require('inc/links.php') ?>
  <title><?php echo $settings_r['site_title'] ?> - Bookings</title>
</head>

<body class="bg-light">

  <?php require('inc/header.php');
  if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('index.php');
  }

  ?>

  <div class="container">
    <div class="row">
      <div class="col-12 my-5 px-4">
        <h2 class="fw-bold">Bookings</h2>
        <div style="font-size:14px;">
          <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
          <samp class="text-secondary"> ></samp>
          <a href="#" class="text-secondary text-decoration-none">Bookings</a>
        </div>
      </div>

      <?php

      $query = "SELECT bo.*, bd.* FROM `booking_order` bo
        INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
        WHERE ((bo.booking_status='booking')
        OR(bo.booking_status='cancelled'))
        AND (bo.user_id=?)
        ORDER BY bo.booking_id DESC";

      $result = select($query, [$_SESSION['uId']], 'i');

      while ($data = mysqli_fetch_assoc($result)) {
        $booking_date = date("d-m-Y", strtotime($data['datentime']));
        $check_in = date("d-m-Y", strtotime($data['check_in']));
        $check_out = date("d-m-Y", strtotime($data['check_out']));

        $status_bg = "";
        $btn = "";

        if ($data['booking_status'] == 'booking') {
          $status_bg = "bg-success";

          if ($data['arrival'] != 1) {
            $btn = "<button onclick='cancel_booking($data[booking_id])' type='button' class='btn btn-danger btn-sm shadow-none'>Cancel</button>";
          }
        } elseif ($data['booking_status'] == 'cancelled') {
          $status_bg = "bg-danger";
          $btn = "";
        }

        echo <<<bookings
          <div class='col-md-4 px-4 mb-4'>
            <div class='bg-white p-3 rounded shadow-sm'>
              <h5 class='fw-bold'>$data[room_name]</h5>
              <p>₹$data[price] per night</p>
              <p>
                <b>Check in: </b>$check_in<br>
                <b>Check out: </b>$check_out
              </p>
              <p>
                <b>Amount: </b>$data[total_pay]<br>
                <b>Date: </b>$booking_date
              </p>
              <p>
                <span class='badge $status_bg'>$data[booking_status]</span>
              </p>
              $btn
            </div>
          </div>
        bookings;
      }
      ?>

    </div>
  </div>
  <?php
  if (isset($_GET['cancel_status'])) {
    alert('success', "Booking Cancelled!");
  }
  ?>
  <?php require('inc/footer.php') ?>

  <script>
    function cancel_booking(id) {
      if (confirm("Are you sure you want to cancel this booking?")) {
        let data = new FormData();
        data.append('booking_id', id);
        data.append('cancel_booking', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/cancel_booking.php", true);

        xhr.onload = function() {
          if (this.responseText.trim() == 1) {
            window.location = "bookings.php?cancel_status=true";
          } else {
            alert('error', 'Server Down!');
          }
        };

        xhr.send(data);
      }
    }
  </script>
</body>

</html>