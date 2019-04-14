from math import atan, sqrt, pi
from plano import prueba
from main_move import V1,U1,V2,U2

def convertRadiansToDegrees(phi):
    return (phi* 180)/pi


def movimiento(x, y):
    phi0 = atan(y/x)
    phi1, phi2, phi3, phi4 = prueba(sqrt(x*x + y*y), 0)
    return phi0, phi1, phi2, phi3, phi4

while True:
    x =  float(input())
    y =  float(input())
    phi0, phi1, phi2, phi3, phi4 = movimiento(x, y)
    print("phi0", convertRadiansToDegrees(phi0))
    print("phi1", convertRadiansToDegrees(phi1))
    print("phi2", convertRadiansToDegrees(phi2))
    print("phi3", convertRadiansToDegrees(phi3))
    print("phi4", convertRadiansToDegrees(phi4))
