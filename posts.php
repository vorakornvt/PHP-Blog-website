<?php 
require "./templates/header.php";
?>

<main class="container p-4 bg-light mt-3">
  <?php
  // 1. QUERY DATABASE for ALL POSTS
  require './includes/connect.inc.php';

  // 2. Declare SQL command to retrieve all rows from the artReview table
  $sql = "SELECT id, title, imageurl, comment, websiteurl, websitetitle FROM artReview";

  // 3. Execute the query and store the result in a variable
  $result = $conn->query($sql);

  // 4. Error handling
  if (!$result) {
    echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
  } else {
    // Display posts if query is successful
    if ($result->num_rows > 0) {
      // Loop through each row and display the data
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="card border-0 mt-3" id="' . $row['id'] . '">
          <img src="' . $row['imageurl'] . '" class="card-img-top post-image" alt="' . $row['title'] . '">
          <div class="card-body">
            <h5 class="card-title">' . $row['title'] . '</h5>
            <p class="card-text">' . $row['comment'] . '</p>
            <a href="' . $row['websiteurl'] . '" class="btn btn-primary w-100" target="_blank">' . $row['websitetitle'] . '</a>';

        // Check if user is logged in and display edit/delete buttons
        if (isset($_SESSION['userId'])) {
          echo '
          <div class="admin-btn">
            <a href="editpost.php?id=' . $row['id'] . '" class="btn btn-secondary mt-2">Edit</a>
            <a href="includes/deletepost.inc.php?id=' . $row['id'] . '" class="btn btn-danger mt-2">Delete</a>
          </div>';
        }

        echo '
          </div>
        </div>';
      }
    } else {
      // No results found
      echo "0 results";
    }
  }

  // Close database connection
  $conn->close();
  ?>
</main>

<?php 
require "./templates/footer.php";
?>
