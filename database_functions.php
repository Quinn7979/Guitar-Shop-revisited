<?php

require_once('db_credentials.php'); // Your database credentials

// Database connection function
function db_connect() {
  $connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
  confirm_db_connect($connection);
  return $connection;
}

// Function to confirm that the connection was successful
function confirm_db_connect($connection) {
  if($connection->connect_errno) {
    $msg = "Database connection failed: ";
    $msg .= $connection->connect_error;
    $msg .= " (" . $connection->connect_errno . ")";
    exit($msg);
  }
}

// Disconnect function
function db_disconnect($connection) {
  if(isset($connection)) {
    $connection->close();
  }
}
