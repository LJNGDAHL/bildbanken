<?php
include_once "./config.php";

/**
 * The function stores variables in the session.
 * @param  string $id         The user's unique id.
 * @param  string $givenName  The user's given name.
 * @param  string $familyName The user's family name.
 * @param  string $email      The user's email.
 * @param  string $selfie     The user's uploaded selfie. Empty by default.
 */
function store_user_in_session($id, $given_name, $family_name, $email, $selfie = NULL) {
  $_SESSION["logged-in"] = true;
  $_SESSION["userid"] = $id;
  $_SESSION["given-name"] = $given_name;
  $_SESSION["family-name"] = $family_name;
  $_SESSION["user-email"] = $email;
  $_SESSION["user-selfie"] = $selfie;
}

/**
 * The function unsets and destroy all cookies stored in a session.
 */
function logout() {
  unset($_SESSION["logged-in"]);
  setcookie("session_bildbanken", "", time()-(60*60*24), "/");
  session_destroy();
}

/**
 * The function checks size and type on uploaded files.
 * @param  string $file The uploaded file.
 */
function check_uploaded_file($file) {
  $allowed_file_types = array("jpg", "jpeg", "gif", "png", "webP", "");
  $list_allowed_types = implode(", ", $allowed_file_types);
  $type = pathinfo($file["name"], PATHINFO_EXTENSION);

  if($file["size"] > 2000000) {
    return "Filen är för stor (max 2 MB).";
  }

  if($file["size"] == 0) {
    return "Du har inte laddat upp någon fil.";
  }

  if (!in_array($type, $allowed_file_types) && $file != 0) {
    return "Förbjudet filformat. <br>Tillåtna format: {$list_allowed_types}";
  }
  return NULL;
}
?>
