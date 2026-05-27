<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['get_bookings'])) {

  $frm_data = filteration($_POST);

  $limit = 3;
  $page = $frm_data['page'];
  $start = ($page - 1) * $limit;

  $query = "SELECT bo.*, bd.* FROM `booking_order` bo
    INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
    WHERE ((bo.booking_status='booking' AND bo.arrival=1)
    OR(bo.booking_status='cancelled'))
    AND (bd.user_name LIKE ? OR bd.phonenum LIKE ?)
    ORDER BY bo.booking_id DESC";

  $res = select($query, ["%$frm_data[search]%", "%$frm_data[search]%"], 'ss');

  $limit_query = $query . " LIMIT $start,$limit";
  $limit_res = select($limit_query, ["%$frm_data[search]%", "%$frm_data[search]%"], 'ss');

  $total_rows = mysqli_num_rows($res);

  if ($total_rows == 0) {
    $output = json_encode(["table_data" => "<b>No Data Found!</b>", "pagination" => ""]);
    echo $output;
    exit;
  }


  $i = $start + 1;
  $table_data = "";

  while ($data = mysqli_fetch_assoc($limit_res)) {
    $booking_date = date("d-m-Y", strtotime($data['datentime']));
    $check_in = date("d-m-Y", strtotime($data['check_in']));
    $check_out = date("d-m-Y", strtotime($data['check_out']));

    if ($data['booking_status'] == "booking") {
      $status_bg = 'bg-success';
    } elseif ($data['booking_status'] == "cancelled") {
      $status_bg = 'bg-danger';
    }


    $table_data .= "
      <tr>
        <td>$i</td>
        <td>
          <b>Name:</b> {$data['user_name']}<br>
          <b>Phone No:</b> {$data['phonenum']}<br>
          <b>Address:</b> {$data['address']}
        </td>
        <td>
          <b>Room:</b> {$data['room_name']}<br>
          <b>Price:</b> ₹{$data['price']}
        </td>
        <td>
          <b>Check in:</b> $check_in<br>
          <b>Check Out:</b> $check_out<br>
          <b>Booking Date:</b> $booking_date
        </td>
        <td>
          <span class='badge $status_bg'>$data[booking_status]</span>
        </td>
        <td>
          <button type='button' onclick='downlode($data[booking_id])' class='btn btn-success btn-sm fw-bold shadow-none'>
            <i class='bi bi-file-arrow-down-fill'></i>
          </button>
        </td>
      </tr>
    ";
    $i++;
  }

  $pagination = "";
  if ($total_rows > $limit) {
    $total_pages = ceil($total_rows / $limit);


    if ($page != 1) {
      $pagination .= "<li class='page-item'><button onclick='change_page(1)' class='page-link shadow-none'>Frist</li>";
    }

    $disabled = ($page == 1) ? "disabled" : "";
    $prev = $page - 1;
    $pagination .= "<li class='page-item $disabled'><button onclick='change_page($prev)' class='page-link shadow-none'>Prev</li>";

    $disabled = ($page == $total_pages) ? "disabled" : "";
    $next = $page + 1;
    $pagination .= "<li class='page-item $disabled'><button onclick='change_page($next)' class='page-link shadow-none'>Next</li>";

    if ($page != $total_pages) {
      $pagination .= "<li class='page-item'><button onclick='change_page($total_pages)' class='page-link shadow-none'>Last</li>";
    }
  }

  $output = json_encode(["table_data" => $table_data, "pagination" => $pagination]);

  echo $output;
}
