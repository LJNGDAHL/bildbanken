<?php
  include_once "./config.php";
  $conn = new mysqli($DB_HOSTNAME, $DB_USERNAME, $DB_PASSWORD, $DB_NAME);
  $conn->set_charset("utf8");
  $error = $conn->connect_errno;

  if ($error) {
    echo "<p>Failed to connect to MySQL: $error</p>";
    exit();
  }
?>
