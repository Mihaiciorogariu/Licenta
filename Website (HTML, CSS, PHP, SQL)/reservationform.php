 <?php
	$IDUSER=$_SESSION['id'];
	$sql = "SELECT ExitDateTime, EnterDateTime FROM `tickets` WHERE `ID_Client` = $IDUSER AND `ExitDateTime` > CURRENT_TIMESTAMP";

$result = $mysqli->query($sql);
$message="";
echo $mysqli->error;
$rowcount=mysqli_num_rows($result); // Verifies if at least one record (inregistrare) exists in the database
if ($rowcount==1)
{
    
    $row = $result->fetch_array(MYSQLI_ASSOC);

    $exitDateTime = new DateTime($row['ExitDateTime']);
    $enterDateTime = new DateTime($row['EnterDateTime']);
    $currentDateTime = new DateTime();
    //$currentDateTime = new DateTime(null, new DateTimeZone('Europe/Athens'));
    //echo $currentDateTime;
    //$message=$currentDateTime;

    if ($currentDateTime < $enterDateTime) {
        $EXITDATETIME = $row['EnterDateTime'];
        $message="Time until the reservation starts: ";
    } 
    else {
        $EXITDATETIME = $row['ExitDateTime'];
        
        $message="Time left until the reservation expires: ";
    }
}
	if ($rowcount==0)
	{
		?>
 <h2 style="text-align: center;">Reservation Form</h2>
    
	<form action="card.php" method="post">
      <label for="date">Date:</label>
      <input type="date" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
      
      <label for="hour">Hour:</label>
      <input type="time" id="hour" name="hour" value="<?php echo date('H:i', strtotime('+2 hours')); ?>" required>
      

      <label for="duration">Duration:</label>
      <select id="duration" name="duration" required>
        <option value="PT1H">1 hour - $1</option>
        <option value="PT3H">3 hours - $2</option>
        <option value="PT24H">1 day - $10</option>
      </select>
      
      <label for="car-number">Car Number Plate:</label>
      <input type="text" id="car-number" name="car-number" required>
      
      <button type="submit">Submit Reservation</button>
    </form>
	<?php }
	else
	{
		?>
		<h2 style="text-align: center;"> <p id="demo2"></p> </h2>
		<p id="demo"></p>
        


		
		<script>
    // Set the date we're counting down to
    var enterDateTime = new Date("<?php echo $row['EnterDateTime']; ?>").getTime(); //miliseconds
    var exitDateTime = new Date("<?php echo $row['ExitDateTime']; ?>").getTime();

    // Update the count down every 1 second
    var x = setInterval(function() {
        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance;
        var message;
        if (now < enterDateTime) {
            distance = enterDateTime - now; // count down to the start of the reservation
            message= "Time remaining until the reservation starts: "
        } else {
            distance = exitDateTime - now; // count down to the end of the reservation
            message= "Time remaining until the reservation expires: "
        }

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + "d " + hours + "h "+ minutes + "m " + seconds + "s ";
        document.getElementById("demo2").innerHTML = message;
        //var date = new Date(now);
        //document.getElementById("demo").innerHTML = now + "enterDateTime" + enterDateTime + "exitDateTime" + exitDateTime;
       

        // If the count down is finished, write some text 
        if (distance < 0) {
            if (now > exitDateTime) 
            {
                clearInterval(x);
                document.getElementById("demo").innerHTML = "EXPIRED";
            } 
                
            
        }
    }, 1000);
</script>



		<?php
	}
		
		?>