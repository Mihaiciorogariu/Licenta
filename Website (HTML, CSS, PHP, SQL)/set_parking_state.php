<?php 
session_start(); 
include "functii.php";
initializare();

// Update in the database the state of each parking spot
if(isset($_GET['id1']))
{ //check if form was submitted
$id = $_GET['id1'];
$valoare=$_GET['value1'];
 
$result = $mysqli->query("UPDATE `parkingspot` SET `ParkSpotTaken`='$valoare',`LastUpdate`=NOW() WHERE ParkSpotNumber=$id");
}

if(isset($_GET['id2']))
{ //check if form was submitted
$id = $_GET['id2'];
$valoare=$_GET['value2'];
 
$result = $mysqli->query("UPDATE `parkingspot` SET `ParkSpotTaken`='$valoare',`LastUpdate`=NOW() WHERE ParkSpotNumber=$id");
}

if(isset($_GET['id3']))
{ //check if form was submitted
$id = $_GET['id3'];
$valoare=$_GET['value3'];
 
$result = $mysqli->query("UPDATE `parkingspot` SET `ParkSpotTaken`='$valoare',`LastUpdate`=NOW() WHERE ParkSpotNumber=$id");
}

if(isset($_GET['id4']))
{ //check if form was submitted
$id = $_GET['id4'];
$valoare=$_GET['value4'];
 
$result = $mysqli->query("UPDATE `parkingspot` SET `ParkSpotTaken`='$valoare',`LastUpdate`=NOW() WHERE ParkSpotNumber=$id");
}

?>

