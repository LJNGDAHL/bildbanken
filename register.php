<?php
  include "header.php";
?>
<header>
  <h1><a href="./index.php">Bildbanken</a></h1>
  <p>Här kan du ladda upp selfies på dig själv. Tjänsten är gratis.</p>
</header>
<div class="content">
  <form method="post" action="#">
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
        if(isset($_POST["submit"])) {

          if(
          !empty($_POST["given-name"]) &&
          !empty($_POST["family-name"]) &&
          !empty($_POST["email"]) &&
          !empty($_POST["new-password"])
          ) {
            // Tar bort html-taggar med hjälp av funktionen strip_tags.
            $userGivenName = strip_tags($_POST["given-name"]);
            $userFamilyName = strip_tags($_POST["family-name"]);
            $userEmail = strip_tags($_POST["email"]);
            $userPassword = strip_tags($_POST["new-password"]);

            // Steg 1 Upprätta en databasanslutning.
            $conn = new mysqli("localhost", "root", "", "bildbanken");

            $query = "INSERT INTO users VALUES (NULL, '$userGivenName', '$userFamilyName', '$userEmail', '$userPassword', NULL)";

            //Steg 3: Kör frågan mot databasen och gör en insättning.
            mysqli_query($conn, $query);
            // echo mysqli_error($conn);
            echo "<p>Du är nu registrerad.</p>";
            }
        }
      ?>
      <p>Har du redan ett konto? <a href="./index.php" target="_self">Logga in</a></p>
    </div>
  </form>
</div>
<?php
  include "footer.php";
?>
