import RPi.GPIO as GPIO
import time
import requests
from datetime import datetime

GPIO.setmode(GPIO.BCM) # Method of numbering the GPIO pins

# Pin configuration
PirInputPin = 2          # GPIO2 for the sensor
LedParkingWorking = 1    # GPIO1 for the green LED
GPIO.setup(LedParkingWorking,GPIO.OUT) # Setting the LED as output to control its state 

SystemState = GPIO.LOW       # State -> GPIO.LOW - motion not detected, GPIO.HIGH - motion detected

old_state = 3 # Arbitrary value representing the initial state when no motion is detected
GPIO.output(LedParkingWorking,False) # LED initially tuned off, because no motion was detected

timerState = 0 # Countdown timer for transitioning from the HIGH to LOW state, after motion was detected

GPIO.setup(PirInputPin, GPIO.IN) # Set PirInputPin (GPIO2) as INPUT pin, to allow Raspberry Pi to receive and interpret the detected signal


while True: # Infinite loop to monitor the state of the sensor continuously

    valSenzorMiscareCitita = GPIO.input(PirInputPin) # Stores the current state of the sensor
    
    
    if valSenzorMiscareCitita == GPIO.HIGH: # If movement was detected set a countdown timer of 100
        timerState = 100
        if SystemState == GPIO.LOW: # SystemState is set to GPIO.HIGH, indicating that motion is now detected
            SystemState = GPIO.HIGH
            GPIO.output(LedParkingWorking,True)
           


    if old_state != SystemState : # Update the previous state to the current one
        old_state = SystemState  # Print the curret state to the command line
        print (old_state)     
        # Send a GET request to upload the state into the database
        urlSensor = "http://parking.local/Web_Licenta/set_sensors.php?id_sensor=11&value="+str(old_state)
        response1 = requests.get(urlSensor)

    if timerState > 0: # After movement was detected, the countdown timer of 100 is decremented by 1 each iteration
        
        timerState = timerState -1
        
    
    if timerState == 0: # If the timer is 0, then no movement is detected anymore
       
        SystemState = GPIO.LOW
        GPIO.output(LedParkingWorking,False)


    time.sleep(0.1)  # Add delay to reduce CPU usage
