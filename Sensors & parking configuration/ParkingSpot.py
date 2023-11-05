import requests
import RPi.GPIO as GPIO
import time
GPIO.setmode(GPIO.BCM)

# Check the status of the parking spots based on the readings of the ultrasonic sensors
def check_parking(int_park_spot, float_sensors): 

    # Copy the previous parking spot status to update it
    new_park_spot = int_park_spot.copy()
    print("call check_parking")

    # Check each spot
    for i in range(0,4):
       
        # Check the main sensor of each spot to see if it is free (0) or if the sensor made an erroneous measurement(2)
        if (int_park_spot[i] == 0) or (int_park_spot[i] == 2):
            
            # If the measured distance < 20cm => Occupied
            # Main sensor
            if float_sensors[i * 2] < 20.0:
                print(str(i))
                # Check the neighbors
                is_error = False
                # Assume that neighbors are free. Only that spot is taken
                min_error = i # Left spot
                max_error = i # Right spot
                for j in range(0,4):
                    # Check if the main sensor of the neighbor empty spot also detects a vehicle
                    if (i!=j) and (int_park_spot[j] == 0 and float_sensors[j * 2] < 20.0):
                        if j<i: # Left spot also occupied j<i 
                            min_error = j
                        else: # Right spot also occupied j>i
                            max_error = j
                        is_error = True # Wrong parking was detected. Neighbor spot is also affected
                        
                if is_error:
                    # Mark all affected spots with error
                    for j in range(min_error,max_error+1): # Mark all affected neighbors with error state
                        new_park_spot[j] = 2 # Error state
                else:
                    new_park_spot[i] = 1  # Parkspot correctly occupied
            else:
                new_park_spot[i] = 0 # Parkspot not occupied. Main sensor not confirming the parking
        # If the main sensor reads > 20 and the spot was previously occupied/error state => The spot is now free
        elif int_park_spot[i] != 0 and float_sensors[i*2] > 20.0: 
            new_park_spot[i] = 0

    return new_park_spot # Returns the new state of the parking spot

TIMER_BLOCK_ACCESS = 3 # Sensors 8, 9, 10 timeout period (3 reading cycles) before signalling the blocked access

Led4 = 3 # GPIO 3
Led1 = 24
Led3 = 7
Led2 = 16
LedParkingProblem = 19
LedParkingAccess = 12

GPIO.setup(Led1,GPIO.OUT)
GPIO.setup(Led3,GPIO.OUT)
GPIO.setup(Led4,GPIO.OUT)
GPIO.setup(Led2,GPIO.OUT)
GPIO.setup(LedParkingProblem,GPIO.OUT)
GPIO.setup(LedParkingAccess,GPIO.OUT)

GPIO.output(Led1,True)
GPIO.output(Led4,True)
GPIO.output(Led3,True)
GPIO.output(Led2,True)
GPIO.output(LedParkingProblem,True)
GPIO.output(LedParkingAccess,True)

time.sleep(5)
GPIO.output(Led1,False)
GPIO.output(Led4,False)
GPIO.output(Led3,False)
GPIO.output(Led2,False)
GPIO.output(LedParkingProblem,False)
GPIO.output(LedParkingAccess,False)

parkingAccessBlocked = TIMER_BLOCK_ACCESS # Initialize the parking access blocked timeout variable
# GET request from DB the previous parking spot state. 
# Values are received as string. They are split and converted to INT in array int_parking_spot
response_parkingSpot = requests.get("http://parking.local/Web_Licenta/get_sensors.php?request=parkingSpot")
parking_spotWeb = response_parkingSpot.text # Response from the request
values_parking_spot = parking_spotWeb.split("; ") # String splitted Array
int_parking_spot = [int(value) for value in values_parking_spot] # convert each value from the array

while True:
    # GET request from DB for the ultrasonic sensors
    response = requests.get("http://parking.local/Web_Licenta/get_sensors.php?request=distance")
    sensors_web = response.text # Response from the request
    values_sensors = sensors_web.split("; ") # String splitted Array
    float_sensors_values = [float(value) for value in values_sensors] # convert each value from the array to float
    print(float_sensors_values)
    float_sensors_values[6] = 40.0 # Overwrite sensor 7

    # Sensors 8, 9, 10 used for detecting the blocked access
    if float_sensors_values[7] < 13.0 or  float_sensors_values[8] < 13.0 or float_sensors_values[9] < 13.0:
        if parkingAccessBlocked > 0 :
            parkingAccessBlocked = parkingAccessBlocked-1

    else:
        parkingAccessBlocked = TIMER_BLOCK_ACCESS #TIMER_BLOCK_ACCESS is reset to 3
        
    # Save the new parking state   
    int_parking_spot = check_parking(int_parking_spot,float_sensors_values)


    # If there is an error at any spot -> Turn the red LED on
    if int_parking_spot[0] == 2 or int_parking_spot[1] == 2 or int_parking_spot[2] == 2 or int_parking_spot[3] == 2:
        GPIO.output(LedParkingProblem,True)
    else:
        GPIO.output(LedParkingProblem,False)


    # If the parking spot is available, turn corresponding the LED on
    if int_parking_spot[0] == 0:
        GPIO.output(Led1,True)
    else:
        GPIO.output(Led1,False)        
        
    if int_parking_spot[1] == 0:
        GPIO.output(Led2,True)
    else:
        GPIO.output(Led2,False) 

    if int_parking_spot[2] == 0:
        GPIO.output(Led3,True)
    else:
        GPIO.output(Led3,False) 

    if int_parking_spot[3] == 0:
        GPIO.output(Led4,True)
    else:
        GPIO.output(Led4,False) 

    # If the timer=0, turn on the red LED for blocking the access
    if parkingAccessBlocked == 0:
        GPIO.output(LedParkingAccess,True)
    else: 
        GPIO.output(LedParkingAccess,False)

    # Inform the DB about the new parking states
    urlSensor = "http://parking.local/Web_Licenta/set_parking_state.php?id1=1&value1="+str(int_parking_spot[0])+"&id2=2&value2="+str(int_parking_spot[1])+"&id3=3&value3="+str(int_parking_spot[2])+"&id4=4&value4="+str(int_parking_spot[3])
    response1 = requests.get(urlSensor) # Send the request
    print (urlSensor)
    
    print(int_parking_spot)
    time.sleep(0.1)
