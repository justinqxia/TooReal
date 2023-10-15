<?php
$servername = "";

$dBUsername = "";
$dBPassword = "";

$dBName = "";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);
if (!$conn) {
  die("CONNECTION FAILED: " . mysqli_connect_error()); // check if connection is FAILED
}