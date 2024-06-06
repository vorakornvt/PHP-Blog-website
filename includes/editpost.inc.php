<?php
  session_start();
  if(isset($_POST['edit-submit']) && isset($_SESSION['userId'])){
    require './connect.inc.php';

    $id = intval($_GET['id']);
    $title = $_POST['title'];
    $imageURL = $_POST['imageurl'];
    $description = $_POST['description'];
    $artistName = $_POST['artistName'];
    $years = $_POST['years'];
    $userId = $_SESSION['userId'];

    if (empty($id) || empty($title) || empty($imageURL) || empty($description) || empty($artistName) || empty($years)) {
      header("Location: ../editpost.php?id=$id&error=emptyfields");
      exit();
    }

    // Check if the logged in user is the owner of the post
    $checkSql = "SELECT idUsers FROM artReview WHERE id = ?";
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->bind_param("i", $id);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();
    $checkRow = $checkResult->fetch_assoc();

    if ($checkRow['idUsers'] !== $userId) {
      header("Location: ../editpost.php?id=$id&error=notauthorized");
      exit();
    }

    $sql = "UPDATE artReview SET title=?, imageurl=?, description=?, artistName=?, years=? WHERE id=?";
    $statement = $conn->prepare($sql);
    
    if ($statement === false) {
      header("Location: ../editpost.php?id=$id&error=sqlerror");
      exit();
    }

    $statement->bind_param("ssssii", $title, $imageURL, $description, $artistName, $years, $id);
    $statement->execute();

    if ($statement->error) {
      header("Location: ../editpost.php?id=$id&error=servererror");
      exit();
    }

    header("Location: ../posts.php?id=$id&edit=success");
    exit();
  } else {
    header("Location: ../signup.php");
    exit();
  }
?>
