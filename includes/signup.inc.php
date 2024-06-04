<?php
  if(isset($_POST['signup-submit'])){
    // 1. CONNECTION
    require ' ./connect.inc.php';

    // 2. Store form data in local variables
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    // Strong password REGEX
    $pwdReg = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/";

    // 3. *NEW* - Validation (check for user error - HTTP 400 errors)
    // a. Empty fields
    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
      // --> error
      header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
      exit();
    }

    // Check username AND email both
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)){
      header("Location: ../signup.php?error=invalidmailuid");
      exit();
    }

    // b. Check our username has valid characters (regex)
    else if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
      // --> error
      header("Location: ../signup.php?error=invaliduid&mail=" . $email);
      exit();
    }

    // c. Check our email has valid syntax
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      // --> error
      header("Location: ../signup.php?error=invalidmail&uid=" . $username);
      exit();
    }

    // d. Password repeat check
    else if($password !== $passwordRepeat){
      // --> error
      header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
      exit();
    }

    // e. Password strength (regex)
    /* 
      - 1 capital letter
      - 1 number
      - 1 special character/symbol
      - all characters must only contain the above
      - must be at minimum 8 character or more
    */
    else if(!preg_match($pwdReg, $password)){
      // --> error
      header("Location: ../signup.php?error=invalidpwd&uid=" . $username . "&mail=" . $email);
      exit();
    }

    // 4. SQL 1 - Checks if a user ALREADY exists
    else {
      // a. State placeholder SQL with ?
      $sql = "SELECT uidUsers FROM users WHERE uidUsers=?";

      // b. Init the prepared statement
      $statement = $conn->stmt_init();

      // c. Prepare + send SQL statement to database
      if(!$statement->prepare($sql)){
        header("Location: ../signup.php?error=sqlerror");
        exit();
      }

      // d. Bind data with the statement
      $statement->bind_param("s", $username);

      // e. Execution
      $statement->execute();

      // f. EXTRA (Select) -> retrieve data
      $statement->store_result();

      // Checking for duplicate result
      $resultCheck = $statement->num_rows();
      if($resultCheck > 0){
        header("Location: ../signup.php?error=usertaken&mail=".$email);
        exit();
      } 

      // 5. SQL 2 - Add the valid user to DB
      else {
        // [A] PREPARATION STAGE
        // 1. Placeholder SQL
        $sql = "INSERT INTO users (uidUsers, emailUsers, pwdUsers) VALUES (?,?,?)";

        // 2. Init statement
        $statement = $conn->stmt_init();

        // 3. Test placeholder statement
        if(!$statement->prepare($sql)){
          header("Location: ../signup.php?error=sqlerror");
          exit();
        }
        // Encryption (only passwords)
        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        // [B] EXECUTION STAGE
        // 4. Bind params
        $statement->bind_param("sss", $username, $email, $hashedPwd);

        // 5. Execute query & test success
        $result = $statement->execute();
        if(!$result){
          header("Location: ../signup.php?error=servererror");
          exit();
        }

        // SUCCESS: Pass user back with success
        header("Location: ../signup.php?signup=success");
        exit();
      }
    }
    // Close stmt & conn to db
    $statement->close();
    $conn->close();

  } else {
    // Redirect = forbidden form submission
    header("Location: ../signup.php?error=forbidden");
    exit();
  }
?>