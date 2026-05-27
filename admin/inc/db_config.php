<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "hotel_management";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

function filteration($data)
{
  foreach ($data as $key => $value) {
    $value = trim($value);
    $value = stripslashes($value); // fixed function name from stripcslashes
    $value = strip_tags($value);
    $value = htmlspecialchars($value);
    $data[$key] = $value;
  }
  return $data;
}

function selectAll($table)
{
  $conn = $GLOBALS['conn'];
  $res = mysqli_query($conn, "SELECT *FROM $table");
  return $res;
}

function select($sql, $values, $datatypes)
{
  $conn = $GLOBALS['conn'];
  if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
    if (mysqli_stmt_execute($stmt)) {
      $res = mysqli_stmt_get_result($stmt);
      mysqli_stmt_close($stmt);
      return $res;
    } else {
      mysqli_stmt_close($stmt);
      die("Query cannot be executed - Select");
    }
  } else {
    die("Query cannot be prepared - Select");
  }
}

function update($sql, $values, $datatypes)
{
  $conn = $GLOBALS['conn'];

  if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, $datatypes, ...$values);

    if (mysqli_stmt_execute($stmt)) {
      $res = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res; // Returns number of affected rows
    } else {
      mysqli_stmt_close($stmt);
      die("Query cannot be executed - Update");
    }
  } else {
    die("Query cannot be prepared - Update");
  }
}

function insert($sql, $values, $datatypes)
{
  $conn = $GLOBALS['conn'];

  if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, $datatypes, ...$values);

    if (mysqli_stmt_execute($stmt)) {
      $res = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res; // Returns number of affected rows
    } else {
      mysqli_stmt_close($stmt);
      die("Query cannot be executed - Insert");
    }
  } else {
    die("Query cannot be prepared - Insert");
  }
}

function delete($sql, $values, $datatypes)
{
  $conn = $GLOBALS['conn'];

  if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, $datatypes, ...$values);

    if (mysqli_stmt_execute($stmt)) {
      $res = mysqli_stmt_affected_rows($stmt);
      mysqli_stmt_close($stmt);
      return $res; // Returns number of affected rows
    } else {
      mysqli_stmt_close($stmt);
      die("Query cannot be executed - Delete");
    }
  } else {
    die("Query cannot be prepared - Delete");
  }
}
