<?php
session_start();
$_SESSION['type'] = '0'; // Make the client/admin guest again (type 0)
header('Location: index.php'); // Redirect to the home page (index.php) 
exit;
?>
