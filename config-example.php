<?php
  // Variables used for creating a session cookie.
  $session_time = 60 * 60 * 24 * 7; // in this case, a week.
  $session_name = "session_name";

  // Variables used to connect to the database.
  $db_hostname = ""; // The hostname of the database.
  $db_username = ""; // The username of the database.
  $db_password = ""; // The password of the database.
  $db_name = ""; // The name of the database.

  // Variables that salt the hashed password.
  $salt_prefix = "salt_prefix_example";
  $salt_suffix = "salt_suffix_example";
?>
