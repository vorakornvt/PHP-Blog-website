<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>

<main class="container p-4 bg-light mt-3">
  <!-- signup.inc.php - Will process the data from this form-->
  <form action="includes/signup.inc.php" method="post">
    <h2>Signup</h2>
    
    <!-- 1. USERNAME -->
    <div class="mb-3">
      <label for="username" class="form-label">Username</label>
      <input type="text" class="form-control" name="uid" placeholder="Username">
    </div>  

    <!-- 2. EMAIL -->
    <div class="mb-3">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control" name="mail" placeholder="Email Address">
    </div>

    <!-- 3. PASSWORD -->
    <div class="mb-3">
      <label for="password" class="form-label">Password</label>
      <input type="password" class="form-control" name="pwd" placeholder="Password">
    </div>

    <!-- 4. PASSWORD CONFIRMATION -->
    <div class="mb-3">
      <label for="password" class="form-label">Confirm Password</label>
      <input type="password" class="form-control" name="pwd-repeat" placeholder="Confirm Password">
    </div>

    <!-- 5. SUBMIT BUTTON -->
    <button type="submit" name="signup-submit" class="btn btn-primary w-100">Signup</button>
  </form>
</main>

<!-- FOOTER.PHP -->
<?php 
  require "templates/footer.php"
?>