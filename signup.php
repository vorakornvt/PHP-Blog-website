<?php require './templates/header.php'; ?>

<main class="container p-4 bg-light mt-3">
    <form action="./includes/signup.inc.php" method="post">
        <h2>Signup</h2>
        <?php 

        $errorMsg = '';

        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                $errorMsg = "Please fill in all fields";
            } else if ($_GET['error'] == "invalidmailuid") {
                $errorMsg = "Invalid email and Password";
            } else if ($_GET['error'] == "invalidmail") {
                $errorMsg = "Invalid email";
            } else if ($_GET['error'] == "invaliduid") {
                $errorMsg = "Invalid username";
            } else if ($_GET['error'] == "passwordcheck") {
                $errorMsg = "Passwords do not match";
           } else if ($_GET['error'] == "invalidpwd") {
                $errorMsg = "Invalid Password";
            } else if ($_GET['error'] == "usertaken") {
                $errorMsg = "Username already taken";
            } else if ($_GET['error'] == "sqlerror") {
                $errorMsg = "An internal server error has occurred - please try again later";
            }
            echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
        } else if (isset($_GET['signup']) && $_GET['signup'] == "success") {
            echo '<div class="alert alert-success" role="alert">You have successfully signed up!</div>';    
        }
        ?>
        
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input 
                type="text" 
                class="form-control" 
                name="uid" 
                placeholder="Username"
                value="<?php if (isset($_GET['uid'])) { echo $_GET['uid']; } ?>"
            >
        </div>  

        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" name="mail" placeholder="Email Address" value="<?php if (isset($_GET['mail'])) { echo $_GET['mail']; } ?>">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="pwd" placeholder="Password">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" name="pwd-repeat" placeholder="Confirm Password">
        </div>

        <button type="submit" name="signup-submit" class="btn btn-dark w-100">Signup</button>
    </form>
</main>

<?php require './templates/footer.php'; ?>