<?php 
session_start(); 
include "functii.php";
initializare();
//echo $_SESSION['user'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Parking Lot</title>
    <link rel="stylesheet" href="style2.css">
  </head>
  <body>
  
    <header>
      <div class="logo">
        <h1>Parking Lot</h1>
      </div>
	  
	    <div class="panel">
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      
      <?php if ($_SESSION['type'] == '1') // Client
      { ?>
        <li><a href="myaccount.php">My Account</a></li>
        <li><a href="logout.php">Log Out</a></li>
      <?php 
      } 
      elseif ($_SESSION['type'] == '2')  // Admin

      { ?>
        <li><a href="myaccount.php">My Account</a></li>
        <li><a href="users.php">Users</a></li>
        <li><a href="sensors.php">Sensors</a></li>
        <li><a href="logout.php">Log Out</a></li>
        
      <?php
       } 
      
      else // Guest
      { ?>
        <li><a href="createaccount.php">Create Account</a></li>
        <li><a href="login.php">Log In</a></li>
      <?php 
    } ?>
    </ul>
  </nav>
</div>





    </header>
	

	
<main style="text-align: center;">
	
<section class="availability">
  <h2>Parking Availability</h2>
  <div class="availability-panel">
    <div class="availability-option">
      <h3>Total number of parking spots:</h3>
      <p>
	  <?php $sql = "SELECT count(*) as number FROM `parkingspot`";
		$result = $mysqli->query($sql);	
		$row = $result->fetch_array(MYSQLI_ASSOC);
		echo $row['number'];
		
		?></p>
    </div>
    <div class="availability-option">
      <h3>Currently available parking spots:</h3>
	  <p>
      <?php $sql = "SELECT count(*) as number FROM `parkingspot` WHERE `ParkSpotTaken`=0;";
		$result = $mysqli->query($sql);	
		$row = $result->fetch_array(MYSQLI_ASSOC);
		echo $row['number'];
		
		?>
	  <p>
    </div>
  </div>
</section>

<br>
	
	
<section class="pricing">
  <h2>Pricing Options</h2>
  <ul>
    <li>
      <h3>Price per 1 hour:</h3>
      <p>$1</p>
    </li>
    <li>
      <h3>Price per 3 hours:</h3>
      <p>$2</p>
    </li>
    <li>
      <h3>Price per day:</h3>
      <p>$10</p>
    </li>
  </ul>
</section>


 <br>

  <?php
  // Only display the reservation form to clients & admins
  if ($_SESSION['type'] == '1' || $_SESSION['type'] == '2')
  {
	  
  include "reservationform.php";
  }
 
  ?>
 
</section>


<br>
<br>
<!-- Camera -->
<section>
  <h2>Live Webcam Feed</h2>
  <div class="webcam" style="text-align: center;">
    <iframe src="http://192.168.1.192:8080/?action=stream" width="325" height="245"></iframe>
  </div>
</section>

<br>
<!-- Map -->
<section>
  <div class="map-container">
    <h3 style="text-align: center;">Location</h3>
    <div class="map">
    <a href="https://www.google.com/maps/place/Laboratoarele+UTC-N,+Cluj-Napoca/@46.7567726,23.5955705,18.12z/data=!4m6!3m5!1s0x47490c32b215f629:0x6b572fa2b00ef939!8m2!3d46.7568376!4d23.5964848!16s%2Fg%2F11b8tfdds_?entry=ttu" target="_blank">
    <img src="location.JPG" width="300" alt="Location Image"/>
</a>

    </div>
  </div>
</section>
<br>

</body>

<script>
setTimeout(function() {
    location.reload();
}, 10000);
</script>

</html>