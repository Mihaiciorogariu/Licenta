<?php 
session_start(); 
include "functii.php";
initializare();


if(isset($_GET['request'])){ //check if form was submitted
  
if($_GET['request'] == "temp") // Check if the parameter from the URL of the GET request is "temp"
{  
$result = $mysqli->query("SELECT `Value` FROM `sensors` WHERE `ID_Sensor` = 1"); // From the "sensors" table, select the temperature
$rowcount=mysqli_num_rows($result); // Counts how many rows were fetched based on the sql from line 11
if ($rowcount==1) // Verifies that there is only one row containing this value
	{
	$row = $result->fetch_array(MYSQLI_ASSOC); // Fetch the data in an associative manner
	echo $row['Value']; // Associative display
	
	} 
	else
	{
		
	}
}
else if($_GET['request'] == "res")
{  
$result = $mysqli->query("SELECT COUNT(*) AS `Value` FROM `tickets` WHERE EnterDateTime<DATE_ADD(NOW(), INTERVAL 2 HOUR) AND ExitDateTime>DATE_ADD(NOW(), INTERVAL 2 HOUR)");
$rowcount=mysqli_num_rows($result); 
if ($rowcount==1)
	{
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo $row['Value'];
	
	} 
	else
	{
		
	}
}
else if($_GET['request'] == "hum")
{  
	$result = $mysqli->query("SELECT `Value` FROM `sensors` WHERE `ID_Sensor` = 3");
$rowcount=mysqli_num_rows($result);
if ($rowcount==1)
	{
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo $row['Value'];
	
	} 
	else
	{
		
	}
}
else if($_GET['request']=='free')
{
	$result = $mysqli->query("SELECT count(*) as Value FROM `parkingspot` WHERE `ParkSpotTaken`=0");
$rowcount=mysqli_num_rows($result); 
if ($rowcount==1)
	{
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo $row['Value'];
	
	} 
	else
	{
		
	}
}

else if($_GET['request']=='distance')
{
	$result = $mysqli->query("SELECT `Value` FROM `sensors` WHERE `ID_Sensor` in(4,5,6,7,8,9,12,13,14,15)");
	$rowcount=mysqli_num_rows($result); // Verifies if at least one record (inregistrare) exists in the database
	if($rowcount > 0) {
		$output = '';
		while($row = $result->fetch_assoc()) // ROW["VALUE"], FARA ASSOC: ROW[0]
		{
			$output .= $row["Value"] . '; ';
		}
		echo rtrim($output, '; ');
	} else {
		echo "No records found.";
	}
}


else if($_GET['request']=='busy')
{
	$result = $mysqli->query("SELECT count(*) as Value FROM `parkingspot` WHERE `ParkSpotTaken`!=0");
$rowcount=mysqli_num_rows($result); // Verifies if at least one record (inregistrare) exists in the database
if ($rowcount==1)
	{
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo $row['Value'];
	
	} 
	else
	{
		
	}
}
else if($_GET['request']=='pragTemp')
{
	$result = $mysqli->query("SELECT `Value` FROM `sensors` WHERE `ID_Sensor` = 10");
$rowcount=mysqli_num_rows($result); // Verifies if at least one record (inregistrare) exists in the database
if ($rowcount==1)
	{
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo $row['Value'];
	
	} 
	else
	{
		
	}
}

else if($_GET['request']=='parkingSpot')
{
	$result = $mysqli->query("SELECT ParkSpotTaken as Value FROM `parkingspot`");
$rowcount=mysqli_num_rows($result); // Verifies if at least one record (inregistrare) exists in the database
if($rowcount > 0) {
	$output = '';
	while($row = $result->fetch_assoc()) {
		$output .= $row["Value"] . '; ';
	}
	echo rtrim($output, '; ');
} else {
	echo "No records found.";
}
}





}

?>

