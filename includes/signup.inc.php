<?php
if (isset($_POST['signup-submit'])) {
    // 1. CONNECTION
    require './connect.inc.php';

    // 2. Store form data in local variables
    $username = $_POST['uid'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwd-repeat'];

    // Strong password REGEX
    $pwdReg = "/^(?=.*[0-9])(?=.*[A-Z])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/";

    // 3. *NEW* - Validation (check for user error - HTTP 400 errors)
    // a. Empty fields
    if (empty($username) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: ../signup.php?error=emptyfields&uid=" . $username . "&mail=" . $email);
        exit();
    }

    // Check username AND email both
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invalidmailuid");
        exit();
    }

    // b. Check our username has valid characters (regex)
    else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?error=invaliduid&mail=" . $email);
        exit();
    }

    // c. Check our email has valid syntax
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?error=invalidmail&uid=" . $username);
        exit();
    }

    // d. Password repeat check
    else if ($password !== $passwordRepeat) {
        header("Location: ../signup.php?error=passwordcheck&uid=" . $username . "&mail=" . $email);
        exit();
    }

    // e. Password strength (regex)
    else if (!preg_match($pwdReg, $password)) {
        header("Location: ../signup.php?error=invalidpwd&uid=" . $username . "&mail=" . $email);
        exit();
    }

    // 4. SQL 1 - Checks if a user ALREADY exists
    else {
        $sql = "SELECT username FROM users WHERE username=?";

        $statement = $conn->stmt_init();

        if (!$statement->prepare($sql)) {
            header("Location: ../signup.php?error=sqlerror");
            exit();
        }

        $statement->bind_param("s", $username);

        $statement->execute();

        $statement->store_result();

        $resultCheck = $statement->num_rows();
        if ($resultCheck > 0) {
            header("Location: ../signup.php?error=usertaken&mail=" . $email);
            exit();
        } 

        // 5. SQL 2 - Add the valid user to DB
        else {
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

            if (!$statement->prepare($sql)) {
                header("Location: ../signup.php?error=sqlerror");
                exit();
            }
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            $statement->bind_param("sss", $username, $email, $hashedPwd);

            if (!$statement->execute()) {
                header("Location: ../signup.php?error=servererror");
                exit();
            }

            header("Location: ../signup.php?signup=success");
            exit();
        }
    }
    $statement->close();
    $conn->close();

} else {
    header("Location: ../signup.php?error=forbidden");
    exit();
}
?>