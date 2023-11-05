<?php
session_start();
include "functii.php";
initializare();


$sql = "SELECT ParkSpotTaken FROM `parkingspot` ";
$result = $mysqli->query($sql);
$parkingspot = $result->fetch_all(MYSQLI_ASSOC);

$sql2 = "SELECT Value, SensorName FROM `sensors` WHERE ID_Sensor in (4, 5, 6, 7, 8, 9, 12, 13, 14, 15) ";
$result2 = $mysqli->query($sql2);
$sensors = $result2->fetch_all(MYSQLI_ASSOC);

$sql3 = "SELECT Value, SensorName, SensorType FROM `sensors` WHERE ID_Sensor in (1, 3, 11) ";
$result3 = $mysqli->query($sql3);
$sensor2 = $result3->fetch_all(MYSQLI_ASSOC);



?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sensors</title>
    <link rel="stylesheet" href="users1.css">
    
</head>
<body>
    <header>
    <div class="logo">
        <h1>Sensors</h1>
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

    <main>
        <div class="table-container">
            <h3 style="text-align: center;">Parking spots</h3>
            <table >
                <tr>
                    <?php foreach ($parkingspot as $row) {
                        if ($row['ParkSpotTaken'] == 0) {
                            echo '<td><img src="0.jpg" width="450" height="80"></td>';
                        }
                        if ($row['ParkSpotTaken'] == 1) {
                            echo '<td><img src="1.jpg" width="450" height="80"></td>';
                        }
                        if ($row['ParkSpotTaken'] == 2) {
                            echo '<td><img src="2.jpg" width="450" height="80"></td>';
                        }
                        
                        }
                        ?>
                </tr>
                
            </table>
        </div>

        <div class="table-container">
            <h3 style="text-align: center;">Distance sensor values</h3>
            <table >
                <tr>
                    <th>Nr. crt</th>
                    <th>Sensor name</th>
                    <th>Sensor value</th>
                    
                </tr>
                <?php
                $Nrcrt = 0;
                

                foreach ($sensors as $row) {
                    $Nrcrt++;
                ?>
                    <tr>
                        <td><?php echo $Nrcrt; ?></td>
                        <td><?php echo $row['SensorName']; ?></td>
                        <td><?php echo $row['Value']; ?></td>
                        
                    </tr>
                <?php } ?>
            </table>
        </div>

        <div class="table-container">
            <h3 style="text-align: center;">Sensor values</h3>
            <table >
                <tr>
                    <th>Nr. crt</th>
                    <th>Sensor name</th>
                    <th>Sensor type</th>
                    <th>Sensor value</th>
                    
                </tr>
                <?php
                $Nrcrt = 0;
                

                foreach ($sensor2 as $row) {
                    $Nrcrt++;
                ?>
                    <tr>
                        <td><?php echo $Nrcrt; ?></td>
                        <td><?php echo $row['SensorName']; ?></td>
                        <td><?php echo $row['SensorType']; ?></td>
                        <td><?php echo $row['Value']; ?></td>
                        
                    </tr>
                <?php } ?>
            </table>
        </div>




    </main>
</body>

<script>
setTimeout(function() {
    location.reload();
}, 3000);
</script>

</html>
