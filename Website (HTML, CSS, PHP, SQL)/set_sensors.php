<?php 
session_start(); 
include "functii.php";
initializare();


if(isset($_GET['id_sensor']))
{ //check if form was submitted
$id = $_GET['id_sensor'];
$valoare=$_GET['value'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}

?>

