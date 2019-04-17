from Move.plano import verticalMove
from Move.interpolacion import *
from math import pi, cos, sin, atan, sqrt, pow


# DEFINICION DE VARIABLES
R1 = 70
R2 = 100
ang1 = 0.9*(pi/2)
ang2 = 0.7*(pi/2)

# V1 es un vector con la posición de 4 "X"'s
V1 = [[R1*cos(ang1), R1*sin(ang1)], [R1*cos(ang2), R1*sin(ang2)], [R2*cos(ang1), R2*sin(ang1)], [R2*cos(ang2), R2*sin(ang2)]]
# V1 = [[R1, ang1], [R1, ang2], [R2, ang1], [R2, ang2]]
# U1 indica el número de pieza a coger en almacén de "X"'s
U1 = 0

# V2 es un vector con la posición de 4 "O"'s
V2 = [[R1*cos(-ang1), R1*sin(-ang1)], [R1*cos(-ang2), R1*sin(-ang2)], [R2*cos(-ang1), R2*sin(-ang1)], [R2*cos(-ang2), R2*sin(-ang2)]]
# V2 = [[R1, -ang1], [R1, -ang2], [R2, -ang1], [R2, -ang2]]
# U1 indica el número de pieza a coger en almacén de "O"'s
U2 = 0

# Unión de variables del almacén.
V = [V1, V2]
U = [U1, U2]

# Posicion del tablero de casillas ancho_tablero*ancho_tablero (mm²)
ancho_tablero = 50
x_inicial_t = 80

fila_1 = [[x_inicial_t + 2*ancho_tablero, -ancho_tablero], [x_inicial_t + 2*ancho_tablero, 0], [x_inicial_t + 2*ancho_tablero, ancho_tablero]]
fila_2 = [[x_inicial_t + ancho_tablero, -ancho_tablero], [x_inicial_t + ancho_tablero, 0], [x_inicial_t + ancho_tablero, ancho_tablero]]
fila_3 = [[x_inicial_t, -ancho_tablero], [x_inicial_t, 0], [x_inicial_t, ancho_tablero]]

tablero = [fila_1, fila_2, fila_3]

# Vector con los ánngulos de los servos
# 0: ROTACION
# 1: BRAZO PRINCIPAL
# 2: BRAZO SECUNDARIO (El que arreglamos)
# 3: NO MUEVE NADA
# 4: PINZA ROTACIÓN
# 5: PINZA APERTURA
S = [0]*6


def reset_servos():
    global S
    S = [0]*6
    moveServos(S)


def movePieceFromTo(p0, pf):
    """
    Mueve una pieza sobre el plano (horizontal) de una posición p0 = [x0, y0] a
    una pf = [xf, yf].
    """
    printServosAngles(S)

    # Posicionar pinza abierta por encima de la pieza (en posición de
    # inicio).
    r = sqrt(pow(p0[0], 2) + pow(p0[1], 2))
    S[0] = atan(p0[1]/p0[0])
    S[4] = -S[0]
    S[5] = -1000
    phi1, phi2, phi3, phi4 = verticalMove(r, 50) # Falta cambiar la alura.
    S[1] = phi1
    S[2] = phi2

    moveServos(S)
    printServosAngles(S)

    # Cerrar pinza para coger pieza.
    S[5] = 1000
    moveServos(S)
    printServosAngles(S)

    # Mover la pieza hasta la posición final. El brazo se moverá a una altura de
    # 50 mm.
    r = sqrt(pow(pf[0], 2) + pow(pf[1], 2))
    S[0] = atan(pf[1]/pf[0])
    S[4] = -S[0]
    phi1, phi2, phi3, phi4 = verticalMove(r, 50)
    S[1] = phi1
    S[2] = phi2

    moveServos(S)
    printServosAngles(S)

    # Bajar pinza sobre posición final.
    phi1, phi2, phi3, phi4 = verticalMove(r, 30)
    S[1] = phi1
    S[2] = phi2

    moveServos(S)
    printServosAngles(S)

    # Soltar pieza en la posición final.
    S[5] = -1000
    moveServos(S)
    printServosAngles(S)

    # Dejar el brazo en posición por defecto para permitir ver el tablero.
    reset_servos()
    printServosAngles(S)


def movePiece(i, j, tipo):
    """
    Posiciona una pieza (de un tipo) en una posición concreta del tablero.
    """
    if tipo == "X":
        tipo = 0
    else:
        tipo = 1

    print("%.2f" % V[tipo][U[tipo]][0], end = ",")
    print("%.2f" % V[tipo][U[tipo]][1], end = ",")
    print("%.2f" % tablero[i][j][0], end = ",")
    print("%.2f" % tablero[i][j][1], end = ",")

    movePieceFromTo(V[tipo][U[tipo]], tablero[i][j])
    U[tipo] += 1

    print(i, end =",")
    print(j, end =",")
