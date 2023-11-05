<?php
session_start();
include "functii.php";
initializare();


$sql = "SELECT Username, Password, Email, Rolename, id_user FROM `user`, `role` WHERE user.roles=role.ID_Role;";
$result = $mysqli->query($sql);
$users = $result->fetch_all(MYSQLI_ASSOC);


// Changing the role of the clients from the Admin - Users page
if (isset($_POST['submit'])) {
    $user_id = $_POST['user_id'];
    $new_role = $_POST['role'];

    // Update the database with the new value for the role
    $update_sql = "UPDATE user SET Roles = ? WHERE id_user = ?";
    $stmt = $mysqli->prepare($update_sql);
    $stmt->bind_param('ii', $new_role, $user_id); // Replace ?? with the roles and user ID
    $stmt->execute();

    header("Location: users.php"); //Stay on the same page
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Clients</title>
    <link rel="stylesheet" href="users1.css">
    
</head>
<body>
    <header>
    <div class="logo">
        <h1>Manage users</h1>
    </div>
    <div class="panel">
        <nav>
            <ul>

                <!-- Menu depending on the user type -->
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
        <h1>Clients</h1>
        <table style="margin-left: auto; margin-right: auto;">
            <tr>
                <th>Username</th>
                <th>Password</th>
                <th>Email</th>
                <th>Role</th>
                <th>Change Role</th>
            </tr>
            <?php foreach ($users as $row) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['Username']); ?></td>
                    <td><?php echo htmlspecialchars($row['Password']); ?></td>
                    <td><?php echo htmlspecialchars($row['Email']); ?></td>
                    <td><?php echo htmlspecialchars($row['Rolename']); ?></td>
                    <td>
                    <form action="users.php" method="post" >
                        <input type="hidden" name="user_id" value="<?php echo $row['id_user']; ?>">
                        <select name="role" >
                            <option value="3">Guest</option>
                            <option value="1" selected>Client</option>
                            <option value="2">Admin</option>
                        </select>
                        <button type="submit" name="submit" >Change Role</button>
                    </form>
 
                    </td>
                </tr>
            <?php } ?>
        </table>
		
		
			
	<div>


    <!-- Showing the tickets of all users -->
	<h1>Ticket history</h1>
	
	
<table>
	<caption><h3>User data</h3></caption>
	<thead>
	<tr>
		<th>Nr. crt</th>
		<th>Username</th>
		<th>Ticket ID</th>
		<th>Enter Datetime</th>
		<th>Exit Datetime</th>
		
		<th>Bill</th>
		<th>Payment date</th>
		<th>Card number</th>
		<th>Cardholder</th>
		
		<th>Card expiration date</th>
		<th>Success</th>
	</tr>
	</thead>
	<tbody>
	<?php 
	
	$Nrcrt=0;
	$sql_tickethistory = "SELECT Cardnumber, Cardholder, ExpirationDate, Success, ID_Ticket, EnterDateTime, ExitDateTime, ParkSpot,  Bill, PaymentDate, Username FROM `payments` p, `tickets` t, `user` u where p.ID_Payment=t.Paid and t.ID_Client=u.ID_User  Order by t.EnterDateTime DESC";

	$result_tickethistory = $mysqli->query($sql_tickethistory);
	
	foreach($result_tickethistory as $row) // interogheaza baza de date rand pe rand
	{
	$Nrcrt++;	
	
	
	
	?>
	<tr>
		<td><?php echo $Nrcrt; ?></td>
		<td><?php echo $row['Username']; ?></td>
		<td><?php echo $row['ID_Ticket']; ?></td>
		<td><?php echo $row['EnterDateTime']; ?></td>
		<td><?php echo $row['ExitDateTime']; ?></td>
		
		<td><?php echo $row['Bill']; ?>$ </td>
		<td><?php echo $row['PaymentDate']; ?></td>
		<td><?php echo str_repeat('*', 12) . substr($row['Cardnumber'], -4); ?></td>
		<td><?php echo $row['Cardholder']; ?></td>
		
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
</html>