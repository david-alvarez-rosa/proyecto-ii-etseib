from adafruit_servokit import ServoKit
from time import sleep
import plano

from math import pi


kit = ServoKit(channels = 16)

# Vector con los ánngulos de los servos
# 0: ROTACION
# 1: BRAZO PRINCIPAL
# 2: BRAZO SECUNDARIO
# 3: NO MUEVE NADA
# 4: PINZA ROTACIÓN
# 5: PINZA APERTURA

S = [0, 0, 0, 0, 0, 0]

# Se actualizará en todo momento para evitar movimientos bruscos


def move(servo, angle):
    steps = 50
    time = 4
    timeStep = time/steps
    angleIni = S[servo]
    h = (angle - angleIni)/50
    for i in range(0, 50):
        angleIni = angleIni + h
        kit.servo[servo].angle = angleIni
        sleep(timeStep)

    S[servo] = angle
    return 0



# ---------------- Prueba ---------------------
def convertRadiansToDegrees(phi):
    return (phi* 180)/pi


while (True):
    px = float(input())
    py = float(input())
    h = 0

    phi1, phi2, phi3, phi4 = plano.prueba(px, py, h)

    phi1 = convertRadiansToDegrees(phi1)
    phi2 = convertRadiansToDegrees(phi2)
    phi3 = convertRadiansToDegrees(phi3)
    phi4 = convertRadiansToDegrees(phi4)

    print(phi1, phi2, phi3, phi4)

    kit.servo[].angle = phi1
    kit.servo[].angle = phi2
    kit.servo[].angle = phi3
    kit.servo[].angle = phi4
