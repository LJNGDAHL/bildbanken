<?php
  include "./header.php";
  include "./database_connect.php";
  include "./config.php";
  include "./session.php";
?>
<?php
  // This checks if there is a current session active.
  if (isset($_SESSION["user-email"])): ?>
    <body class="home">
      <div>
        <header>
          <h1>Bildbanken</h1>
        </header>
        <?php
        $stmt = $conn->stmt_init();

        $currentUserEmail = $_SESSION["user-email"];
        $query = "SELECT * FROM users WHERE email='{$currentUserEmail}'";

        if($stmt->prepare($query)) {

          $stmt->execute();
          $stmt->bind_result($id, $given_name, $family_name, $email, $password, $image);

          while (mysqli_stmt_fetch($stmt)) {
            echo "<p>Inloggad användare: <br>$given_name $family_name</p>";
          }
        }
        else {
          // Prints error message.
          echo mysqli_stmt_error($stmt);
        }
        $stmt->close();
        $conn->close();
        ?>
        <form method="POST">
          <button type="submit" name="submit">Logout</button>
          <?php
          if(isset($_POST["submit"])) {
            header("Location: ./index.php");
            unset($_SESSION["userid"]);
            session_destroy();
          }
          ?>
        </form>
      </div>
    </body>
    <?php include_once "./footer.php"; // TODO: Check all "include". ?>
    <?php else: header("Location: ./index.php"); ?>
  <?php endif ?>
