<?php 
  session_start();

  // access & remove all values in $_SESSION
  session_unset();

  // end the unique session (reset session id)
  session_destroy();

  header("Location: ../index.php");
?>