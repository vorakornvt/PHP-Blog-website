<!-- HEADER.PHP -->
<?php 
  require "./templates/header.php"
?>

 <!-- Hero -->
 <main class="container-fluid mb-3" style="height: 700px; background: url('./img/Untitled-1.jpg') no-repeat center center/ cover;" >


<main class="container custom-container mt-3">
  <?php
  if(isset($_SESSION['userId'])){
    // logged in
    echo '<div class="shadow p-3 mb-5 bg-body-tertiary rounded text-center" role="alert"> Welcome to your creative space, ' . $_SESSION['userUid'] . '</div>';
  }else {
    // logged out
    echo '<div class="shadow p-3 mb-5 bg-body-tertiary rounded text-center" role="alert">Please Login to see our creative space</div>';
  }
  ?>
</main>

  <div class="w-75  container mt-5 mx-auto text-center mt-5">
  <img src="./img/Asset5.png" alt="ArtifyLOGO" width="90">
    <h1 class="mb-5">Art Supplies for Everyone</h1>
    <h2 class="mb-5">Creative space Artists, hobbyists, students, and anyone who loves to express themselves creatively.</h2>
    <div style="height: 120px;"></div>
    <?php
    if(isset($_SESSION['userId'])){
      // User is logged in
      echo '<a class="mt-5 align-items-end" href="/dwd/Assessment2PHP/createpost.php"><button type="button" class="btn btn-dark">Create Post</button></a>';
    } else {
      // User is not logged in
      echo '<a class="mt-5 align-items-end" href="/dwd/Assessment2PHP/signup.php"><button type="button" class="btn btn-dark">Get started</button></a>';
    }
    ?>
     <div style="height: 10px;"></div>
  </div>
</div>
<!-- Hero -->

<!-- FOOTER.PHP -->
<?php 
  require "./templates/footer.php"
?>