<?php
  include "./header.php";
  include "./database_connect.php";
  include "./config.php";
  include "./session.php";
  include "./peptalk.php";

  // Destroy session if user logs out.
  if(isset($_POST["logout"])) {
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
      <?php if(isset($_SESSION["user-selfie"])): ?>
      <div class="welcome-text">
        <p>Hej <?php echo $_SESSION["given-name"];?>!<br>
        <?php echo $peptalk[$random_peptalk]; ?><br>
      </div>
      <img class="selfie" src="<?php echo $_SESSION["user-selfie"] ?>" alt="Foto på <?php echo $_SESSION["given-name"]; ?>">
      <?php else: ?>
        <div class="placeholder-selfie">
          <p>Du har inte laddat upp någon selfie än. :(</p>
        </div>
      <?php endif ?>
      <form method="POST" enctype="multipart/form-data">
        <input class="choose-file" type="file" name="selfie">
        <button class="terracotta" type="submit" name="upload">Ladda upp</button>
      </form>
      <form method="POST">
        <!-- TODO: Change into a link instead of button. -->
        <button type="submit" name="logout">Logga ut</button>
      </form>
    </div> <!-- This closes the div with the class "dashboard" -->
  <?php // Redirect user to index.php if no session is active.
  else: header("Location: ./index.php");
  ?>
<?php endif ?>
<?php include "footer.php"; ?>
<?php include "./file_upload.php"; ?>
