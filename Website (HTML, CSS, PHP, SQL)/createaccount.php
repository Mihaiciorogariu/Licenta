<?php 
session_start(); 
include "functii.php";
initializare();

//check if the form was submitted
if(isset($_POST['submit'])) //same as the button name
{ 
  
$USERNAME = $_POST['username'];
$PASSWORD = $_POST['password'];
$CONFIRMPASSWORD = $_POST['confirm-password'];
$resultusername = $mysqli->query("SELECT `Username` FROM `user` WHERE `Username` = '$USERNAME'"); //Verify if username already exists
//echo "SELECT `Username` FROM `user` WHERE `Username` = '$USERNAME'";
$rowcountusername=mysqli_num_rows($resultusername); // Verifies if at least one record (inregistrare) exists in the database

if ($rowcountusername>=1)
	{
	
	//echo "Username already exists!";
	echo '<p style="font-size: 24px; color: red;">Username already exists!</p>';
	} 
	else
	{
		
	
$EMAIL=$_POST['email'];  
if ($PASSWORD==$CONFIRMPASSWORD)
{
  //Store the data in the "user table", 1=Client
	$sql = "INSERT INTO `user` (`ID_User`, `Username`, `Password`, `Roles`, `Email`) VALUES (NULL, '$USERNAME', '$PASSWORD', 1, '$EMAIL');";
  //echo "Account created successfully!";
  echo '<p style="font-size: 24px; color: green;">Account created successfully!</p>';
	$result = $mysqli->query($sql);
	echo $mysqli->error;
}
else
{
	//echo "Passwords are not identical!";
  echo '<p style="font-size: 24px; color: red;">Passwords are not identical!</p>';
}
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Create Account - Parking Lot</title>
  <link rel="stylesheet" href="styleaccount.css">
</head>
<body>

  
  <h1>Create Account</h1>
  <div class="panel">
    <nav>
      <ul>
        <li><a href="index.php">Home</a></li>
     
        <li><a href="login.php">Log In</a></li>
      </ul>
    </nav>
  </div>

  <main>
    <!-- Stay on the same page after submitting -->
    <form action="#" method="post">
      <label for="username">Username:</label>
      <input type="text" id="username" name="username" required>

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>

      <label for="confirm-password">Confirm Password:</label>
      <input type="password" id="confirm-password" name="confirm-password" required>

      <button type="submit" name="submit">Create Account</button>
    </form>
  </main>

</body>
</html>

<style>
  body {
    text-align: center;
  }

  header {
    margin-top: 50px;
  }

  .panel {
    margin-top: 50px;
  }
</style>
