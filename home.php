<?php
  include "./header.php";
  include "./database_connect.php";
  include "./config.php";
?>
<?php
  // This checks if there is an existing cookie.
  // Make sure to destroy session and cookies if logged out.
  if (isset($_COOKIE["email"])): ?>
    <body class="home">
      <div>
      <header>
        <h1>Hej!</h1>
      </header>
      </header>
        <p>Du är nu inloggad.</p>
        <pre><?php var_dump($_COOKIE); ?> </pre>
      </div>
      <?php include_once "footer.php";
      // TODO: Check all "include".
      ?>
    </body>


  <?php else:
    header("Location: index.php");
  ?>
  <?php endif ?>
<?php
// unset($_COOKIE["username"]);
// var_dump($_COOKIE);


// This destroys a session.
// <?php
//   function destroy_session_and_data()
//   {
//     session_start();
//     $_SESSION = array();
//     setcookie(session_name(), '', time() - 2592000, '/');
//     session_destroy();
// }

?>
