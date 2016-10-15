<?php
  include "./header.php";
  include "./config.php";
  include "./session.php";
  include "./functions.php";

  // Checks if there is already an active session.
  if(isset($_SESSION["user-email"])) {

    header("Location: dashboard.php");

  } elseif (isset($_POST["submit"])) {

    $allRequiredFilled = true;
    $requiredFields = array("given-name", "family-name", "email", "new-password");

    // Checks that all required fields are filled.
    for ($i = 0; $i < count($requiredFields); $i++) {
      $value = $_POST[$requiredFields[$i]];

      // KOlla om du kan använda empty.
      if (empty($value)) {
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

    /*  This variable hashes and salts the password.
     *  The variables $SALT_PREFIX and $SALT_SUFFIX
     *  are found in config.php. */
    $hashedPassword = hash("ripemd128", "$SALT_PREFIX$userPassword$SALT_SUFFIX");

    include "database_connect.php";

    $addNewUser = "INSERT INTO users VALUES (NULL, '$userGivenName', '$userFamilyName', '$userEmail', '$hashedPassword', NULL)";

    // Ask database and insert values.
    mysqli_query($conn, $addNewUser);

    // Close connection.
    $conn->close();
    // TODO: Close all connections.

    storeUserInSession($userGivenName, $userFamilyName, $userEmail);

    // Redirect user to dashboard.php after registration is completed.
    header("Location: dashboard.php");
    }
  }
?>
<body>
  <header>
    <h1><a href="./index.php">Bildbanken</a></h1>
    <p>Här kan du ladda upp selfies på dig själv. Tjänsten är gratis.</p>
  </header>
  <div class="content">
    <form method="POST">
      <div class="register">
      <h2>Registrera dig</h2>
        <form>
          <div class="input-wrapper">
            <label for="given-name">Förnamn</label>
            <input type="text" id="given-name" name="given-name" autocomplete="given-name" placeholder="Förnamn" required>
          </div>
          <div class="input-wrapper">
            <label for="family-name">Efternamn</label>
            <input type="text" id="given-name" name="family-name" autocomplete="family-name" placeholder="Efternamn" required>
          </div>
          <div class="input-wrapper">
            <label for="email">E-postadress</label>
            <input type="email" id="email" name="email" autocomplete="email" placeholder="E-postadress" required>
          </div>
          <div class="input-wrapper">
            <label for="new-password">Lösenord</label>
            <input type="password" id="Lösenord" name="new-password" autocomplete="new-password" placeholder="Nytt lösenord" required>
          </div>
          <button type="submit" name="submit">Registrera dig</button>
        </form>
        <p>Har du redan ett konto? <a href="./index.php" target="_self">Logga in</a></p>
      </div>
    </form>
  </div>
</body>
<?php
  include "footer.php";
?>
