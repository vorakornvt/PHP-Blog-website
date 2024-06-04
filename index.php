<!-- HEADER.PHP -->
<?php 
  require "./templates/header.php"
?>

<main class="container custom-container mt-3">
    <?php
      if(isset($_SESSION['userId'])){
        // logged in
        echo '<div class="alert alert-info" role="alert">
          Welcome <span style="text-transform: uppercase; font-weight: bold">' . $_SESSION['userUid'] .
        '</span></div>';
      } else {
        // logged out
        echo '<div class="alert alert-warning" role="alert">You are not logged in</div>';
      }
    ?>
    <section class="container p-4 bg-light mt-3">
      Welcome to Rocket<b>Posts</b> home page
    </section>
  </main>
  
  <!-- Hero -->
  <div class="container-fluid hero">

  <div class="col container mt-5 mx-auto text-center mt-5">
    <h1 class="mb-5">Art Supplies for Everyone</h1>
    <h2 class="mb-5">Creative space Artists, hobbyists, students, and anyone who loves to express themselves creatively.</h2>
    <a  class="mt-5  align-items-end" href="/dwd/Assessment2PHP/signup.php"><button type="button" class="btn btn-dark">Get started</button></a>
  </div>

  </div>
  <!-- Hero -->

<!-- FOOTER.PHP -->
<?php 
  require "./templates/footer.php"
?>