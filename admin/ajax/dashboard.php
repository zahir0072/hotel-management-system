<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['bookings_analytics'])) {

  $frm_data = filteration($_POST);

  $condition = "";

  if ($frm_data['period'] == 1) {
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
  } elseif ($frm_data['period'] == 2) {
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
  } elseif ($frm_data['period'] == 3) {
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
  }

  $result1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT 
    COUNT(booking_id) AS total_bookings,
    COUNT(CASE WHEN booking_status='booking' AND arrival=1 THEN 1 END) AS active_bookings,
    COUNT(CASE WHEN booking_status='cancelled' AND arrival=0 THEN 1 END) AS cancel_bookings
    FROM booking_order $condition"));

  $result2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT 
    SUM(total_pay) AS total_amt,
    SUM(CASE WHEN room_no IS NOT NULL THEN total_pay END) AS active_amt,
    SUM(CASE WHEN room_no IS NULL THEN total_pay END) AS cancelled_amt
    FROM booking_details"));

  $output = json_encode(array_merge($result1, $result2));

  echo $output;
}
if (isset($_POST['user_analytics'])) {

  $frm_data = filteration($_POST);

  $condition = "";

  if ($frm_data['period'] == 1) {
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 30 DAY AND NOW()";
  } elseif ($frm_data['period'] == 2) {
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 90 DAY AND NOW()";
  } elseif ($frm_data['period'] == 3) {
    $condition = "WHERE datentime BETWEEN NOW() - INTERVAL 1 YEAR AND NOW()";
  }

  $total_queries = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(sr_no)AS `count`
    FROM `user_queries` $condition"));

  $total_new_reg = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(id)AS `count`
    FROM `user_cred` $condition"));

  $output = ['total_queries' => $total_queries['count'], 'total_new_reg' => $total_new_reg['count']];

  $output = json_encode($output);

  echo $output;
}
