<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap 5.0 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!-- External CSS -->
  <link rel="stylesheet" href="./styles.css">
  <title>TemplateCMS</title>
</head>
<body class="d-flex flex-column h-100">
  <!-- Header: START -->
  <header class="container">
    <div id="logo" class="text-center">
      <img src="./img/template.png" alt="template">
      <h1>Template<span>CMS<span></h1>
    </div>

    <ul class="nav justify-content-center">
      <li class="nav-item">
        <a class="nav-link active" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="posts.php">Posts</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="signup.php">Signup</a>
      </li>
      <li class="nav-item">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#login-modal">
          Login
        </button>
      </li>
    </ul>
  </header>
  <!-- Header: END -->

  <!-- Login Modal: START -->
  <div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Login</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
          </button>
        </div>

        <!-- login.inc.php - Will process the data from this form-->
        <div class="modal-body">
          <!-- LOGIN FORM: START -->
          <form action="includes/login.inc.php" method="POST">
            <div class="mb-3">
              <label for="email" class="col-form-label">Email address:</label>
              <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="mailuid" placeholder="Email Address">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="mb-3">
              <label for="password" class="col-form-label">Password:</label>
              <input type="password" class="form-control" id="password" name="pwd" placeholder="Password"></input>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary w-100" name="login-submit">Login</button>
            </div>
          </form>
          <!-- LOGIN FORM: END -->
        </div>
      </div>
    </div>
  </div>
  <!-- Login Modal: END -->

  <!-- Error Message from GET: START -->
  <section class="container mt-3">

  </section>  
  <!-- Error Message from GET: END -->