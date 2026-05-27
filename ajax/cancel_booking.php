<?php

require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

date_default_timezone_set("Asia/Kolkata");
session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
  redirect('rooms.php');
}

if (isset($_POST['cancel_booking'])) {
  $frm_data = filteration($_POST);

  $query = "UPDATE `booking_order` SET `booking_status`=? WHERE `booking_id`=?";
  $values = ['cancelled', $frm_data['booking_id']];
  $res = update($query, $values, 'si');

  echo $res;
}
