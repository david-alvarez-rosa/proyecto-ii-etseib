"""
Se encarga de coordinar el movimiento del brazo robótico.
  - Define la posición espacial de las casillas del tablero y de los
    almacenes.
  - Contiene funciones que permiten mover piezas de una posición
    (espacial) a otra.
"""

from math import *
from movimiento.plano import verticalMove
from movimiento.servos import *


# DEFINICION DE VARIABLES
# Almacén más separado, si no parece que no es capaz de llegar.
# TODO: Revisar esto.
R = 283.582
ang = (40*pi)/180

# V1 es un vector con la posición de 4 "X"'s
V1 = [[R*cos(ang), R*sin(ang)], [R*cos(ang), R*sin(ang)], [R*cos(ang), R*sin(ang)], [R*cos(ang), R*sin(ang)]]
# U1 indica el número de pieza a coger en almacén de "X"'s
U1 = 0

# V2 es un vector con la posición de 4 "O"'s
V2 = [[R*cos(-ang), R*sin(-ang)], [R*cos(-ang), R*sin(-ang)], [R*cos(-ang), R*sin(-ang)], [R*cos(-ang), R*sin(-ang)]]
# U1 indica el número de pieza a coger en almacén de "O"'s
U2 = 0

# Alturas del almacen.
H = [50, 33.333, 16.667, 0]

# Unión de variables del almacén.
V = [V1, V2]
U = [U1, U2]

# Posicion del tablero de casillas ancho_tablero*ancho_tablero (mm²)
ancho_tablero = 33.33333
# Tablero también más separado.
# TODO: Revisar esto.
x_inicial_t = 116.988

fila_1 = [[x_inicial_t, ancho_tablero], [x_inicial_t + ancho_tablero, ancho_tablero], [x_inicial_t + 2*ancho_tablero, ancho_tablero]]
fila_2 = [[x_inicial_t, 0], [x_inicial_t + ancho_tablero, 0], [x_inicial_t + 2*ancho_tablero, 0]]
fila_3 = [[x_inicial_t, -ancho_tablero], [x_inicial_t + ancho_tablero, -ancho_tablero], [x_inicial_t + 2*ancho_tablero, -ancho_tablero]]
tablero = [fila_1, fila_2, fila_3]

# Vector con los ánngulos de los servos
S = [0]*6


def reset_servos():
    global S
    S = [0]*6
    moveServos(S)


def movePieceFromTo(p0, pf, h):
    """
    Mueve una pieza sobre el plano (horizontal) de una posición p0 = [x0, y0] a
    una pf = [xf, yf].

    La pieza utilizada es una goma Marca: Milan, Modelo: 430
    Medidas: 2.8 x 2.8 x 1.3 cm.
    """
    printServosAngles(S)

    # Posicionar pinza abierta por encima de la pieza (en posición de
    # inicio).
    r = sqrt(pow(p0[0], 2) + pow(p0[1], 2))
    S[0] = atan(p0[1]/p0[0])
    S[4] = -S[0]  # MODIFICAR POR TEMA ANGULOS NEGATIVOS
    # ancho = 34  # Le dejo margen. Hay q vigilar q no toque a otras piezas
    # S[5] = acos((ancho+18)/52)
    # h0 = 26*sin(S[5])+68
    phi1, phi2, phi3, phi4 = verticalMove(r, h)
    S[1] = phi1
    S[2] = phi4

    moveServos(S)
    printServosAngles(S)

    # # Cerrar pinza para coger pieza.
    # ancho = 25  # A 25 mm. (< 28) la pinza hara fuerza - MODIFICAR
    # S[5] = acos((ancho+18)/52)
    # # h0 = 26*sin(S[5])+68
    # phi1, phi2, phi3, phi4 = verticalMove(r, h0)
    # S[1] = phi1
    # S[2] = phi4

    # moveServos(S)
    # printServosAngles(S)

    # # Subir la pinza para que no se choque
    # phi1, phi2, phi3, phi4 = verticalMove(r, h0+10)  # TODO: MODIFICAR
    # S[1] = phi1
    # S[2] = phi4

    # moveServos(S)
    # printServosAngles(S)

    # Mover la pieza hasta la posición final
    r = sqrt(pow(pf[0], 2) + pow(pf[1], 2))
    S[0] = atan(pf[1]/pf[0])
    S[4] = -S[0]  # MODIFICAR POR TEMA ANGULOS NEGATIVOS
    phi1, phi2, phi3, phi4 = verticalMove(r, 0)
    S[1] = phi1
    S[2] = phi4

    moveServos(S)
    printServosAngles(S)

    # # Bajar pinza sobre posición final.
    # phi1, phi2, phi3, phi4 = verticalMove(r, h0)
    # S[1] = phi1
    # S[2] = phi4

    # moveServos(S)
    # printServosAngles(S)

    # # Soltar pieza en la posición final.
    # ancho = 34  # > 28
    # S[5] = acos((ancho+18)/52)
    # # h0 = 26*sin(S[5])+68
    # phi1, phi2, phi3, phi4 = verticalMove(r, h0)
    # S[1] = phi1
    # S[2] = phi4

    # moveServos(S)
    # printServosAngles(S)

    # # Subir la pinza para que no se choque
    # phi1, phi2, phi3, phi4 = verticalMove(r, h0+50)  # MODIFICAR
    # S[1] = phi1
    # S[2] = phi4

    # moveServos(S)
    # printServosAngles(S)

    # Dejar el brazo en posición por defecto para permitir ver el tablero.
    # Esta posición se podría mejorar
    reset_servos()
    printServosAngles(S)


def movePiece(i, j, tipo, posAlmacen):
    """
    Posiciona una pieza (de un tipo) en una posición concreta del tablero.
    """
    if tipo == "X":
        tipo = 0
    else:
        tipo = 1

    print("%.1f" % V[tipo][U[tipo]][0], end = ",")
    print("%.1f" % V[tipo][U[tipo]][1], end = ",")
    print("%.1f" % tablero[i][j][0], end = ",")
    print("%.1f" % tablero[i][j][1], end = ",")

    movePieceFromTo(V[tipo][posAlmacen], tablero[i][j], H[posAlmacen])
    U[tipo] += 1

    print(i, end =",")
    print(j, end =",")
