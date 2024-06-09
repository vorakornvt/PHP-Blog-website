<?php
require "templates/header.php";


if (isset($_GET['id'])) {
    require 'includes/connect.inc.php';
    $postId = intval($_GET['id']);

    $sql = "SELECT * FROM artReview WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $postId);
    $stmt->execute();
    $result = $stmt->get_result();
    $post = $result->fetch_assoc();

    if (!$post) {
        header("Location: posts.php?error=postnotfound");
        exit();
    }
} else {
    header("Location: posts.php");
    exit();
}
?>
<main class="container shadow p-3 mb-5 bg-body-tertiary rounded p-4 bg-light mt-3">
  <form action="includes/editpost.inc.php?id=<?php echo $postId; ?>" method="POST">
    <h2 class="text-center">Edit Your Inspiration</h2>

    <!-- Title -->
    <div class="mb-3">
      <label for="title" class="form-label">Artwork Name</label>
      <input type="text" class="form-control" name="title" value="<?php echo ($post['title']); ?>" required>
    </div>

    <!-- Image URL -->
    <div class="mb-3">
      <label for="imageurl" class="form-label">Artwork Image URL</label>
      <input type="text" class="form-control" name="imageurl" value="<?php echo ($post['imageurl']); ?>" required>
    </div>

    <!-- Artwork Description -->
    <div class="mb-3">
      <label for="description" class="form-label">Inspiration from Artwork</label>
      <textarea class="form-control" name="description" required><?php echo ($post['description']); ?></textarea>
    </div>

    <!-- Artist Name -->
    <div class="mb-3">
      <label for="artistName" class="form-label">Artist Name</label>
      <input type="text" class="form-control" name="artistName" value="<?php echo ($post['artistName']); ?>" required>
    </div>

    <!-- Years -->
    <div class="mb-3">
      <label for="years" class="form-label">Years</label>
      <input type="number" class="form-control" name="years" value="<?php echo ($post['years']); ?>" required>
    </div>

    <!-- Submit Button -->
    <button type="submit" name="edit-submit" class="btn btn-dark w-100">Update Your Artwork</button>
  </form>
</main>
<?php
require "templates/footer.php";
?>
