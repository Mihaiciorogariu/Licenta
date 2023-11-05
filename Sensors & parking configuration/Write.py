#!/usr/bin/env python

import RPi.GPIO as GPIO # Import the GPIO library for Raspberry Pi
from mfrc522 import SimpleMFRC522 # Using the class SimpleMFRC522 from the library mfrc522 to interact with the reader

reader = SimpleMFRC522() # Create an instance of SimpleMFRC522 class that interacts with the module
try:
        text = input('New data:')
        print("Now place your tag to write")
        reader.write(text)
        print("Written")
finally:
        GPIO.cleanup()
