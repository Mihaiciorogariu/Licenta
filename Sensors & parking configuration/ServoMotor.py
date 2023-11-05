import RPi.GPIO as gp  
from time import sleep  
gp.setmode(gp.BCM)  
gp.setup(13,gp.OUT) 

pwm=gp.PWM(13,50)  
  

pwm.start(0) 

sleep(1)
pwm.ChangeDutyCycle(7)
sleep(5)


pwm.ChangeDutyCycle(1)
sleep(1)


pwm.stop()  

gp.cleanup()  