<?php
  include_once "./config.php";

  /*
  * Hide warnings from the user, i.e. if the operation timed out when
  * connecting to the database. Instead, the user is only shown
  * $db_error_message.
  */
  error_reporting(E_ALL ^ E_WARNING);

  $conn = new mysqli($db_hostname, $db_username, $db_password, $db_name);
  $conn->set_charset("utf8");
  $db_error = $conn->connect_errno;
  $db_error_message = "<p class=\"error-message\">Det går inte att ansluta till databasen just nu (felkod: $db_error).<br> Försök igen lite senare.</p>";
?>
