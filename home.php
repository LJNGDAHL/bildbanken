<?php
  include_once "./header.php";
  include_once "./database_connect.php";
  include_once "./config.php";
?>


<?php
  // This checks if there is an existing cookie.
  // Make sure to destroy session and cookies if logged out.
  if (isset($_COOKIE["id"])): ?>
    <body class="home">
    <div>
      <header>
        <h1>Hej!</h1>
      </header>
    <p>Du är nu inloggad.</p>
    </div>

    <pre><?php var_dump($_COOKIE); ?> </pre>
    <?php include_once "footer.php"; ?>
    </body>

    <?php else: header("Location: index.php"); ?>
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
