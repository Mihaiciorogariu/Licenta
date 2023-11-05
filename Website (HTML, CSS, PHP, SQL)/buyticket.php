<?php 
session_start(); 
include "functii.php";
initializare();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Pay Parking Ticket - Parking Lot</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
  
    <header>
      <h1>Parking Lot</h1>
      
	  
	  <div class="panel">
			<nav>
				<ul>
					<li><a href="index.php">Home</a></li>
					<li><a href="buyticket.php">Pay Ticket</a></li>
					<li><a href="createaccount.php">Create Account</a></li>
					<li><a href="login.php">Log In</a></li>
				</ul>
			</nav>
		</div>
	  
    </header>
    <main>
      <section>
        <h2>Pay Parking Ticket</h2>
        <form action="#" method="post">
          <label for="ticket-number">Parking Ticket Number:</label>
          <input type="text" id="ticket-number" name="ticket-number" required>
          
          <label for="license-plate">License Plate Number:</label>
          <input type="text" id="license-plate" name="license-plate" required>
          
          <label for="payment-method">Payment Method:</label>
          <select id="payment-method" name="payment-method">
            <option value="credit-card">Credit Card</option>
            <option value="debit-card">Debit Card</option>
            <option value="paypal">PayPal</option>
          </select>
          
          <label for="card-number">Card Number:</label>
          <input type="text" id="card-number" name="card-number" required>
          
          <label for="expiration-date">Expiration Date:</label>
          <input type="text" id="expiration-date" name="expiration-date" required>
          
          <label for="cvv">CVV:</label>
          <input type="text" id="cvv" name="cvv" required>
          
          <input type="submit" value="Pay Now">
        </form>
      </section>
    </main>
    <footer>
      <p>&copy; 2023 Parking Lot</p>
    </footer>
  </body>
</html>
