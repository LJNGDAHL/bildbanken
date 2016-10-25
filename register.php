<?php
  include_once "./header.php";
  include_once "./config.php";
  include_once "./session.php";
  include_once "./functions.php";

  // Redirect to dashboard.php if there is already an active session.
  if (isset($_SESSION["logged-in"]) && $_SESSION["logged-in"] == true) {
    header("Location: ./dashboard.php");
  }

  // Checks if user has submitted info.
  if (isset($_POST["submit"])) {

    $all_required_filled = true;
    $required_fields = array("given-name", "family-name", "email", "new-password");

    // Check if all required fields are filled.
    for ($i = 0; $i < count($required_fields); $i++) {
      $value = $_POST[$required_fields[$i]];

      if (empty($value)) {
        $all_required_filled = false;
        break;
      }
    }

    if ($all_required_filled) {

      // Remove html tags.
      $given_name = strip_tags($_POST["given-name"]);
      $family_name = strip_tags($_POST["family-name"]);
      $email = strip_tags($_POST["email"]);
      $user_password = strip_tags($_POST["new-password"]);
      $hashed_password = hashPassword($user_password);

      include_once "database_connect.php";
      if (empty($db_error)) {

        $stmt = $conn->stmt_init();
        $query = "SELECT email FROM users WHERE email='{$email}'";
        $error_message = "";

        if ($stmt->prepare($query)) {
          $stmt->execute();
          $result = $stmt->get_result();
          $stmt->close();

          if ($result->num_rows) {
            $error_message = "<p class=\"error-message\">E-postadressen är redan registrerad.</p>";
          } else {
            $add_new_user = "INSERT INTO users VALUES (NULL, '$given_name', '$family_name', '$email', '$hashed_password', NULL)";

            // Ask database and insert values.
            mysqli_query($conn, $add_new_user);

            /* Get the last inserted id.
            *   If multiple users where to register at the same time
            *   there might be a risk using this method,
            *   but at this moment this method works fine. */
            $id = mysqli_insert_id($conn);

            // Close connection.
            $conn->close();

            storeUserInSession($id, $given_name, $family_name, $email);

            // Redirect user to dashboard.php after registration is completed.
            header("Location: dashboard.php");

          } //  This close the else statement that adds a new user to the database.
        } else {
          $error_message = "<p class=\"error-message\">Något gick galet, försök igen.</p>";
        }
      }
    }   //  This close the if statement that checks if ($all_required_filled).
  }     //  This close the statement that checks if there is submitted info.
?>
<div class="background-container">
  <header>
    <h1><a href="./index.php">Bildbanken</a></h1>
    <p>Här kan du ladda upp selfies på dig själv. Tjänsten är gratis.</p>
  </header>
  <div class="content">
    <div class="register">
      <h2>Registrera dig</h2>
      <?php
        if (!empty($db_error)) { echo $db_error_message; }
        if (!empty($error_message)) { echo $error_message; }
      ?>
      <form method="POST">
        <div class="input-wrapper">
          <label class="input-label" for="given-name">Förnamn</label>
          <input type="text" id="given-name" name="given-name" autocomplete="given-name" placeholder="Förnamn" required>
        </div>
        <div class="input-wrapper">
          <label class="input-label" for="family-name">Efternamn</label>
          <input type="text" id="family-name" name="family-name" autocomplete="family-name" placeholder="Efternamn" required>
        </div>
        <div class="input-wrapper">
          <label class="input-label" for="email">E-postadress</label>
          <input type="email" id="email" name="email" autocomplete="email" placeholder="E-postadress" required>
        </div>
        <div class="input-wrapper">
          <label class="input-label" for="new-password">Lösenord</label>
          <input type="password" id="new-password" name="new-password" autocomplete="new-password" placeholder="Nytt lösenord" required>
        </div>
        <button class="button" type="submit" name="submit">Registrera dig</button>
      </form>
      <p>Har du redan ett konto? <a href="./index.php" target="_self">Logga in</a></p>
    </div>
  </div> <!-- This closes the div with the class "content" -->
</div> <!-- This closes the div with the class "background-container" -->
<?php include_once "footer.php"; ?>
