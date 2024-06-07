<?php 
require "./templates/header.php";
?>

<main class="container p-4 mt-3">
  <?php
  // Include the database connection
  require './includes/connect.inc.php';

  // Query to fetch data from the artReview table
  $sql = "SELECT id, title, imageurl, description, artistName, idUsers, years FROM artReview";
  $result = $conn->query($sql);

  // Check for errors or success messages in the URL
  if (isset($_GET['error'])) {
      $errorMsg = "";

      // Internal server error
      if ($_GET['error'] == "sqlerror" || $_GET['error'] == "servererror") {
          $errorMsg = "An internal server error has occurred - please try again later";
      }

      // Display error message
      if (!empty($errorMsg)) {
          echo '<div class="alert alert-danger" role="alert">' . $errorMsg . '</div>';
      }

  } else if (isset($_GET['post']) && $_GET['post'] == "success") {
      // Success: Post created
      echo '<div class="alert text-center alert-secondary" role="alert">Post created!</div>';

  } else if (isset($_GET['edit']) && $_GET['edit'] == "success") {
      // Success: Post edited
      echo '<div class="alert text-center alert-secondary" role="alert">Post edited!</div>';

  } else if (isset($_GET['delete']) && $_GET['delete'] == "success") {
      // Success: Post deleted
      echo '<div class="alert text-center alert-secondary text-center" role="alert">Post successfully deleted!</div>';
  }

  // Check if the query was successful
  if (!$result) {
      echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
  } else {
      // Check if there are any results
      if ($result->num_rows > 0) {
          // Check if the user is logged in
          if (isset($_SESSION['userId'])) {
              // Loop through and display each result with full details for logged-in users
              while ($row = $result->fetch_assoc()) {
                  echo '
                  <div class="container text-start w-75 shadow p-3 mb-5 bg-body-tertiary rounded" id="' . $row['id'] . '">
                    <div class="row align-items-start g-0">
                      <div class="col-auto">
                        <img src="' . $row['imageurl'] . '" class="img-fluid rounded-start" style="max-width: 300px;" alt="' . $row['title'] . '">
                      </div>
                      <div class="col ms-3">
                        <div class="card-body">
                          <h4 class="card-title mb-2">' . $row['title'] . '</h4>
                          <p class="card-text mb-2">Description: ' . $row['description'] . '</p>
                          <p class="card-text mb-2">Artist: ' . $row['artistName'] . '</p>
                          <p class="card-text border-bottom mb-5 pb-2">Year: ' . $row['years'] . '</p>';

                  // Check if the logged-in user is the owner of the post
                  if ($_SESSION['userId'] == $row['idUsers']) {
                      echo '
                      <div class="admin-btn text-center">
                        <a href="editpost.php?id=' . $row['id'] . '" class="btn btn-outline-dark mt-2">Edit</a>
                        <a href="includes/deletepost.inc.php?id=' . $row['id'] . '" class="btn btn-outline-dark mt-2">Delete</a>
                      </div>';
                  }

                  echo '
                        </div>
                      </div>
                    </div>
                  </div>';
              }
            } else {
              // Display alert and image gallery for not logged-in users
              echo '
              <div class="shadow p-3 mb-5 bg-body-tertiary rounded text-center" role="alert">Please login for more fully access creative space!</div>
              <div class="container">
                <div class="d-flex flex-row flex-wrap justify-content-center">';
              
              // Loop through and display each image
              while ($row = $result->fetch_assoc()) {
                  echo '
                  <div class="d-flex flex-column" style="max-width: 260px;">
                    <img src="' . $row['imageurl'] . '" class="img-fluid rounded" style="margin: 5px; opacity: 0.6; max-width: 100%;" alt="' . $row['title'] . '">
                  </div>';
              }
              echo '</div></div>';
          }
      } else {
          echo "No results found";
      }
  }

  // Close the database connection
  $conn->close();
  ?>
</main>

<?php 
require "./templates/footer.php";
?>
