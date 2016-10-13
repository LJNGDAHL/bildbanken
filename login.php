<?php
  include "header.php";
?>
<body>
  <header>
    <h1><a href="./index.php">Ooops, något blev fel...</a></h1>
  </header>
  <div class="content">
    <form method="POST" action="./login.php">
      <div class="login">
        <h2>Logga in</h2>
        <p>Du angav fel e-postadress och/eller lösenord.</p>
        <div class="input-wrapper">
          <input type="email" id="email" name="email" autocomplete="email" placeholder="E-postadress">
          <label for="email">E-postadress</label>
        </div>
        <div class="input-wrapper">
          <input type="password" id="password" name="password" autocomplete="password" placeholder="Lösenord">
          <label for="password">Lösenord</label>
        </div>
        <button type="submit" name="submit">Logga in</button>
        <?php include "logincheck.php"; ?>
        <p>Har du inget konto? <a href="./register.php" target="_self">Registrera dig gratis</a></p>
      </div>
    </form>
  </div>
</body>
<?php
  include "footer.php";
?>
