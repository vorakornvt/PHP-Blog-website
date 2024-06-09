<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>

  <main class="container shadow p-3 mb-5 bg-body-tertiary rounded  p-4  mt-3">
  

    <form action="includes/createpost.inc.php" method="POST">
      <h2 class="text-center">Share Your Inspiration</h2>


<!-- Title -->
<div class="mb-3">
      <label for="title" class="form-label">Artwork Name</label>
      <input type="text" class="form-control" name="title" placeholder="Enter artwork name" required>
    </div>

    <!-- Image URL -->
    <div class="mb-3">
      <label for="imageurl" class="form-label">Artwork Image URL</label>
      <input type="text" class="form-control" name="imageurl" placeholder="Paste the URL of the artwork image" required>
    </div>

    <!-- Artwork Description -->
    <div class="mb-3">
      <label for="description" class="form-label">Inspiration from Artwork</label>
      <textarea class="form-control" name="description" placeholder="Describe what you got from this artwork or your interpretation" required></textarea>
    </div>

    <!-- Artist Name -->
    <div class="mb-3">
      <label for="artistName" class="form-label">Artist Name</label>
      <input type="text" class="form-control" name="artistName" placeholder="Enter artist name" required>
    </div>

    <!-- Years -->
    <div class="mb-3">
      <label for="years" class="form-label">Years</label>
      <input type="number" class="form-control" name="years" placeholder="Enter the years" required>
    </div>


<button type="submit" name="post-submit" class="btn btn-dark w-100">Post Your Artwork</button>
  </main>

<!-- FOOTER.PHP -->
<?php 
  require "templates/footer.php"
?>