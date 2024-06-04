<?php 
session_start(); // Start the session

if(isset($_POST['login-submit'])){
    // Connect to DB
    require './connect.inc.php';

    // Assign form data to local vars
    $mailuid = $_POST['mailuid'];
    $password = $_POST['pwd'];

    // Validation
    if(empty($mailuid) || empty($password)){
        // Error: empty fields
        header("Location: ../index.php?loginerror=emptyfields");
        exit();
    }

    // SQL Query: Check if User Exists in database using email or username
    // a. Placeholder SQL
    $sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?";

    // b. Init the prepared statement
    $statement = $conn->stmt_init();

    // c. Preparing & sending statement to db
    if(!$statement->prepare($sql)){
        // Error: SQL error
        header("Location: ../index.php?loginerror=sqlerror");
        exit();
    }

    // d. Binding the data
    $statement->bind_param("ss", $mailuid, $mailuid);

    // e. Execution of query
    $statement->execute();

    // Return the result & get matching row
    $result = $statement->get_result();
    if($row = $result->fetch_assoc()){
        // Valid user found in DB
        $pwdCheck = password_verify($password, $row['pwdUsers']);

        // a. Failed authentication
        if(!$pwdCheck){
            header("Location: ../index.php?loginerror=wrongpwd");
            exit();
        }

        // b. Successful authentication: User is logged in
        else {
            $_SESSION['userId'] = $row['idUsers'];  // User ID
            $_SESSION['userUid'] = $row['uidUsers'];  // Username

            // User information set: redirect for success
            header("Location: ../index.php?login=success");
            exit();
        }
    } else {
        // No valid user found
        header("Location: ../index.php?loginerror=nouser");
        exit();
    }
} else {
    // Redirect for forbidden form submission
    header("Location: ../index.php?loginerror=forbidden");
    exit();
}
?>

