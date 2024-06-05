<!-- HEADER.PHP -->
<?php 
  require "templates/header.php"
?>

  <main class="container shadow p-3 mb-5 bg-body-tertiary rounded  p-4 bg-light mt-3">
    <!-- createpost.inc.php - Will process the data from this form-->
    <form action="includes/createpost.inc.php" method="POST">
      <h2 class="text-center">Share Your Inspiration</h2>


<!-- Title -->
<div class="mb-3">
  <label for="title" class="form-label">Title</label>
  <input type="text" class="form-control" name="title" placeholder="Enter review title">
</div>

<!-- Image URL -->
<div class="mb-3">
  <label for="imageurl" class="form-label">Artwork Image URL</label>
  <input type="text" class="form-control" name="imageurl" placeholder="Paste the URL of the artwork image">
</div>

<!-- Artwork Description -->
<div class="mb-3">
  <label for="comment" class="form-label">Inspiration form Artwork</label>
  <textarea class="form-control" name="comment" rows="3" placeholder="Describe what you got form this artworks or your Interpretation"></textarea>
</div>


<!-- Artist Name -->
<div class="mb-3">
  <label for="artistname" class="form-label">Artist Name</label>
  <input type="text" class="form-control" name="artistname" placeholder="Enter artist name">
</div>

<!-- Submit Button -->
<button type="submit" name="post-submit" class="btn btn-dark w-100">Post Your Artwork</button>
  </main>

<!-- FOOTER.PHP -->
<?php 
  require "templates/footer.php"
?>