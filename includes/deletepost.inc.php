<?php
// 1. Start Session and Check User is Logged In + Id passed in via GET
session_start();
if (isset($_SESSION['userId']) && isset($_GET['id'])) {
    // 2. Connect to DB
    require './connect.inc.php';

    // 3. Collect, escape string & store POST data
    $postId = $conn->real_escape_string($_GET['id']);
    $postId = intval($postId);
    $userId = $_SESSION['userId'];

    // 4. Check if the user is authorized to delete the post
    $sqlCheck = "SELECT idUsers FROM artReview WHERE id = ?";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bind_param("i", $postId);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();
    $post = $resultCheck->fetch_assoc();

    if (!$post || $post['idUsers'] != $userId) {
        header("Location: ../posts.php?error=notauthorized");
        exit();
    }

    // 5. Delete Post from DB (Prepared Statements)
    $sql = "DELETE FROM artReview WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        // ERROR: Something wrong when preparing the SQL
        header("Location: ../posts.php?id=$postId&error=sqlerror");
        exit();
    }

    // 6. Bind parameters and execute the statement
    $stmt->bind_param("i", $postId);
    $stmt->execute();

    if ($stmt->error) {
        // ERROR: Unknown server error on saving to DB
        header("Location: ../posts.php?error=servererror");
        exit();
    }

    // 7. SUCCESS: Post is deleted from "artReview" table - redirect with success message
    header("Location: ../posts.php?delete=success");
    exit();

// 2. Restrict Access to Script Page
} else {
    header("Location: ../signup.php");
    exit();
}
?>