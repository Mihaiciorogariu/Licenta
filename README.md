# Parking lot monitoring system implemented through Raspberry Pi and ultrasonic sensors

This diploma project presents a method of implementing a parking monitoring system, based on the use of the Raspberry Pi 4 microcontroller and 
HC-SR04 ultrasonic sensors as a method of detecting vehicles within the facility. It also uses both an HC-SR501 passive infrared (PIR) sensor for presence detection 
and a DHT-11 sensor for measuring temperature and humidity within the parking lot. The data measured by the temperature and humidity sensor will be displayed on a 
digital screen, represented by a seven-segment, four-digit display, along with the current number of vacant and occupied spaces in the facility. A SG90 servo motor is 
used to implement the barrier, together with an RFID reader, represented by the MFRC522 module. The software part of the implementation consists of a web interface used 
for displaying information related to the parking lot, such as the current number of available parking spaces, while also allowing users to create accounts in order to 
reserve parking spaces by filling in a specific form. The website also contains the live feed captured by a webcam, displaying images from inside the facility.
The front-end was implemented using HTML and CSS, while the back-end of the interface consisted of a database. 
To ensure the functionality, the LAMP Stack (Linux, Apache, MariaDB and PHP) was utilized.
