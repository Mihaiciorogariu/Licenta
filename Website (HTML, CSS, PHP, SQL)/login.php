<?php 
session_start(); 
include "functii.php";
initializare();
//echo $_SESSION['user'];



if(isset($_POST['submit'])){ //check if form was submitted
  
$USERNAME = $_POST['username'];
$PASSWORD = $_POST['password'];
  
$result = $mysqli->query("SELECT username, roles, id_user from user where username='$USERNAME' and password='$PASSWORD'");
// Verifies if at least one record (inregistrare) exists in the database in order to be able to log in
$rowcount=mysqli_num_rows($result); // Verify if the results match => 1
if ($rowcount==1)
	{
	$row = $result->fetch_array(MYSQLI_ASSOC);
  // Fetch data in an associative manner => Access it using the column names
  // $row = columns from the database. Save the data fom the current session in $_SESSION
	$_SESSION['user']=$row['username']; 
	$_SESSION['type']=$row['roles'];
	$_SESSION['id']=$row['id_user'];
	header('Location: index.php'); // Redirect the user to the home page (index.php) after logging in
  
	} 
	else // If log in fails => Make the user guest
	{
		initializare();
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Log In - Parking Lot</title>
  <link rel="stylesheet" href="styleaccount.css">
</head>
<body>
  <main style="text-align: center;">
    <h1>Log In</h1>
	
    <div class="panel">
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
        
        <li><a href="createaccount.php">Create Account</a></li>
        
      </ul>
    </nav>
  </div>
	
    <form action="#" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <button type="submit" name="submit">Log In</button>
    </form>
  </main>
</body>
</html>
