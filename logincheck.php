<?php
include "./config.php";
include "./session.php";
include "./functions.php";

  // Check if there is already an active session.
  if(isset($_SESSION["user-email"])) {

    header("Location: ./dashboard.php");

  // Check if the user has pressed the submit button.
  } elseif(isset($_POST["submit"])) {

    // Check if input fields for email and password are filled.
    if(!empty($_POST["email"]) && !empty($_POST["password"])) {

      include "database_connect.php";

      $user_email = mysqli_real_escape_string($conn, $_POST["email"]);
      $user_password = mysqli_real_escape_string($conn, $_POST["password"]);

      /*  This variable hashes and salts the password.
       *  The variables $salt_prefix and $salt_suffix
       *  are found in config.php. */
      $hashed_password = hash("ripemd128", "$salt_prefix$user_password$salt_suffix");

      $stmt = $conn->stmt_init();
      $checkEmail = "SELECT * FROM users WHERE email = '{$user_email}'";

      if($stmt->prepare($checkEmail)) {

        $stmt->execute();
        $stmt->bind_result($id, $given_name, $family_name, $email, $password, $selfie);
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        if ($hashed_password == $password) {
          header("Location: ./dashboard.php");

          store_user_in_session($id, $given_name, $family_name, $email, $selfie);

        } else {
          $error_message = "<p class=\"error-message\">Du har angivit fel lösenord och/eller e-postadress.</p>";
        }
      } else {
        // Prints error message.
        echo mysqli_stmt_error($stmt);
      }
    } // Close the check if input fields for email and password are filled.
  } // Close the check the user has pressed the submit button.
?>
