<?php
session_start();

$avatar = isset($_SESSION['userUid']) ? strtoupper(substr($_SESSION['userUid'], 0, 2)) : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap 5.0 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <style>
    .avatar {
      width: 45px;
      height: 45px;
      border-radius: 50%;
      border: solid 0.5px black;
      background-color: white;
      color: black;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 20px;
      margin: auto;
      font-family: "Prata", serif;
    }
  </style>

  <!-- External CSS -->
  <link rel="stylesheet" href="/dwd/Assessment2PHP/styles.css">
  <title>ARTIFY</title>
</head>
<body class="d-flex flex-column">

<!-- Header: START -->
<nav class="navbar navbar-expand-lg bg-body-tertiary border-bottom">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      <img src="./img/Asset4.png" alt="ArtifyLOGO" width="130">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="nav justify-content-center">
        <li class="nav-item">
          <a class="nav-link active link-dark" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link-dark" href="posts.php">Posts</a>
        </li>
        <?php
        if (isset($_SESSION['userId']))  {
          echo '<li class="nav-item">
                  <a class="nav-link active link-dark" href="/dwd/Assessment2PHP/createpost.php">Create Post</a>
                </li>';
          echo '<li class="nav-item">
                  <a class="nav-link active link-dark" href="/dwd/Assessment2PHP/upload.php">Upload Your Artwork</a>
                </li>';
        } else {
          echo '<li class="nav-item">
                  <a class="nav-link active link-dark" href="/dwd/Assessment2PHP/signup.php">Get started</a>
                </li>
                <li class="nav-item">
                  <!-- Button trigger modal -->
                  <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#login-modal">
                    Login
                  </button>
                </li>';
        }
        ?>
      </ul>
    </div>
    <?php
    if (isset($_SESSION['userId'])) {
      echo '<div class="dropdown ms-3">
              <button class="btn btn-outline-light dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar">' . $avatar . '</div></button>
              <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li class="dropdown-item-text">' . $_SESSION['userUid'] . '</li>
                <li><hr class="dropdown-divider"></li>
                  <form action="/dwd/Assessment2PHP/includes/logout.inc.php" method="POST" class="d-inline">
                    <button type="submit" class="dropdown-item" name="logout-submit">Logout</button>
                  </form>
                </li>
              </ul>
            </div>';
    }
    ?>
  </div>
</nav>
<!-- Header: END -->

<!-- Login Modal: START -->
<div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <!-- login.inc.php - Will process the data from this form-->
      <div class="modal-body">
        <!-- LOGIN FORM: START -->
        <form action="/dwd/Assessment2PHP/includes/login.inc.php" method="POST">
          <div class="mb-3">
            <label for="email" class="col-form-label">Email address:</label>
            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="mailuid" placeholder="Email Address">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
          </div>
          <div class="mb-3">
            <label for="password" class="col-form-label">Password:</label>
            <input type="password" class="form-control" id="password" name="pwd" placeholder="Password">
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-dark w-100" name="login-submit">Login</button>
          </div>
        </form>
        <!-- LOGIN FORM: END -->
      </div>
    </div>
  </div>
</div>
<!-- Login Modal: END -->


<!-- Error Message from GET: START -->
<div class="container mt-3">
<?php
// GRACEFUL LOGIN ERROR/SUCCESS MESSAGES
if(isset($_GET['loginerror'])){
  // SPECIFIC ERRORS
  if($_GET['loginerror'] == "emptyfields"){
    $errorMsg = "Please fill in all fields";
  }
  else if($_GET['loginerror'] == "forbidden"){
    $errorMsg = "Action not permitted";
  }
  else if($_GET['loginerror'] == "sqlerror"){
    $errorMsg = "Internal server error - please try again later";
  }
  else if($_GET['loginerror'] == "nouser"){
    $errorMsg = "The user does not exist";
  }
  else if($_GET['loginerror'] == "wrongpwd"){
    $errorMsg = "Wrong password";
  }
  echo '<div class="alert text-center alert-secondary" role="alert">'.$errorMsg.'</div>';
} 
?>
</div>
<!-- Error Message from GET: END -->