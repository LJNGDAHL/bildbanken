<?php
  include_once "header.php";
?>
<body>
  <header>
    <h1><a href="./index.php">Bildbanken</a></h1>
    <p>Här kan du ladda upp selfies på dig själv. Tjänsten är gratis.</p>
  </header>
  <div class="content">
    <?php // TODO: Don't forget to add an action. ?>
    <form method="post" action="">
      <div class="register">
      <h2>Registrera dig</h2>
        <form>
          <div class="input-wrapper">
            <label for="given-name">Förnamn</label>
            <input type="text" id="given-name" name="given-name" autocomplete="given-name" placeholder="Förnamn">
          </div>
          <div class="input-wrapper">
            <label for="family-name">Efternamn</label>
            <input type="text" id="given-name" name="family-name" autocomplete="family-name" placeholder="Efternamn">
          </div>
          <div class="input-wrapper">
            <label for="email">E-postadress</label>
            <input type="email" id="email" name="email" autocomplete="email" placeholder="E-postadress">
          </div>
          <div class="input-wrapper">
            <label for="new-password">Lösenord</label>
            <input type="password" id="Lösenord" name="new-password" autocomplete="new-password" placeholder="Nytt lösenord">
          </div>
          <button type="submit" name="submit">Registrera dig</button>
        </form>
        <?php
          if (isset($_POST["submit"])) {
            $allRequiredFilled = true;
            $requiredFields = array("given-name", "family-name", "email", "new-password");

            // Checks that all required fields are filled.
            for ($i = 0; $i < count($requiredFields); $i++) {
              $value = $_POST[$requiredFields[$i]];

              if ($value == NULL || trim($value) == "") {
                $allRequiredFilled = false;
                break;
              }
            }

          if ($allRequiredFilled) {
            // Remove html tags.
            $userGivenName = strip_tags($_POST["given-name"]);
            $userFamilyName = strip_tags($_POST["family-name"]);
            $userEmail = strip_tags($_POST["email"]);
            $userPassword = strip_tags($_POST["new-password"]);

            include_once "./config.php";
            //This variable hashes and salts the password.
            $hashedPassword =
            hash("ripemd128", "$SALT_PREFIX$userPassword$SALT_SUFFIX");

            include_once "database_connect.php";

            // Kom ihåg att sätta tillbaka lösenord
            $addNewUser = "INSERT INTO users VALUES (NULL, '$userGivenName', '$userFamilyName', '$userEmail', '$hashedPassword', NULL)";

            // Ask database and insert values.
            mysqli_query($conn, $addNewUser);

            // Close connection.
            $conn->close();
            // TODO: Glöm inte att stänga alla dina uppkopplingar!

            header("Location: home.php");
            // This sets the cookie for one hour.
            setcookie("id", $id, time() + (3600));
            }
          }
        ?>
        <p>Har du redan ett konto? <a href="./index.php" target="_self">Logga in</a></p>
      </div>
    </form>
  </div>
</body>
<?php
  include_once "footer.php";
?>
