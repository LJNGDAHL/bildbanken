<?php
  include_once "./header.php";
  include_once "./database_connect.php";
  include_once "./config.php";
  include_once "./session.php";
  include_once "./peptalk.php";
  include_once './functions.php';

  // Print content on dashboard.php if there is a current session active.
  if (!isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == false) {
    header("Location: ./index.php");
  }

  // Destroy session if user logs out.
  if(isset($_POST["logout"])) {
    header("Location: ./index.php");
    logout();
  }
  ?>
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
        <input class="choose-file" type="file" name="selfie" id="choose-file">
        <label for="choose-file" class="upload-file">Välj fil</label>
      <button class="mint" type="submit" name="upload">Ladda upp</button>
    </form>
    <form method="POST">
      <!-- TODO: Change into a link instead of button. -->
      <button type="submit" name="logout">Logga ut</button>
    </form>
  </div> <!-- This closes the div with the class "dashboard" -->
<?php include_once "footer.php"; ?>
<?php include_once "./file_upload.php"; ?>
