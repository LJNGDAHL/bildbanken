<?php
  include_once "./header.php";
  include_once "./logincheck.php";
?>
<div class="background-container">
  <header>
    <h1><a href="./index.php">Bildbanken</a></h1>
    <p>Här kan du ladda upp selfies på dig själv. Tjänsten är gratis.</p>
  </header>
  <div class="content">
    <form method="POST">
      <div class="login">
        <h2>Logga in</h2>
        <?php if(!empty($error_message)) { echo $error_message; } ?>
        <div class="input-wrapper">
          <input type="email" id="email" name="email" autocomplete="email" placeholder="E-postadress">
          <label class="input-label" for="email">E-postadress</label>
        </div>
        <div class="input-wrapper">
          <input type="password" id="password" name="password" autocomplete="current-password" placeholder="Lösenord">
          <label class="input-label" for="password">Lösenord</label>
        </div>
        <button class="button" type="submit" name="submit">Logga in</button>
        <p>Ny användare? <a href="./register.php" target="_self">Registrera dig gratis</a></p>
      </div>
    </form>
  </div> <!-- This closes the div with the class "content" -->
</div> <!-- This closes the div with the class "background-container" -->
<?php include_once "footer.php"; ?>
