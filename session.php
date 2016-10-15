<?php
  // Sets the time for the session and then starts it.
  session_set_cookie_params($sessionTime);
  session_name($sessionName);
  session_start();
?>
