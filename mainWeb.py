"""
Es el programa principal para cuando comienza a jugar el usuario, que coordina
la estrategia y el movimiento del brazo robótico.

Se le pasan por parámetros al ejecutarlo el estado de una partida ya comenzada,
entonces:
  1. Posiciona servomotores en posición de inicio.
  2. Mueve (físicamente) la ficha del usuario a la posición seleccionada.
  3. Da una respuesta al tablero (de acuerdo a la dificultad).
  4. Mueve (físicamente) la ficha de respuesta.
  5. Devuelve diferentes datos (entre ellos las próximas url's) para que la
  página web se pueda actualizar. Estos datos se devuelven en una línea y
  separados por comas.
"""

import sys
import estrategia.cfg as cfg
from estrategia.main import actualiza, move
from estrategia.basica import game_end
from estrategia.equivalencias import simetriaMultiple
import movimiento.main
from movimiento.main import movePiece, reset_servos


def board2Str(M):
    """
    Convierte el tablero a string.
    """
    boardStr = ""
    for i in range(3):
        for j in range(3):
            if (M[i][j] == 0):
                boardStr += "O"
            elif (M[i][j] == 1):
                boardStr += "X"
            else:
                boardStr += "."

    return boardStr


def readVariables():
    """
    Leer las variables y guardarlas. Devuelve la última jugada realizada.
    """
    movsStr = sys.argv[1]
    movs = []
    for i in range(int(len(movsStr)/2)):
        movs.append([int(movsStr[2*i]), int(movsStr[2*i + 1])])

    for i in range(len(movs) - 1):
        if i%2 == 0:
            cfg.board[movs[i][0]][movs[i][1]] = 0
        else:
            cfg.board[movs[i][0]][movs[i][1]] = 1

    cfg.rama = int(sys.argv[2])
    cfg.nodo = int(sys.argv[3])
    simsStr = sys.argv[4]
    for i in range(len(simsStr)):
        if simsStr[i] != "-":
            if  i != 0 and simsStr[i - 1] != "-":
                cfg.sims.append(int(simsStr[i]))
            elif i != 0 and simsStr[i - 1] == "-":
                cfg.sims.append(int(simsStr[i-1:i+1]))
            else:
                cfg.sims.append(int(simsStr[i]))

    cfg.boardInt = simetriaMultiple(cfg.board, cfg.sims)

    if sys.argv[5] == "False":
        cfg.eb = False
    else:
        cfg.eb = True

    actualiza(movs[len(movs) - 1][0], movs[len(movs) - 1][1])

    return movs[len(movs) - 1][0], movs[len(movs) - 1][1]


def nextUrl(i, j):
    """
    Crea e imprime la siguiente dirección web. También el tablero.
    """
    url = "&rama=" + str(cfg.rama)
    url += "&nodo=" + str(cfg.nodo)
    url += "&sims="
    for sim in cfg.sims:
        url += str(sim)
    url += "&eb=" + str(cfg.eb)
    url += "&movs=" + sys.argv[1] + str(i) + str(j)

    return url


def printData(i, j):
    """
    Imprime por pantalla diferentes datos.
    """
    data = board2Str(cfg.board) + ","
    data += nextUrl(i, j)
    print(data, end = ",")


# Iniciar los servos.
reset_servos()
# Leer movimiento humano y mover la pieza correspondiente.
i, j = readVariables()
movePiece(i, j, "O")
if game_end(cfg.board) != "User wins":
    # Decidir movimiento respuesta y mover la pieza correspondiente.
    i, j = move()
    # Si se puede hacer movimiento, mover la pieza.
    if i != -1 and j != -1:
        movePiece(i, j, "X")
# Devolver datos necesarios.
printData(i, j)
# Mirar si la partida ha terminado.
print(game_end(cfg.board))
