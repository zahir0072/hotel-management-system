<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

if (isset($_GET['gen_pdf']) && isset($_GET['id'])) {
    $frm_data = filteration($_GET);

    $query = "SELECT bo.*, bd.*, uc.email 
              FROM `booking_order` bo
              INNER JOIN `booking_details` bd ON bo.booking_id = bd.booking_id
              INNER JOIN `user_cred` uc ON bo.user_id = uc.id
              WHERE ((bo.booking_status='booking' AND bo.arrival=1)
              OR (bo.booking_status='cancelled'))
              AND bo.booking_id='{$frm_data['id']}'";

    $res = mysqli_query($conn, $query);

    if (mysqli_num_rows($res) == 0) {
        header('location:dashbord.php');
        exit;
    }

    $data = mysqli_fetch_assoc($res);

    $booking_date = date("h:ia | d-m-Y", strtotime($data['datentime']));
    $check_in     = date("d-m-Y", strtotime($data['check_in']));
    $check_out    = date("d-m-Y", strtotime($data['check_out']));

    $total_data = "
        <style>
            .receipt-container {
                width: 600px;
                margin: 20px auto;
                font-family: Arial, sans-serif;
                border: 2px solid #444;
                border-radius: 12px;
                padding: 20px;
                background: #fdfdfd;
                box-shadow: 0px 4px 12px rgba(0,0,0,0.2);
            }
            .receipt-container h2 {
                text-align: center;
                color: #2c3e50;
                margin-bottom: 20px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            h4 {
                text-align: center;
                color: #2c3e50;
                margin-bottom: 20px;
                text-transform: uppercase;
                letter-spacing: 1px;
            }
            .receipt-table {
                width: 100%;
                border-collapse: collapse;
            }
            .receipt-table td {
                border: 1px solid #ccc;
                padding: 10px 15px;
                font-size: 14px;
            }
            .receipt-table tr:nth-child(even) {
                background: #f9f9f9;
            }
            .receipt-table tr:hover {
                background: #e8f6ff;
            }
            .highlight {
                font-weight: bold;
                color: #2c3e50;
            }
            .amount {
                color: #27ae60;
                font-weight: bold;
            }
        </style>

        <div class='receipt-container'>
            <h2>BOOKING RECEIPT</h2>
            <h4>ROYAL HOTEL - RAJKOT</h4>
        <table class='receipt-table'>
            <tr>
                <td>Booking Date: {$booking_date}</td>
                <td>Status: {$data['booking_status']}</td>
            </tr>
            <tr>
                <td>User Name: {$data['user_name']}</td>
                <td>User Email: {$data['email']}</td>
            </tr>
            <tr>
                <td>Phone No: {$data['phonenum']}</td>
                <td>Address: {$data['address']}</td>
            </tr>
            <tr>
                <td>Room Name: {$data['room_name']}</td>
                <td>Cost: ₹{$data['price']} per night</td>
            </tr>
            <tr>
                <td>Check-in: {$check_in}</td>
                <td>Check-out: {$check_out}</td>
            </tr>
    ";
    if ($data['booking_status'] == 'booking') {
        $total_data .= "<tr>
            <td>Room No: {$data['room_no']}</td>
            <td>Total Amount: ₹{$data['total_pay']}</td>
        </tr>";
    }

    $total_data .= "</table>
    </div>";
    echo $total_data;
} else {
    header('location:dashbord.php');
}
