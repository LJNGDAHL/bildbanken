<?php
  include "./header.php";
  include "./database_connect.php";
  include "./config.php";
?>
<?php
  // This checks if there is an existing cookie.
  // Make sure to destroy session and cookies if logged out.
  if (isset($_COOKIE["email"])): ?>

    <body class="home">
      <div>
        <header>
          <h1>Bildbanken</h1>
        </header>
        <?php

        $stmt = $conn->stmt_init();

        $currentUserEmail = $_COOKIE["email"];
        $query = "SELECT * FROM users WHERE email='$currentUserEmail'";

        if($stmt->prepare($query)) {

          $stmt->execute();
          $stmt->bind_result($id, $given_name, $family_name, $email, $password, $image);

          while (mysqli_stmt_fetch($stmt)) {
            echo "<p>Inloggad användare: <br>$given_name $family_name</p>";
          }
          $stmt->close();
        }
        else {
          // Denna använder du för att få meddelande om fel.
          echo mysqli_stmt_error($stmt);
        }
        $conn->close();
        ?>
        <pre><?php var_dump($_COOKIE); ?> </pre>
      </div>
      <?php
      include_once "./footer.php";
      // TODO: Check all "include".
      ?>
    </body>
    <?php else:
      header("Location: ./index.php");
    ?>
  <?php endif ?>
