<?php
$connection = mysqli_connect('localhost', 'root', '', 'cw');
if (!$connection) {
    die("Connection failed: "  . mysqli_connect_error());
  }
?>
