<?php 
session_start(); 
include "functii.php";
initializare();

//Update the values read by the ultrasonic sensors in the database
if(isset($_GET['id_sensor1']))
{ //check if form was submitted
$id = $_GET['id_sensor1'];
$valoare=$_GET['value1'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor2']))
{ //check if form was submitted
$id = $_GET['id_sensor2'];
$valoare=$_GET['value2'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor3']))
{ //check if form was submitted
$id = $_GET['id_sensor3'];
$valoare=$_GET['value3'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor4']))
{ //check if form was submitted
$id = $_GET['id_sensor4'];
$valoare=$_GET['value4'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor5']))
{ //check if form was submitted
$id = $_GET['id_sensor5'];
$valoare=$_GET['value5'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor6']))
{ //check if form was submitted
$id = $_GET['id_sensor6'];
$valoare=$_GET['value6'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor7']))
{ //check if form was submitted
$id = $_GET['id_sensor7'];
$valoare=$_GET['value7'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor8']))
{ //check if form was submitted
$id = $_GET['id_sensor8'];
$valoare=$_GET['value8'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor9']))
{ //check if form was submitted
$id = $_GET['id_sensor9'];
$valoare=$_GET['value9'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}


if(isset($_GET['id_sensor10']))
{ //check if form was submitted
$id = $_GET['id_sensor10'];
$valoare=$_GET['value10'];
 
$result = $mysqli->query("UPDATE `sensors` SET `Value`='$valoare',`LastUpdate`=NOW() WHERE ID_Sensor=$id");
}









?>

