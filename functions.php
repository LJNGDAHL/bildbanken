<?php


/** TODO: Kolla förklaringen.
* The function creates variables from session data.
*
* @param array $givenName  Takes the given name and inserts it into a variable.
* @param array $familyName Takes the family name and inserts it into a variable.
* @param array $email      Takes the email and inserts it into a variable.
* @param array $selfie     Takes the URL to the selfie and inserts it into a *                          variable. Is NULL by default.
**/
function storeUserInSession($givenName, $familyName, $email, $selfie = NULL) {
  $_SESSION["given-name"] = $givenName;
  $_SESSION["family-name"] = $familyName;
  $_SESSION["user-email"] = $email;
  $_SESSION["user-selfie"] = $selfie;
}
?>
