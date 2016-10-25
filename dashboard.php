<?php
  include_once "./header.php";
  include_once "./database_connect.php";
  include_once "./config.php";
  include_once "./session.php";
  include_once "./peptalk.php";
  include_once './functions.php';
  include_once "./file_upload.php";

  // Print content on dashboard.php if there is a current session active.
  if (!isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == false) {
    header("Location: ./index.php");
  }
  ?>
  <div class="dashboard">
    <header>
      <h1>Bildbanken</h1>
    </header>
    <?php if (isset($_SESSION["user-selfie"])): ?>
    <div class="welcome-text">
      <p>Hej <?php echo $_SESSION["given-name"]; ?>!<br>
      <?php echo $peptalk[$random_peptalk]; ?><br>
    </div>
    <img class="selfie" src="<?php echo $_SESSION["user-selfie"]; ?>" alt="Foto på <?php echo $_SESSION["given-name"]; ?>">
    <?php else: ?>
      <div class="placeholder-selfie">
        <div class="welcome-text">
          <p>Välkommen <?php echo $_SESSION["given-name"]; ?>!<br>
        </div>
        <p>Du har inte laddat upp<br> någon selfie än.</p>
      </div>
    <?php endif; ?>
    <form class="upload-form" method="POST" enctype="multipart/form-data">
      <?php
      if (!empty($db_error)) {
        echo $db_error_message;
      }

      if (isset($file_error)): ?>
        <p class="upload-message"><?php echo $file_error; ?></p>
      <?php endif;
      ?>
      <input class="choose-file" type="file" name="selfie" id="choose-file" required>
      <label for="choose-file" class="upload-file"></label>
      <button class="mint button" type="submit" name="upload">Ladda upp</button>
    </form>
    <a href="logout.php" class="button" target="_self">Logga ut</a>
  </div>
<?php include_once "footer.php"; ?>
