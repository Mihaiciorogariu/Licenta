import RPi.GPIO as GPIO   # library for accessing GPIO pins
import time       # time-related functions
import requests   # enables HTTP requests
GPIO.setmode(GPIO.BCM) # Method of numbering the GPIO pins

Trig = 14          # GPIO14 trig comun 1-7
Trig2 = 4          # trig comun 8-10
Echo1 = 15         # senzor 1
Echo2 = 18         # senzor 2
Echo3 = 23         # senzor 3
Echo4 = 21         # senzor 4
Echo5 = 20         # senzor 5
Echo6 = 17         # senzor 6
Echo7 = 26         # senzor 7
Echo8 = 27         # senzor 8
Echo9 = 5          # senzor 9
Echo10 = 0         # senzor 10


TIMEOUTVALUE=5000
GPIO.setup(Trig,GPIO.OUT)  # OUT: Raspberry -> Sensor
GPIO.setup(Trig2,GPIO.OUT)
GPIO.setup(Echo7,GPIO.IN) # IN: Sensor -> Raspberry
GPIO.setup(Echo1,GPIO.IN)
GPIO.setup(Echo2,GPIO.IN)
GPIO.setup(Echo3,GPIO.IN)
GPIO.setup(Echo4,GPIO.IN)
GPIO.setup(Echo5,GPIO.IN)
GPIO.setup(Echo6,GPIO.IN)
GPIO.setup(Echo8,GPIO.IN)
GPIO.setup(Echo9,GPIO.IN)
GPIO.setup(Echo10,GPIO.IN)
GPIO.output(Trig, False) # Trigger state is initially false, so that the Trigger pulse is not sent immediately when the script is run

response = requests.get("http://parking.local/Web_Licenta/get_sensors.php?request=distance")
sensors_web = response.text # Response from the request
values_sensors = sensors_web.split("; ") # String splitted Array
float_sensors_values = [float(value) for value in values_sensors] # convert each value from the array to float

distance1=float_sensors_values[0]
distance2=float_sensors_values[1]
distance3=float_sensors_values[2]
distance4=float_sensors_values[3]
distance5=float_sensors_values[4]
distance6=float_sensors_values[5]
distance7=float_sensors_values[6]
distance8=float_sensors_values[7]
distance9=float_sensors_values[8]
distance10=float_sensors_values[9]

while(True):    # Infinite loop for taking the measurements

   time.sleep(0.25)       # 0.25 seconds delay between each measurement

   GPIO.output(Trig, True) # Set Trig as True (High) for 0.00001 seconds in order to emit the trigger impluse
   time.sleep(0.00001)
   GPIO.output(Trig, False) # After emitting the pulse, Trig is set back to False (Low)
   timeoutvalue=0
   while GPIO.input(Echo1)==0 and timeoutvalue<TIMEOUTVALUE:  # Waiting for the feedback from the ultrasonic pulses
     start = time.time() # Time of the emmision
     timeoutvalue=timeoutvalue+1
    
   while GPIO.input(Echo1)==1 and timeoutvalue<TIMEOUTVALUE:   # Waiting for the Echo signal to finish
     finish = time.time() # Time of reception
     timeoutvalue=timeoutvalue+1
   
   if timeoutvalue<TIMEOUTVALUE:
     distance1 = round((finish - start) * 340 * 100 / 2, 1)  # Speed of sound = 340 m/s
   
   print ("Distance read by sensor 1: ",distance1," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)       
   
   GPIO.output(Trig, True)
   time.sleep(0.00001)
   GPIO.output(Trig, False)
   timeoutvalue=0
   while GPIO.input(Echo2)==0 and timeoutvalue<TIMEOUTVALUE:  
     start = time.time()
     timeoutvalue=timeoutvalue+1
    
   while GPIO.input(Echo2)==1 and timeoutvalue<TIMEOUTVALUE:  
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:  
      distance2 = round((finish - start) * 340 * 100 / 2, 1)  

   print ("Distance read by sensor 2: ",distance2," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)     
   
   GPIO.output(Trig, True)
   time.sleep(0.00001)
   GPIO.output(Trig, False)
   timeoutvalue=0
   while GPIO.input(Echo3)==0 and timeoutvalue<TIMEOUTVALUE:  
     start = time.time()
     timeoutvalue=timeoutvalue+1
    
   while GPIO.input(Echo3)==1 and timeoutvalue<TIMEOUTVALUE:   
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:   
      distance3 = round((finish - start) * 340 * 100 / 2, 1)  

   print ("Distance read by sensor 3: ",distance3," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)       
   
   GPIO.output(Trig, True)
   time.sleep(0.00001)
   GPIO.output(Trig, False)
   timeoutvalue=0
   while GPIO.input(Echo4)==0 and timeoutvalue<TIMEOUTVALUE:  
     start = time.time()
     timeoutvalue=timeoutvalue+1

   while GPIO.input(Echo4)==1 and timeoutvalue<TIMEOUTVALUE:  
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:
      distance4 = round((finish - start) * 340 * 100 / 2, 1)  

   print ("Distance read by sensor 4: ",distance4," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)       
   
   GPIO.output(Trig, True)
   time.sleep(0.00001)
   GPIO.output(Trig, False)
   timeoutvalue=0
   while GPIO.input(Echo5)==0 and timeoutvalue<TIMEOUTVALUE:  
     start = time.time()
     timeoutvalue=timeoutvalue+1
    
   while GPIO.input(Echo5)==1 and timeoutvalue<TIMEOUTVALUE:   
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:  
      distance5 = round((finish - start) * 340 * 100 / 2, 1)  

   print ("Distance read by sensor 5: ",distance5," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)       
   
   GPIO.output(Trig, True)
   time.sleep(0.00001)
   GPIO.output(Trig, False)
   timeoutvalue=0
   while GPIO.input(Echo6)==0 and timeoutvalue<TIMEOUTVALUE:  
     start = time.time()
     timeoutvalue=timeoutvalue+1
    
   while GPIO.input(Echo6)==1 and timeoutvalue<TIMEOUTVALUE:   
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:  
      distance6 = round((finish - start) * 340 * 100 / 2, 1)  

   print ("Distance read by sensor 6: ",distance6," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)       
   
   GPIO.output(Trig, True)
   time.sleep(0.00001)
   GPIO.output(Trig, False)
   timeoutvalue=0
   while GPIO.input(Echo7)==0 and timeoutvalue<TIMEOUTVALUE: 
     start = time.time()
     timeoutvalue=timeoutvalue+1
    
   while GPIO.input(Echo7)==1 and timeoutvalue<TIMEOUTVALUE:   
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:  
      distance7 = round((finish - start) * 340 * 100 / 2, 1)  

   print ("Distance read by sensor 7: ",distance7," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)      
   
   GPIO.output(Trig2, True)
   time.sleep(0.00001)
   GPIO.output(Trig2, False)
   timeoutvalue=0
   while GPIO.input(Echo8)==0 and timeoutvalue<TIMEOUTVALUE:  
     start = time.time()
     timeoutvalue=timeoutvalue+1

   while GPIO.input(Echo8)==1 and timeoutvalue<TIMEOUTVALUE:   
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:  
      distance8 = round((finish - start) * 340 * 100 / 2, 1) 

   print ("Distance read by sensor 8: ",distance8," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)       
   
   GPIO.output(Trig2, True)
   time.sleep(0.00001)
   GPIO.output(Trig2, False)
   timeoutvalue=0
   while GPIO.input(Echo9)==0 and timeoutvalue<TIMEOUTVALUE:  
     start = time.time()
     timeoutvalue=timeoutvalue+1
    
   while GPIO.input(Echo9)==1 and timeoutvalue<TIMEOUTVALUE:  
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:  
      distance9 = round((finish - start) * 340 * 100 / 2, 1) 

   print ("Distance read by sensor 9: ",distance9," cm", " Timeout for reading: ", timeoutvalue)



   time.sleep(0.25)     
   
   GPIO.output(Trig2, True)
   time.sleep(0.00001)
   GPIO.output(Trig2, False)
   timeoutvalue=0
   while GPIO.input(Echo10)==0 and timeoutvalue<TIMEOUTVALUE:  
     start = time.time()
     timeoutvalue=timeoutvalue+1
    
   while GPIO.input(Echo10)==1 and timeoutvalue<TIMEOUTVALUE: 
     finish = time.time()
     timeoutvalue=timeoutvalue+1
   if timeoutvalue<TIMEOUTVALUE:  
      distance10 = round((finish - start) * 340 * 100 / 2, 1)  

   print ("Distance read by sensor 10: ",distance10," cm", " Timeout for reading: ", timeoutvalue)



  # Sends the measurements to the database by sending a GET request to the URL

  # The URL constits of the ID of each sensor and its corresponding measurement value
   urlDistanta1 = "http://parking.local/Web_Licenta/set_distance_sensors.php?id_sensor1=4&value1="+str(distance1)+"&id_sensor2=5&value2="+str(distance2)+"&id_sensor3=6&value3="+str(distance3)+"&id_sensor4=7&value4="+str(distance4)+"&id_sensor5=8&value5="+str(distance5)+"&id_sensor6=9&value6="+str(distance6)+"&id_sensor7=12&value7="+str(distance7)+"&id_sensor8=13&value8="+str(distance8)+"&id_sensor9=14&value9="+str(distance9)+"&id_sensor10=15&value10="+str(distance10)
  # Sending the GET request, using the "requests" module
   response1 = requests.get(urlDistanta1)
  # Print the URL in the command line
   print(urlDistanta1)

   
# Set all GPIO pins to their default state. 
# Necessary for the next measurement, so that the initial state is not the state from the previous measurement
GPIO.cleanup()
