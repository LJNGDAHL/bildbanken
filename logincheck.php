<?php
include_once "./config.php";
include_once "./session.php";
include_once "./functions.php";

  // Check if there is already an active session.
  if(isset($_SESSION["user-email"])) {

    header("Location: ./dashboard.php");

  // Check if the user has pressed the submit button.
  } elseif(isset($_POST["submit"])) {

    // Check if input fields for email and password are filled.
    if(!empty($_POST["email"]) && !empty($_POST["password"])) {

      include_once "database_connect.php";

      $userEmail = mysqli_real_escape_string($conn, $_POST["email"]);
      $userPassword = mysqli_real_escape_string($conn, $_POST["password"]);

      /*  This variable hashes and salts the password.
       *  The variables $SALT_PREFIX and $SALT_SUFFIX
       *  are found in config.php. */
      $hashedPassword = hash("ripemd128", "$SALT_PREFIX$userPassword$SALT_SUFFIX");

      $stmt = $conn->stmt_init();
      $checkEmail = "SELECT * FROM users WHERE email = '{$userEmail}'";

      if($stmt->prepare($checkEmail)) {

        $stmt->execute();
        $stmt->bind_result($id, $givenName, $familyName, $email, $password, $selfie);
        $stmt->fetch();
        $stmt->close();
        $conn->close();

        if ($hashedPassword == $password) {
          header("Location: ./dashboard.php");

          storeUserInSession($givenName, $familyName, $email, $selfie);

        } else {
          $errorMessage = "<p class=\"error-message\">Du har angivit fel lösenord och/eller e-postadress.</p>";
        }
      } else {
        // Prints error message.
        echo mysqli_stmt_error($stmt);
      }
    } // Close the check if input fields for email and password are filled.
  } // Close the check the user has pressed the submit button.
?>
