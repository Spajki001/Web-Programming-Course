<?php
include 'connection.php';

// Log out the user
session_destroy();

// Redirect to index.php
header("Location: index.php");
exit;
?>