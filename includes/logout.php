<?php
  // check whether csrf token in _SESSION is valid, if not, die and stop script
if($_POST['csrf'] !== $_SESSION['csrf_token']) {
  die("invalid Token");
}

include_once 'functions.php';
sec_session_start();

// Unset all session values 
$_SESSION = array();

// get session parameters 
$params = session_get_cookie_params();

// Delete the actual cookie. 
setcookie(session_name(),'', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);

// Destroy session 
session_destroy();
header("Location: ../index.php");
exit();
