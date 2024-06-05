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
    $comment = $_POST['comment'];
    $artistName = $_POST['artistname'];
    $userId = $_SESSION['userId']; // Fetching the user ID from the session

    // 5. VALIDATION: Check if any fields are empty
    // NOTE: We could add more validation, but keeping it simple for now
    if (empty($title) || empty($imageURL) || empty($comment)) {
      // ERROR: Redirect with error message via GET
      header("Location: ../createpost.php?error=emptyfields");
      exit();
    }

    // 6. Save Post to DB using Prepared Statements
    // (i) Declare SQL statement with placeholders for values
    $sql = "INSERT INTO artwork_reviews (title, image_url, description, artist_name, idUsers) VALUES (?, ?, ?, ?, ?)";

    // (ii) Prepare SQL statement
    $statement = $conn->prepare($sql);

    // (iii) Bind parameters and execute the statement
    $statement->bind_param("ssssi", $title, $imageURL, $comment, $artistName, $userId);
    $statement->execute();

    // (iv) Check for errors
    if($statement->error){
      // ERROR: Unknown server error on saving to DB
      header("Location: ../createpost.php?error=servererror");
      exit();
    }

    // (v) Post is saved to "artwork_reviews" table - redirect with success message
    header("Location: ../posts.php?post=success"); 
    exit();

  // 7. Restrict Access to Script Page
  // NOTE: For example, to access this script, the user MUST be LOGGED IN & MUST CLICK SUBMIT 
  } else {
    header("Location: ../createpost.php?error=forbidden");
    exit();
  }
?>

