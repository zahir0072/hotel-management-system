<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Panel-Dashbaord</title>
  <?php require('inc/links.php'); ?>
</head>

<body class="bg-light ">

  <?php require('inc/header.php');

  $is_shutdown = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `shutdown` FROM `settings`"));

  $current_bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT 
    COUNT(CASE WHEN booking_status='booking' AND arrival=0 THEN 1 END)AS `new_bookings`,
    COUNT(CASE WHEN booking_status='cancelled' AND arrival=0 THEN 1 END)AS `cancel_bookings`,
    COUNT(CASE WHEN booking_status='booking' AND arrival=1 THEN 1 END)AS `bookings`
    FROM `booking_order`"));

  $bookings_records = $current_bookings['cancel_bookings'] + $current_bookings['bookings'];

  $unread_queries = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(sr_no)AS `count`
   FROM `user_queries` WHERE `seen`=0"));

  $current_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT 
    COUNT(id) AS `total`,
    COUNT(CASE WHEN `status`=1 THEN 1 END)AS `active`,
    COUNT(CASE WHEN `status`=0 THEN 1 END)AS `inactive`,
    COUNT(CASE WHEN `is_verified`=0 THEN 1 END)AS `unverified`
    FROM `user_cred`"));
  ?>

  <div class="container-fluid" id="main-content">
    <div class="row">
      <div class="col-lg-10 ms-auto p-4 overflow-hidden">

        <div class="d-flex align-items-center justify-content-between mb-4">
          <h3>DASHBAORD</h3>
          <?php
          if ($is_shutdown['shutdown']) {
            echo <<<data
              <h5 class="badge bg-danger py-2 px-3 rounded">Shutdown Mode is Active!</h5>
              data;
          }
          ?>
        </div>

        <div class="row mb-4">
          <div class="col-md-4 mb-4">
            <a href="new_bookings.php" class="text-decoration-none">
              <ddiv class="card text-center p-3 text-success">
                <h6>New Bookings</h6>
                <h1 class="mt-2 mb-0"><?php echo $current_bookings['new_bookings'] ?></h1>
              </ddiv>
            </a>
          </div>
          <div class="col-md-4 mb-4">
            <a href="user_queris.php" class="text-decoration-none">
              <ddiv class="card text-center p-3 text-info">
                <h6>User Queris</h6>
                <h1 class="mt-2 mb-0"><?php echo $unread_queries['count'] ?></h1>
              </ddiv>
            </a>
          </div>
          <div class="col-md-4 mb-4">
            <a href="bookings_records.php" class="text-decoration-none">
              <ddiv class="card text-center p-3">
                <h6>Bookings Records</h6>
                <h1 class="mt-2 mb-0"><?php echo $bookings_records ?></h1>
              </ddiv>
            </a>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3">
          <h5>Bookings Analytics</h5>
          <select class="form-select shadow-none bg-light w-auto" onchange="bookings_analytics(this.value)">
            <option value="1">Past 30 Days</option>
            <option value="2">Past 90 Days</option>
            <option value="3">Past 1 Year</option>
            <option value="4">All Time</option>
          </select>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 mb-4">
            <ddiv class="card text-center p-3 text-primary">
              <h6>Total Bookings</h6>
              <h1 class="mt-2 mb-0" id="total_bookings"></h1>
              <h4 class="mt-2 mb-0" id="total_amt"></h4>
            </ddiv>
          </div>
          <div class="col-md-3 mb-4">
            <ddiv class="card text-center p-3 text-success">
              <h6>Avtive Bookings</h6>
              <h1 class="mt-2 mb-0" id="active_bookings"></h1>
              <h4 class="mt-2 mb-0" id="active_amt"></h4>
            </ddiv>
          </div>
          <div class="col-md-3 mb-4">
            <ddiv class="card text-center p-3 text-danger">
              <h6>Cancelled Bookings</h6>
              <h1 class="mt-2 mb-0" id="cancel_bookings"></h1>
              <h4 class="mt-2 mb-0" id="cancelled_amt"></h4>
            </ddiv>
          </div>
        </div>

        <div class="d-flex align-items-center justify-content-between mb-3">
          <h5>User & Queries</h5>
          <select class="form-select shadow-none bg-light w-auto" onchange="user_analytics(this.value)">
            <option value="1">Past 30 Days</option>
            <option value="2">Past 90 Days</option>
            <option value="3">Past 1 Year</option>
            <option value="4">All Time</option>
          </select>
        </div>

        <div class="row mb-3">
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-success">
              <h6>New Registration</h6>
              <h1 class="mt-2 mb-0" id="total_new_reg">0</h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-primary">
              <h6>Queries</h6>
              <h1 class="mt-2 mb-0" id="total_queries">0</h1>
            </div>
          </div>
        </div>


        <h5>Users</h5>
        <div class="row mb-3">
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-info">
              <h6>Total</h6>
              <h1 class="mt-2 mb-0"><?php echo $current_users['total'] ?></h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-success">
              <h6>Active</h6>
              <h1 class="mt-2 mb-0"><?php echo $current_users['active'] ?></h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-warning">
              <h6>Inactive</h6>
              <h1 class="mt-2 mb-0"><?php echo $current_users['inactive'] ?></h1>
            </div>
          </div>
          <div class="col-md-3 mb-4">
            <div class="card text-center p-3 text-danger">
              <h6>Unverified</h6>
              <h1 class="mt-2 mb-0"><?php echo $current_users['unverified'] ?></h1>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php require('inc/scripts.php'); ?>
  <script src="script/dashboard.js"></script>
</body>

</html>