#!/usr/bin/env python

import RPi.GPIO as GPIO # Import the GPIO library for Raspberry Pi
from mfrc522 import SimpleMFRC522 # Using the class SimpleMFRC522 from the library mfrc522 to interact with the reader
import requests #Library used for making HTTP requests
from time import sleep  # Library used for delays

GPIO.setmode(GPIO.BCM)  # Method of numbering the GPIO pins
GPIO.setup(13,GPIO.OUT) # GPIO 13 for the reader
pwm=GPIO.PWM(13,50) # 50Hz PWM signal on GPIO 13
Led = 22 # GPIO 22 for the blue LED
GPIO.setup(Led,GPIO.OUT) # Setting the LED as output to control its state 


pwm.start(0) # Initial PWM

#flagwhile=1

reader = SimpleMFRC522() # Instance of the SimplerMFRC522 class that interacts with the reader
while (True):
        try:
                id, text = reader.read() # Reading the card and returning the data stored on it: ID (+ text stored on it)
                print(id) # Print the ID read
                print(text)
                GPIO.output(Led,True) # Turn on the LED
                # pwm.start(0) 
                sleep(1) # After reading the card, pause for 1 second
                pwm.ChangeDutyCycle(7) # Raise the barrier
                sleep(5) # Pause 5 seconds
                pwm.ChangeDutyCycle(1) # Bring the barrier down
                sleep(1) 
                pwm.ChangeDutyCycle(0)
                sleep(2) # Pause for 2 seconds before being able to read a tag again
                GPIO.output(Led,False) # Turn off the LED
                #flagwhile=flagwhile-1 # Break during debugging the code
                print(len(text))
              
                urlDistanta1 = "http://parking.local/Web_Licenta/set_cards.php?&value="+str(text)
                response1 = requests.get(urlDistanta1)
                print(urlDistanta1)
        except:
                print("An exception occurred")
                continue

        