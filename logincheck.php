<?php
// TODO: Kolla på detta, det är nog inte rätt.
  if(isset($_POST["submit"])) {

    if(!empty($_POST["email"]) && !empty($_POST["password"])) {

      include_once "database_connect.php";

      $userEmail = mysqli_real_escape_string($conn, $_POST["email"]);
      $userPassword = mysqli_real_escape_string($conn, $_POST["password"]);

      include_once "./confiq.php";
      //This variable hashes and salts the password.
      $hashedPassword = hash("ripemd128", "$SALT_PREFIX$userPassword$SALT_SUFFIX");
      $stmt = $conn->stmt_init();
      $checkEmail = "SELECT * FROM users WHERE email = '{$userEmail}'";

      if($stmt->prepare($checkEmail)) {

        $stmt->execute();
        $stmt->bind_result($id, $givenName, $familyName, $email, $password, $selfie);
        $stmt->fetch();

        if($id != 0 && $hashedPassword == $password && $userEmail == $email) {
            header("Location: home.php");

            // // Sets a cookie for one hour.
            // setcookie("email", hash("ripemd128", $email), time() + (3600));
            setcookie("id", $id, time() + (3600));
          }
        else {
          // TODO: Lägg till olika scenarier, om e-postadress inte finns etc.
            header("Location: login.php");
        }
      } // This close the $checkEmail statement.

      else {
        // Denna använder du för att få meddelande om fel.
        echo mysqli_stmt_error($stmt);
      }

      $stmt->close();
      $conn->close();
    } // This close the check of email and password are filled.
  }
?>
