<?php
  include "header.php";
?>
<header>
  <h1><a href="./index.php">Bildbanken</a></h1>
  <p>Här kan du ladda upp selfies på dig själv. Tjänsten är gratis.</p>
</header>
<div class="content">
  <form method="post" action="#">
    <div class="login">
      <h2>Logga in</h2>
      <div class="input-wrapper">
        <input type="email" id="email" name="email" autocomplete="email" placeholder="E-postadress">
        <label for="email">E-postadress</label>
      </div>
      <div class="input-wrapper">
        <input type="password" id="password" name="password" autocomplete="password" placeholder="Lösenord">
        <label for="password">Lösenord</label>
      </div>
      <button type="submit">Logga in</button>
      <p>Ny användare? <a href="./register.php" target="_self">Registrera dig gratis</a></p>
    </div>
  </form>
</div>
<?php
  include "footer.php";
?>
