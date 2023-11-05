<?php
session_start();
include "functii.php";
initializare();

$user_id = $_SESSION['id']; // Fetch the user ID from the current session
// Fetch the username, password and email for that user
$sql = "SELECT Username, Password, Email FROM user WHERE id_user = ?";
$stmt = $mysqli->prepare($sql); // Prepare the query: Copy $sql to $stmt object, but does not execute it
$stmt->bind_param('i', $user_id); // Replaces "?" with the ID of the user
$stmt->execute(); // Executes the query (request)
$result = $stmt->get_result(); // Fetches the data
$row = $result->fetch_assoc(); // Arranges it in an associative manner




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Account - Parking Lot</title>
    <link rel="stylesheet" href="styleaccount.css">
    <style>
        .Tickets {
            border:1px solid #C0C0C0;
            border-collapse:collapse;
            padding:5px;
            margin: auto; 
        }
        .Tickets th {
            border:1px solid #C0C0C0;
            padding:5px;
            background:#0077c2;
            color: #ffffff; 
        }
        .Tickets td {
            border:1px solid #C0C0C0;
            padding:5px;
        }
    </style>
</head>


<body>
    
	
	 <header>
    <div class="logo">
        <h1>My Account</h1>
    </div>
    <div class="panel">
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <?php if ($_SESSION['type'] == '1') { ?>
                    <li><a href="myaccount.php">My Account</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } elseif ($_SESSION['type'] == '2') { ?>
                    <li><a href="myaccount.php">My Account</a></li>
                    <li><a href="users.php">Users</a></li>
                    <li><a href="sensors.php">Sensors</a></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li><a href="createaccount.php">Create Account</a></li>
                    <li><a href="login.php">Log In</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>
	

    <main style="text-align: center;">
	
	
	<div>
        <h1>Account data</h1>
        <p>Username: <?php echo htmlspecialchars($row['Username']); ?></p>
        <p>Password: <?php echo htmlspecialchars($row['Password']); ?></p>
        <p>Email: <?php echo htmlspecialchars($row['Email']); ?></p>
		
		
	</div>	
		
		
	<div>
	
	
		<h1>Parking activity</h1>
	
	<?php 
	
	
  // Only display the reservation form to clients & admins
  if ($_SESSION['type'] == '1' || $_SESSION['type'] == '2')
  {
	  
  include "reservationform.php";
  }
 
  
	
	?>
	</div>
		
		
	<div>

	<br>
	<br>
	<h1>Ticket history</h1>
	


<table class="Tickets">
	
	<thead>
	<tr>
		<th>Nr. crt</th>
		<th>Username</th>
		<th>Ticket ID</th>
		<th>Enter Datetime</th>
		<th>Exit Datetime</th>
		<th>Parkspot</th>
		<th>Bill</th>
		<th>Payment date</th>
		<th>Card number</th>
		<th>Cardholder</th>
		<th>CVV</th>
		<th>Card expiration date</th>
		<th>Success</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	$ID_User=$_SESSION['id'];
	$Nrcrt=0;
	$sql_tickethistory = "SELECT Cardnumber, Cardholder, CVV, ExpirationDate, Success, ID_Ticket, EnterDateTime, ExitDateTime, ParkSpot,  Bill, PaymentDate, Username FROM `payments` p, `tickets` t, `user` u where p.ID_Payment=t.Paid and t.ID_Client=u.ID_User and u.ID_User=$ID_User Order by t.EnterDateTime DESC";

	$result_tickethistory = $mysqli->query($sql_tickethistory);
	
	foreach($result_tickethistory as $row) // Query each row
	{
	$Nrcrt++;	
	
	
	
	?>
	<tr>
		<td><?php echo $Nrcrt; ?></td>
		<td><?php echo $row['Username']; ?></td>
		<td><?php echo $row['ID_Ticket']; ?></td>
		<td><?php echo $row['EnterDateTime']; ?></td>
		<td><?php echo $row['ExitDateTime']; ?></td>
		<td><?php echo $row['ParkSpot']; ?></td>
		<td><?php echo $row['Bill']; ?>$ </td>
		<td><?php echo $row['PaymentDate']; ?></td>
		<td><?php echo str_repeat('*', 12) . substr($row['Cardnumber'], -4); ?></td>
		<td><?php echo $row['Cardholder']; ?></td>
		<td><?php echo $row['CVV']; ?></td>
		<td><?php echo $row['ExpirationDate']; ?></td>
		<td><?php if ($row['Success']==1)
		{
			echo "Payment successful";
		}
		else
		{
			echo "Payment failed";
		}
		?></td>
	</tr>
	<?php } ?>
	</tbody>
</table>
	</div>	
    </main>
</body>

<?php
	if ($rowcount==1) // If a ticket is active
	{
	?>
<?php
	}
	?>
</html>
