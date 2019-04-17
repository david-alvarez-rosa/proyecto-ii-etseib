"""
Define y mueve suavemente los servos.
 -- Todo lo de mover los servos está por ahora comentado --
"""


# from adafruit_servokit import ServoKit
from time import sleep
from math import pi


# kit = ServoKit(channels = 16)

# Vector con los ánngulos de los servos
# 0: ROTACION
# 1: BRAZO PRINCIPAL
# 2: BRAZO SECUNDARIO
# 3: NO MUEVE NADA
# 4: PINZA ROTACIÓN
# 5: PINZA APERTURA

# Se actualizará en todo momento para evitar movimientos bruscos

# Variable real de ángulos en servos.
Sp = [0]*6

def rad2Deg(phi):
    """
    Convierte de radianes a grados.
    """
    return (phi* 180)/pi


def printServosAngles(S):
    """
    Devuelve información de los ángulos de los servos. Eliminar esta función más
    adelante.
    """
    for i in range(6):
        # El 3 no es un servo.
        if i != 3:
            print("%.2f" % rad2Deg(S[i]), end =",")


def moveServo(servo, angle):
    """
    Mueve el servo a un determinado ángulo (en radianes).
    TODO: mirar para cambiar las velocidades o hacerlas de otra manera.
    """
    angle = rad2Deg(angle)
    steps = 50
    time = 0  # Modificar este valor.
    timeStep = time/steps
    angleIni = Sp[servo]
    h = (angle - angleIni)/50
    for i in range(0, 50):
        angleIni = angleIni + h
        # kit.servo[servo].angle = angleIni
        sleep(timeStep)

    Sp[servo] = angleIni


def moveServos(angles):
    """
    Mueve los servos a los ángulos dados (en radianes).
    """
    for i in range(6):
        # El 3 no es un servo.
        if i != 3:
            moveServo(i, angles[i])
