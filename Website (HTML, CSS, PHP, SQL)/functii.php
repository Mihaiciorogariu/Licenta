<?php 
include "connect.php";


function user()
{
$user= $_SESSION['user'];	
echo "$user";
}


function initializare()
{
	if( !isset($_SESSION["type"]) )
	 // If the user is not logged in, he will be set as Guest, type -1, id=0
	{
	
	$_SESSION['user']='Guest';
	$_SESSION['type']='-1';
	$_SESSION['id']='0';
	}
}

	
	
	

?>