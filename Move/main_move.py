# from adafruit_servokit import ServoKit
from time import sleep
import sys
sys.path.append("..")
import plano
from tic_tac import cfg
from tic_tac.estrategia import actualiza, move
from tic_tac.basic import game_end
from tic_tac.main import printMatrix
from math import pi, cos, sin, atan, sqrt, pow


# DEFINICION DE VARIABLES

# M1 es un vector con la posición de 4 "X"'s
R1 = 70
R2 = 100
ang1 = 0.9*(pi/2)
ang2 = 0.7*(pi/2)
# V1 = [[R1*cos(ang1), R1*sin(ang1)], [R1*cos(ang2), R1*sin(ang2)], [R2*cos(ang1), R2*sin(ang1)], [R2*cos(ang2), R2*sin(ang2)]]
V1 = [[R1, ang1], [R1, ang2], [R2, ang1], [R2, ang2]] 
# U1 indica si hay pieza en el almacén de "X"'s
#U1 = [1, 1, 1, 1]

# M2 es un vector con la posición de 4 "O"'s
# V1 = [[R1*cos(-ang1), R1*sin(-ang1)], [R1*cos(-ang2), R1*sin(-ang2)], [R2*cos(-ang1), R2*sin(-ang1)], [R2*cos(-ang2), R2*sin(-ang2)]]
V2 = [[R1, -ang1], [R1, -ang2], [R2, -ang1], [R2, -ang2]] 
# U2 indica si hay pieza en el almacén de "O"'s
# U2 = [1, 1, 1, 1]

# Posicion del tablero de casillas ancho_tablero*ancho_tablero (mm²)

ancho_tablero = 50
x_inicial_t = 80

fila_1 = [[x_inicial_t, ancho_tablero], [x_inicial_t + ancho_tablero, ancho_tablero], [x_inicial_t + 2*ancho_tablero, ancho_tablero]]
fila_2 = [[x_inicial_t, 0], [x_inicial_t + ancho_tablero, 0], [x_inicial_t + 2*ancho_tablero, 0]]
fila_3 = [[x_inicial_t, -ancho_tablero], [x_inicial_t + ancho_tablero, -ancho_tablero], [x_inicial_t + 2*ancho_tablero, -ancho_tablero]]

tablero = [fila_1, fila_2, fila_3]

# Servos - Adafruit

kit = ServoKit(channels=16)

# Vector con los ánngulos de los servos
# 0: ROTACION
# 1: BRAZO PRINCIPAL
# 2: BRAZO SECUNDARIO (El que arreglamos)
# 3: NO MUEVE NADA
# 4: PINZA ROTACIÓN
# 5: PINZA APERTURA

S = [0, 0, 0, 0, 0, 0]

# Se actualizará en todo momento para evitar movimientos bruscos

# -----------------------------------------------------------------


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


def convertRadiansToDegrees(phi):
    return (phi* 180)/pi


def reset_servos():
    move(0, 0)
    move(1, 0)
    move(2, 0)
    move(4, 0)
    move(5, 0)

    return 0


def diferencia(M, N):
    for i in range(3):
        for j in range(3):
            if (M[i][j] != N[i][j]):
                return i, j

    return 0, 0


def main():
    reset_servos()
    # Bucle principal del juego.
    for cont in range(9):
        board_aux = cfg.board
        if (game_end(cfg.board)):
            if (cont%2 == 0): print("GANA LA MÁQUINA")
            else: print("GANAN LOS HUMANOS")
            break
        if (cont%2 == 0):
            print("-"*80 + "\n" + " "*25 + "NUEVO MOVIMIENTO  - no", cont + 1, "-\n" + "-"*80)
            print("Así está actualmente el tablero: ")
            printMatrix(cfg.board)
            print("\nTurno humano\n" + "-"*20)
            print ("Introduce tu casilla: ")
            x=input() # El input debe ser: "1 2" x espacio, y (donde 0<=x,y<=2)
            i=int(x[0])
            j=int(x[2])
            while (i < 0 or i >= 3 or j < 0 or j >= 3 or cfg.board[i][j] != -3):
                print("Humano: Vuelve a introducir tu casilla")
                x = input()
                i = int(x[0])
                j = int(x[2])
            
            actualiza(i, j)
            print("Así ha quedado el tablero:")
            printMatrix(cfg.board)

            # ------------- MOVIMIENTO PIEZA -------------

            # Posicionamiento del robot
            r = V1[cont/2][0]
            alpha = convertRadiansToDegrees(V1[cont/2][1])
            move(0, alpha)
            S[0] = alpha
            
            # Movimiento del robot hasta el almacen (dejo un margen de 50 mm. para que la pinza pueda coger la pieza pq nosotros calculamos la posicion del punto P!!! OJO!)

            h = 0
            phi1, phi2, phi3, phi4 = plano.prueba(r, 50, h)
            move(1, phi1)
            S[1] = phi1
            move(2, phi2)
            S[2] = phi2

            # Movimiento pinza para coger la pieza  (despues de coger la pieza deja el punto P a 50 mm. porfavor)
            # Acuerdate de actualizar los angulos de los servos
            
            # ------------- CODIGO DAVID 1 -------------

            # Movimiento hasta el tablero
            mov_x = tablero[i][j][0]
            mov_y = tablero[i][j][1]
            r2 = sqrt(pow(mov_x, 2) + pow(mov_y, 2))
            alpha2 = convertRadiansToDegrees(atan(mov_y/mov_x))
            move(0, alpha2)
            phi1, phi2, phi3, phi4 = plano.prueba(r2, 50, h)
            move(1, phi1)
            S[1] = phi1
            move(2, phi2)
            S[2] = phi2

            # Movimiento pinza para soltar la pieza (la pieza está a 50 mm. de altura --> hay que bajarla verticalmente)
            # Acuerdate de actualizar los angulos de los servos
            
            # ------------- CODIGO DAVID 2 -------------

        else:
            print("\n\nTurno máquina\n" + "-"*20)
            print("Máquina ve internamente: ")
            printMatrix(cfg.boardInt)
            print("Rama: ", cfg.rama)
            print("Nodo: ", cfg.nodo)
            print("Simetrías: ", cfg.sims)
            if cfg.eb:
                print("Estrategia básica: Sí.\n")
            else:
                print("Estrategia básica: No.\n")
            move()
            print("Respuesta máquina internamente: ")
            printMatrix(cfg.boardInt)
            print("Respuesta máquina a humano: ")
            printMatrix(cfg.board)
            print("\n"*10)
            i, j = diferencia(cfg.board, board_aux)

            # ------------- MOVIMIENTO PIEZA -------------

            # Posicionamiento del robot
            r = V2[(cont-1)/2][0]
            alpha = convertRadiansToDegrees(V2[(cont-1)/2][1])
            move(0, alpha)
            S[0] = alpha
            
            # Movimiento del robot hasta el almacen (dejo un margen de 50 mm. para que la pinza pueda coger la pieza pq nosotros calculamos la posicion del punto P!!! OJO!)

            h = 0
            phi1, phi2, phi3, phi4 = plano.prueba(r, 50, h)
            move(1, phi1)
            S[1] = phi1
            move(2, phi2)
            S[2] = phi2

            # Movimiento pinza para coger la pieza  (despues de coger la pieza deja el punto P a 50 mm. porfavor)
            # Acuerdate de actualizar los angulos de los servos
            
            # ------------- CODIGO DAVID 1 -------------

            # Movimiento hasta el tablero
            mov_x = tablero[i][j][0]
            mov_y = tablero[i][j][1]
            r2 = sqrt(pow(mov_x, 2) + pow(mov_y, 2))
            alpha2 = convertRadiansToDegrees(atan(mov_y/mov_x))
            move(0, alpha2)
            phi1, phi2, phi3, phi4 = plano.prueba(r2, 50, h)
            move(1, phi1)
            S[1] = phi1
            move(2, phi2)
            S[2] = phi2
            
            # Movimiento pinza para soltar la pieza (la pieza está a 50 mm. de altura --> hay que bajarla verticalmente)
            # Acuerdate de actualizar los angulos de los servos

            # ------------- CODIGO DAVID 2 -------------

main()

