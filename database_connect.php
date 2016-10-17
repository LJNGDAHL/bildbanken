<?php
  include "./config.php";
  $conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
  $conn->set_charset("utf8");
  $error = $conn->connect_errno;

  if ($error) {
    echo "<p>Failed to connect to MySQL: $error</p>";
    exit();
  }
?>
