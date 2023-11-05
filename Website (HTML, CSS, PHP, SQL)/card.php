<?php 
session_start(); 
include "functii.php";
initializare();

$DATE=$_POST['date'];
$HOUR=$_POST['hour'];

$input_date = $DATE.' '.$HOUR ;
$StartDate = DateTime::createFromFormat('Y-m-d H:i', $input_date);
$StartDateFormated = $StartDate->format('Y-m-d H:i:s.u');



try {
    
    $dbhost = 'localhost';
    $dbname = 'bazadedate';
    $dbuser = 'root';
    $dbpass = 'Sibiu2023';

    

    // Establish a new database connection
    // PHP Data Object Class-> To connect to the database
    $pdo = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);

    // Throw exceptions in case of errors
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Fetch from the tickets table the rows where the exitdatetime is > than the exitdatetime provided
    $sql = 'SELECT COUNT(*) FROM tickets WHERE exitdatetime > :exitdatetime';
    $stmt = $pdo->prepare($sql); // Send $sql request to $stmt

    // Bind the 'exitdatetime' parameter to the datetime you want to check
    $stmt->bindParam(':exitdatetime', $StartDateFormated); // Replace :exitdatetime with the chosen value

    // Execute the SQL statement
    $stmt->execute();

    // Fetch the number of rows
    $count = $stmt->fetchColumn();

    // If all parking spots are taken, you can not book anymore
    if ($count >= 4)
    {
      ?>

<!DOCTYPE html>
<html>
<head>

	<title><?php echo $resultpayment; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<h1> Sorry, all parking spots are already occupied! Try a different hour! </h1>
	<p>You will be redirected home soon.</p>
	<p>Redirecting in <span id="countdown">5</span> seconds...</p>

	<script>
		var count = 5;
		var countdown = setInterval(function() {
			count--;
			document.getElementById('countdown').textContent = count;
			if (count == 0) {
				clearInterval(countdown);
				window.location.href = "index.php";
			}
		}, 1000);
	</script>
</body>
</html>

      <?php 
    }
    else{


?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <style>
      body {
        text-align: center;
      }
    </style>
  <title>Credit Card Information</title>
  <link rel="stylesheet" href="styleaccount.css">
</head>
<body>





  <main>
  <h1>Credit Card Information</h1>
  <form action="redirect.php" method="post">
    <label for="card-number">Card Number:</label>
    <input type="text" id="card-number" name="card-number" required>
    
    <label for="card-name">Cardholder Name:</label>
    <input type="text" id="card-name" name="card-name" required>
    
    <label for="card-expiry">Expiry Date:</label>
    <input type="month" id="card-expiry" name="card-expiry" required>
    
    <label for="card-cvv">CVV:</label>
    <input type="password" id="card-cvv" name="card-cvv" minlength="3" maxlength="4" required>
    
  <!-- Remembers data from the previous form, without displaying it -->
  <!-- POST: Stocheaza in pagina curenta informatia -->
	<input type="hidden" name="date" value="<?php echo $_POST['date'] ?>">
	<input type="hidden" name="hour" value="<?php echo $_POST['hour'] ?>">
	<input type="hidden" name="duration" value="<?php echo $_POST['duration'] ?>">
	<input type="hidden" name="car-number" value="<?php echo $_POST['car-number'] ?>">
	
	
    <button type="submit">Pay Now</button>
  </form>
</main>

</body>
</html>


<?php
} 
}
catch(PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
?>