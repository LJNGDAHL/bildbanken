<?php
include_once "./functions.php";

// Check if user has pressed the upload button.
if (isset($_POST["upload"])) {

  $target_folder = "./userpics/";
  $file_name = basename($_FILES["selfie"]["name"]);
  $type = pathinfo($file_name, PATHINFO_EXTENSION);
  $file_error = checkUploadedFile($_FILES["selfie"]);

  $target_name = $target_folder . basename($_SESSION["userid"]) . ".$type";

  // Move file to /.userpics.
  if (!$file_error && move_uploaded_file($_FILES["selfie"]["tmp_name"], $target_name)) {

    // File upload success.
    include_once "./database_connect.php";

    if (empty($db_error)) {

      $query = "UPDATE users SET profilepic_url = '{$target_name}' WHERE id = '{$_SESSION["userid"]}'";
      $stmt = $conn->stmt_init();

      if ($stmt->prepare($query)) {
        $stmt->execute();
        $_SESSION["user-selfie"] = $target_name;

      } else {
        echo mysqli_error();
      }

      $conn->close();

      // Refresh page so that new selfie is shown.
      header("Refresh:0");
    }
  }
}
?>
