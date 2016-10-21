<?php
  include_once "./functions.php";
  
  // Redirect to index.php and destroy session when user logs out.
  header("Location: ./index.php");
  logout();
?>
