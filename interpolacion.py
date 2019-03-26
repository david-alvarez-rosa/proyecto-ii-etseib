from adafruit_servokit import ServoKit
from time import sleep
import posicion

from math import pi


kit = ServoKit(channels = 16)


def move(servo, angle):
    steps = 50
    time = 4
    timeStep = time/steps
    angleIni = 90
    h = (angle - angleIni)/50
    for i in range(0, 50):
        angleIni = angleIni + h
        kit.servo[servo].angle = angleIni
        sleep(timeStep)



# ---------------- Prueba ---------------------
def convertRadiansToDegrees(phi):
    return (phi* 180)/pi


while (True):
    py = float(input())
    px = float(input())
    h = 0

    phi1, phi2, phi3, phi4 = posicion.prueba(px, py, h)

    phi1 = convertRadiansToDegrees(phi1)
    phi2 = convertRadiansToDegrees(phi2)
    phi3 = convertRadiansToDegrees(phi3)
    phi4 = convertRadiansToDegrees(phi4)

    print(phi1, phi2, phi3, phi4)

    kit.servo[].angle = phi1
    kit.servo[].angle = phi2
    kit.servo[].angle = phi3
    kit.servo[].angle = phi4
