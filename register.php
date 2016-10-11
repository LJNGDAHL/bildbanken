<?php
  include "header.php";
?>
<header>
  <h1>Selfiebanken</h1>
  <p>Här kan du ladda upp bilder på dig själv. Tjänsten är gratis.</p>
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
        <button type="submit">Registrera dig</button>
      </form>
      <p>Har du redan ett konto? <a href="./index.php" target="_self">Logga in</a></p>
    </div>
  </form>
</div>

<?php
  include "footer.php";
?>
