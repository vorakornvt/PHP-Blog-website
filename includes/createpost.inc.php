<?php
  // 1. Start Session: 
  session_start();

  // 2. Check if the user clicked the submit button from the createpost form + user is logged in
  if(isset($_POST['post-submit']) && isset($_SESSION['userId'])){
    // 3. Connect to the database
    require './connect.inc.php';

    // 4. Collect & store POST data
    $title = $_POST['title'];
    $imageURL = $_POST['imageurl'];
    $comment = $_POST['comment'];
    $artistName = $_POST['artistname'];
    $userId = $_SESSION['userId']; 

    // 5. VALIDATION: Check if any fields are empty
    if (empty($title) || empty($imageURL) || empty($comment)) {
      // ERROR: Redirect with error message via GET
      header("Location: ../createpost.php?error=emptyfields");
      exit();
    }

    // 6. Save Post to DB using Prepared Statements
    $sql = "INSERT INTO artReview (title, image_url, description, artist_name, idUsers) VALUES (?, ?, ?, ?, ?)";
    $statement = $conn->prepare($sql);
    $statement->bind_param("ssssi", $title, $imageURL, $comment, $artistName, $userId);
    $statement->execute();

    // 7. Check for errors
    if($statement->error){
      // ERROR: Unknown server error on saving to DB
      header("Location: ../createpost.php?error=servererror");
      exit();
    }

    // 8. Post is saved to "artReview" table - redirect with success message
    header("Location: ../posts.php?post=success"); 
    exit();

  // 9. Restrict Access to Script Page
  } else {
    header("Location: ../createpost.php?error=forbidden");
    exit();
  }
?>
