<?php 
session_start(); 
include "functii.php";
initializare();


$CARDNUMBER = $_POST['card-number'];
$CARDNAME = $_POST['card-name'];
$EXPIRATIONDATE = $_POST['card-expiry'];
$CVV=$_POST['card-cvv'];  
$DATE=$_POST['date'];
$HOUR=$_POST['hour'];
$DURATION=$_POST['duration'];
$CARNUMBER=$_POST['car-number'];


$input_date = $DATE.' '.$HOUR ;
$StartDate = DateTime::createFromFormat('Y-m-d H:i', $input_date);
$StartDateFormated = $StartDate->format('Y-m-d H:i:s.u');
$FinishDate = DateTime::createFromFormat('Y-m-d H:i', $input_date);
$FinishDate->add(new DateInterval($DURATION));
$FinishDateFormated = $FinishDate->format('Y-m-d H:i:s.u');
$StartExpirationCardDate = DateTime::createFromFormat('Y-m', $EXPIRATIONDATE);
$FormatedExpirationCardDate = $StartExpirationCardDate->format('Ym');
$Datenow = date('Y-m-d H:i:s.u');




$BILL=0;
if ($DURATION=='PT1H')
{
	$BILL=1;
}
else if ($DURATION=='PT3H')
{
	$BILL=2;
}

else if ($DURATION=='PT24H')
{
	$BILL=10;
}

// If the expiration data is < than the current data
$Datenowcard = date('Ym');
if (intval($FormatedExpirationCardDate)<intval($Datenowcard))
{
	$resultpayment = "Payment could not be done. Your card is expired!";
}


else if (is_numeric($CARDNUMBER) && is_numeric($CVV) && strlen($CARDNUMBER)==16)
{
	// Update the DB
	$sqlcard = "INSERT INTO `payments` (`ID_Payment`, `Cardnumber`, `Cardholder`, `CVV`, `ExpirationDate`, `Success`) VALUES (NULL, '$CARDNUMBER', '$CARDNAME', '$CVV', '$EXPIRATIONDATE', '1');";
	$resultcard = $mysqli->query($sqlcard);
	
	
	echo $mysqli->error;
	
	// MAX ID = THE LAST ONE
	// READ FROM THE DB THE LAST INSERTED PAYMENT ID
	$sqlidpayment = "SELECT MAX(ID_Payment) as PaymentID FROM `payments`";
	$resultidpayment = $mysqli->query($sqlidpayment);
	
	$row = $resultidpayment->fetch_array(MYSQLI_ASSOC);
	$IDPAYMENT=$row['PaymentID'];
	
	$IDUSER=$_SESSION['id']; // User ID from 'user' database
	$sql = "INSERT INTO `tickets` (`ID_Ticket`, `ID_Client`, `EnterDateTime`, `ExitDateTime`, `ParkSpot`, `Bill`, `Paid`, `PaymentDate`) VALUES (NULL, '$IDUSER', '$StartDateFormated', '$FinishDateFormated', '0', '$BILL', '$IDPAYMENT', '$Datenow');";
	
	
	$Resultticket = $mysqli->query($sql);
	echo $mysqli->error;
	$resultpayment = "Payment successful!";
}

else
{
	$resultpayment = "Payment could not be done. Please check your input!";
	
}


?>

<!DOCTYPE html>
<html>
<head>

	<title><?php echo $resultpayment; ?></title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<h1><?php echo $resultpayment; ?></h1>
	<p>You will be redirected home soon.</p>
	<p>Redirecting in <span id="countdown">3</span> seconds...</p>

	<script>
		var count = 3;
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
