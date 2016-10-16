<?php
  include_once "./header.php";
  include_once "./database_connect.php";
  include_once "./config.php";
  include_once "./session.php";


  // Destroy session if user logs out.
  if(isset($_POST["submit"])) {
    header("Location: ./index.php");
    unset($_SESSION["userid"]);
    session_destroy();
  }

  // Print content on dashboard.php if there is a current session active.
  if (isset($_SESSION["user-email"])): ?>
    <div class="dashboard">
      <header>
        <h1>Bildbanken</h1>
      </header>
      <?php
      $stmt = $conn->stmt_init();

      $currentUser = $_SESSION["user-email"];
      $query = "SELECT * FROM users WHERE email='{$currentUser}'";

      if($stmt->prepare($query)) {

        $stmt->execute();
        $stmt->bind_result($id, $given_name, $family_name, $email, $password, $image);

        while (mysqli_stmt_fetch($stmt)) {
          echo "<p>Hej $given_name $family_name!</p>";
        }
      }
      else {
        // Print error message if something went wrong.
        echo mysqli_stmt_error($stmt);
      }
      $stmt->close();
      $conn->close();
      ?>
      <form method="POST">
        <button type="submit" name="submit">Logga ut</button>
      </form>
    </div> <!-- This closes the div with the class "dashboard" -->
  <?php // Redirect user to index.php if no session is active.
  else: header("Location: ./index.php");
  ?>
<?php endif ?>
<?php include_once "footer.php"; ?>
