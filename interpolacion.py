from adafruit_servokit import ServoKit
from time import sleep


kit = ServoKit(channels = 16)


def move(servo, angle):
    steps = 50
    time = 4
    timeStep = time/steps
    angleIni
    h = (angle - angleIni)/50
    for i in range(0, 50):
        angleIni angleIni + h
        kit.servo[servo].angle = angleIni
        sleep(timeStep)
