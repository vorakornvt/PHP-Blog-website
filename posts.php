<?php 
require "./templates/header.php";
?>

<main class="container p-4  mt-3">
  <?php
 
  require './includes/connect.inc.php';

 
  $sql = "SELECT id, title, imageurl, description, artistName, idUsers, years  FROM artReview";

 
  $result = $conn->query($sql);

  
  if (!$result) {
    echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
  } else {
    
    if ($result->num_rows > 0) {
      
      while ($row = $result->fetch_assoc()) {
        echo '
        <div class="container text-start w-75 shadow p-3 mb-5 bg-body-tertiary rounded " id="' . $row['id'] . '">
          <div class="row align-items-start g-0">
            <div class="col-auto">
              <img src="' . $row['imageurl'] . '" class="img-fluid rounded-start" style="max-width: 300px;" alt="' . $row['title'] . '">
            </div>
            <div class="col ms-3 ">
              <div class="card-body">
                <h4 class="card-title mb-2">' . $row['title'] . '</h4>
                <p class="card-text mb-2"> Description :  ' . $row['description'] . '</p>
                <p class="card-text mb-2"> Artist :' . $row['artistName'] . '</p>
                <p class="card-text border-bottom mb-5 pb-2"> Year : ' . $row['years'] . '</p>'
                ;

      
        if (isset($_SESSION['userId']) && $_SESSION['userId'] == $row['idUsers']) {
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
      echo "No results found";
    }
  }

 
  $conn->close();
  ?>
</main>

<?php 
require "./templates/footer.php";
?>
