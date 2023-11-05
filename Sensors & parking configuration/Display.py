import requests
import time
import serial

temperaturaCititaOld = 0 # Variables that will store the data fetched from the database
umiditateCititaOld = 1000
locurilibereOld = 1000
locuriocupateOld = 1000
rezervariOld = 1000

if __name__ == '__main__': # Program main
  

    ser = serial.Serial('/dev/ttyACM0', 9600, timeout=1) # Arduino serial connection path, baud rate, maximum reading time

    ser.reset_input_buffer() # Clear the buffer so that any remaining data does not interfere with the fetched information

    time.sleep(4)
    while True:
        
        # HTTP request to fetch sensor data from the database
        # URL = PHP script that returns requested data "temp" thourgh get_sensors.php script
        response = requests.get("http://parking.local/Web_Licenta/get_sensors.php?request=temp")
        temperaturaCitita = int(float(response.text)) # Renunta la ce e dupa virgula
        print(temperaturaCitita)
        if temperaturaCitita != temperaturaCititaOld: # Check if the read data differs from the stored one
            # Because Arduino does not support multiple Threads. (1 for displaying and 1 for reading the serial interface)
            temperaturaCititaOld = temperaturaCitita # If they differ, store in the variable the current temperature value

            # Add a number to differentiate between different data when sending it to Arduino
            # When Arduino receives the data ->  value/100 to detect the number that was added AND value%100 to detect the read value
            temperaturaCitita = temperaturaCitita+200 
            
            data = str(temperaturaCitita) + "\n" # Convert the newly computed data back into a string to send it over the serial interface 
            # print(data)
            ser.write(data.encode())  # Convert(Encode) the string to bytes
            line = ser.readline() # Read any data sent by Arduino (acknowledgement)
            print(line)
            time.sleep(1) # Wait 1 second before repeating the process for the rest of the parameters
            

        response = requests.get("http://parking.local/Web_Licenta/get_sensors.php?request=res")
        rezervariCitite = int(float(response.text))
        if rezervariCitite != rezervariOld:
            rezervariOld = rezervariCitite
            rezervariCitite = rezervariCitite+500
            data = str(rezervariCitite) + "\n"
            ser.write(data.encode())  
            line = ser.readline()
            print(line)
            time.sleep(1)


        response = requests.get("http://parking.local/Web_Licenta/get_sensors.php?request=hum")
        umiditateCitita = int(float(response.text[:2])) #Only displays the first 2 characters
        if umiditateCitita != umiditateCititaOld:
            umiditateCititaOld = umiditateCitita
            umiditateCitita = umiditateCitita+100
            data = str(umiditateCitita) + "\n"
            ser.write(data.encode())  
            line = ser.readline()
            print(line)
            time.sleep(1)
        
        response = requests.get("http://parking.local/Web_Licenta/get_sensors.php?request=free")
        locurilibereCitita = int(response.text)
        if locurilibereCitita != locurilibereOld:
            locurilibereOld = locurilibereCitita
            locurilibereCitita = locurilibereCitita+300
            data = str(locurilibereCitita) + "\n"
            ser.write(data.encode()) 
            line = ser.readline()
            print(line)
            time.sleep(1)


        
        response = requests.get("http://parking.local/Web_Licenta/get_sensors.php?request=busy")
        locuriocupateCitita = int(response.text)
        if locuriocupateCitita != locuriocupateOld:
            locuriocupateOld = locuriocupateCitita
            locuriocupateCitita = locuriocupateCitita+400
            data = str(locuriocupateCitita) + "\n"
            ser.write(data.encode())
            line = ser.readline()
            print(line)
            time.sleep(1)
        
        
        time.sleep(5)