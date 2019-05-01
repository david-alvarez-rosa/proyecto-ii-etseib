"""
Define y mueve simultáneamente y de manera progresiva los servos.
 -- Todo lo de mover los servos está por ahora comentado --

Los servos están numerados de la siguiente manera:
0: ROTACION
1: BRAZO PRINCIPAL
2: BRAZO SECUNDARIO
3: NO MUEVE NADA
4: PINZA ROTACIÓN
5: PINZA APERTURA
"""

# from adafruit_servokit import ServoKit
from time import sleep
from math import *
from threading import Thread


# kit = ServoKit(channels = 16)

# Variable real de ángulos en servos.
Sp = [0]*6


def rad2Deg(phi):
    """
    Convierte de radianes a grados.
    """
    return (phi* 180)/pi


def printServosAngles(S):
    """
    Devuelve información de los ángulos de los servos.
    """
    for i in range(6):
        # El 3 no es un servo.
        if i != 3:
            print(floor(rad2Deg(S[i])), end = ",")


def moveServo(servo, angle):
    """
    Mueve el servo a un determinado ángulo (en radianes) de manera progresiva.
    """
    global Sp
    angle = rad2Deg(angle)
    steps = 50
    time = 0 # Cambiar este valor al hacer la conexión real con el brazo.
    timeStep = time/steps
    angleIni = Sp[servo]
    h = (angle - angleIni)/steps
    for i in range(steps):
        angleIni = angleIni + h
        # PARA QUE NO HAYA PROBLEMAS TRUNCO!!!!!!!!
        # kit.servo[servo].angle = floor(angleIni)
        sleep(timeStep)

    Sp[servo] = floor(angleIni)


def moveServos(angles):
    """
    Mueve los servos simultáneamente a los ángulos dados (en radianes).
    """
    Thread(target=moveServo, args=[0, angles[0]]).start()
    Thread(target=moveServo, args=[1, angles[1]]).start()
    Thread(target=moveServo, args=[2, angles[2]]).start()
    Thread(target=moveServo, args=[4, angles[4]]).start()
    Thread(target=moveServo, args=[5, angles[5]]).start()
