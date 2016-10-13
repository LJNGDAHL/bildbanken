<?php
  if(isset($_POST["submit"])) {

    if(!empty($_POST["email"]) && !empty($_POST["password"])) {

      $conn = new mysqli("localhost", "root", "", "bildbanken");

      $userEmail = mysqli_real_escape_string($conn, $_POST["email"]);
      $userPassword = mysqli_real_escape_string($conn, $_POST["password"]);

      $stmt = $conn->stmt_init();

      if($stmt->prepare("SELECT * FROM users WHERE email = '{$userEmail}'")) {
        $stmt->execute();

        $stmt->bind_result($id, $givenName, $familyName, $email, $password, $selfie);
        $stmt->fetch();

        if($id != 0 && $userPassword == $password && $userEmail == $email) {
            header("Location: home.php");
          }
        else {
            header("Location: login.php");
        }
      }
    }
  }
?>
