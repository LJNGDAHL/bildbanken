<?php
/**
 * The function stores variables in the session.
 * @param  string $givenName  The user's given name.
 * @param  string $familyName The user's family name.
 * @param  string $email      The user's email.
 * @param  string $selfie     The user's uploaded selfie. Empty by default.
 */
function storeUserInSession($givenName, $familyName, $email, $selfie = NULL) {
  $_SESSION["given-name"] = $givenName;
  $_SESSION["family-name"] = $familyName;
  $_SESSION["user-email"] = $email;
  $_SESSION["user-selfie"] = $selfie;
}
?>
