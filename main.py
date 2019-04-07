import cfg
from estrategia import actualiza, move
from basic import game_end


def printMatrix(M):
    for i in range(3):
        for j in range(3):
            if (j < 2):
                if (M[i][j]== 0): print("O", end=' ')
                elif (M[i][j] == 1): print("X", end=' ')
                else: print(".", end=' ')

            else:
                if (M[i][j]== 0): print("O")
                elif (M[i][j] == 1): print("X")
                else: print(".")
    print()


# Bucle principal del juego.
for i in range(9):
    if (game_end(cfg.board)):
        if (i%2 == 0): print("GANA LA MÁQUINA")
        else: print("GANAN LOS HUMANOS")
        break
    if (i%2 == 0):
        print("-"*80 + "\n" + " "*25 + "NUEVO MOVIMIENTO  - no", i + 1, "-\n" + "-"*80)
        print("Así está actualmente el tablero: ")
        printMatrix(cfg.board)
        print("\nTurno humano\n" + "-"*20)
        print ("Introduce tu casilla: ")
        x=input() # El input debe ser: "1 2" x espacio, y (donde 0<=x,y<=2)
        i=int(x[0])
        j=int(x[2])
        while (i < 0 or i >= 3 or j < 0 or j >= 3 or cfg.board[i][j] != -3):
            print("Humano: Vuelve a introducir tu casilla")
            x=input()
            i=int(x[0])
            j=int(x[2])
        actualiza(i, j)
        print("Así ha quedado el tablero:")
        printMatrix(cfg.board)
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
