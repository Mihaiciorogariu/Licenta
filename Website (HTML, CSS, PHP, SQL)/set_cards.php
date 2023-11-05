<?php 
session_start(); 
include "functii.php";
initializare();


if(isset($_GET['value']))
{ //check if form was submitted

$valoare=$_GET['value'];
$sql = "INSERT INTO `CardLogs` (`IDCardLog`, `IDUser`, `DateTime`, `Executed`) VALUES (NULL, $valoare, CURRENT_TIMESTAMP, 0)";
$result = $mysqli->query($sql);
echo("Error description: " . $mysqli -> error);
}

?>

