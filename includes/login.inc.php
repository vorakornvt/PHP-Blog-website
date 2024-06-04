<?php 
if (isset($_POST['signup-submit'])) {
  // 1. CONNECTION
  require './connect.inc.php';

  // Assign form data to local vars
  $mailuid = $_POST['mailuid'];
  $password = $_POST['pwd'];

  // Validation
  if(empty($mailuid) || empty($password)){
    // --> error
    header("Location: ../index.php?loginerror=emptyfields");
    exit();
  }

  // SQL Query: Check if User Exists in database = using email
  // a. Placeholder SQL
  $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";

  // b. Init the prepared statement
  $statement = $conn->stmt_init();

  // c. Preparing & sending statement to db
  if(!$statement->prepare($sql)){
    // ERROR
    header("Location: ../index.php?loginerror=sqlerror");
    exit();
  }

  // d. Binding the data
  $statement->bind_param("ss", $mailuid, $mailuid);

  // e. Execution of query
  $statement->execute();

  // Return the result & get my row of matching data
  $result = $statement->get_result();
  if($row = $result->fetch_assoc()){
    // INSIDE THIS BLOCK = VALID USER IN DB
    $pwdCheck = password_verify($password, $row['pwdUsers']);

    // a. FAILED AUTH
    if(!$pwdCheck){
      header("Location: ../index.php?loginerror=wrongpwd");
      exit();
    }

    // b. SUCCESS AUTH: User is logged in!
    else {
      session_start();
      $_SESSION['userId'] = $row['idUsers'];  // id
      $_SESSION['userUid'] = $row['uidUsers'];  // username

      // User information set = redirect for success
      header("Location: ../index.php?login=success");
      exit();
    }
  } else {
    // NO VALID USER
    header("Location: ../index.php?loginerror=nouser");
    exit();
  }

} else {
  // Redirect = forbidden form submission
  header("Location: ../index.php?loginerror=forbidden");
  exit();
}
?>