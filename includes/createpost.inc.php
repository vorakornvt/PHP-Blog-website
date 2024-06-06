<?php
  // 1. Start Session: 
  // NOTE: We only want users to create posts if they're logged in
  session_start();

  // 2. Check if the user clicked the submit button from the createpost form + user is logged in
  if(isset($_POST['post-submit']) && isset($_SESSION['userId'])){
    // 3. Connect to the database
    require './connect.inc.php';

    // 4. Collect & store POST data
    $title = $_POST['title'];
    $imageURL = $_POST['imageurl'];  
    $description = $_POST['description'];
    $artistName = $_POST['artistName'];
    $years = $_POST['years'];
    $userId = $_SESSION['userId']; 

    // 5. VALIDATION: Check if any fields are empty
   
    if (empty($title) || empty($imageURL) || empty($description) || empty($artistName) || empty($years)) {
      // ERROR: Redirect with error message via GET
      header("Location: ../createpost.php?error=emptyfields");
      exit();
    }

    // 6. Save Post to DB using Prepared Statements
   
    $sql = "INSERT INTO artReview (title, imageurl, description, artistName, years, idUsers) VALUES (?, ?, ?, ?, ?, ?)";

    // (ii) Prepare SQL statement
    $statement = $conn->prepare($sql);

    // Check if statement preparation was successful
    if ($statement === false) {
      // ERROR: SQL preparation error
      echo '<div class="alert alert-danger" role="alert">SQL Error: ' . htmlspecialchars($conn->error) . '</div>';
      exit();
    }

    // (iii) Bind parameters and execute the statement
    $statement->bind_param("ssssii", $title, $imageURL, $description, $artistName, $years, $userId);
    $statement->execute();

    // (iv) Check for errors
    if ($statement->error) {
     
      header("Location: ../createpost.php?error=servererror");
      exit();
    }

    // (v) Post is saved to "artReview" table - redirect with success message
    header("Location: ../posts.php?post=success"); 
    exit();


  } else {
    header("Location: ../createpost.php?error=forbidden");
    exit();
  }
?>