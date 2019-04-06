"""
Faltaría mejorar la función 'moveBasic'. Cuando no hay ningún momento
especial mueve al azar.
"""


import sys


def game_end(M):
    x0=M[0][0]+M[1][0]+M[2][0]
    x1=M[0][1]+M[1][1]+M[2][1]
    x2=M[0][2]+M[1][2]+M[2][2]
    y0=M[0][0]+M[0][1]+M[0][2]
    y1=M[1][0]+M[1][1]+M[1][2]
    y2=M[2][0]+M[2][1]+M[2][2]
    d1=M[0][0]+M[1][1]+M[2][2]
    d2=M[0][2]+M[1][1]+M[2][0]
    if(x0==0 or x0==3 or x1==0 or x1==3 or x2==0 or x2==3): return 1
    elif(y0==0 or y0==3 or y1==0 or y1==3 or y2==0 or y2==3): return 1
    elif(d1==0 or d1==3 or d2==0 or d2==3): return 1

    return 0


def check_win(M,i,j):
    #Comprobamos posibles jugadas ganadoras
    if (i==0 and j==0):
        if (M[1][0]+M[2][0]==2 or M[0][1]+M[0][2]==2 or M[1][1]+M[2][2]==2): return 1

    elif (i==0 and j==1):
        if (M[0][0]+M[0][2]==2 or M[1][1]+M[2][1]==2): return 1

    elif (i==0 and j==2):
        if (M[0][0]+M[0][1]==2 or M[1][2]+M[2][2]==2 or M[2][0]+M[1][1]==2): return 1

    elif (i==1 and j==0):
        if (M[0][0]+M[2][0]==2 or M[1][1]+M[1][2]==2): return 1

    elif (i==1 and j==1):
        if (M[0][0]+M[2][2]==2 or M[2][0]+M[0][2]==2 or M[0][1]+M[2][1]==2 or M[1][0]+M[1][2]==2): return 1

    elif (i==1 and j==2):
        if (M[1][0]+M[1][1]==2 or M[0][2]+M[2][2]==2): return 1

    elif (i==2 and j==0):
        if (M[2][1]+M[2][2]==2 or M[0][0]+M[1][0]==2 or M[1][1]+M[0][2]==2): return 1

    elif (i==2 and j==1):
        if (M[2][0]+M[2][2]==2 or M[0][1]+M[1][1]==2): return 1

    elif (i==2 and j==2):
        if (M[2][0]+M[2][1]==2 or M[0][2]+M[1][2]==2 or M[0][0]+M[1][1]==2): return 1


    #Comprobamos posibles jaques
    if (i==0 and j==0):
        if (M[1][0]+M[2][0]==0 or M[0][1]+M[0][2]==0 or M[1][1]+M[2][2]==0): return 1

    elif (i==0 and j==1):
        if (M[0][0]+M[0][2]==0 or M[1][1]+M[2][1]==0): return 1

    elif (i==0 and j==2):
        if (M[0][0]+M[0][1]==0 or M[1][2]+M[2][2]==0 or M[2][0]+M[1][1]==0): return 1

    elif (i==1 and j==0):
        if (M[0][0]+M[2][0]==0 or M[1][1]+M[1][2]==0): return 1

    elif (i==1 and j==1):
        if (M[0][0]+M[2][2]==0 or M[2][0]+M[0][2]==0 or M[0][1]+M[2][1]==0 or M[1][0]+M[1][2]==0): return 1

    elif (i==1 and j==2):
        if (M[1][0]+M[1][1]==0 or M[0][2]+M[2][2]==0): return 1

    elif (i==2 and j==0):
        if (M[2][1]+M[2][2]==0 or M[0][0]+M[1][0]==0 or M[1][1]+M[0][2]==0): return 1

    elif (i==2 and j==1):
        if (M[2][0]+M[2][2]==0 or M[0][1]+M[1][1]==0): return 1

    elif (i==2 and j==2):
        if (M[2][0]+M[2][1]==0 or M[0][2]+M[1][2]==0 or M[0][0]+M[1][1]==0): return 1


def move(M):
#Entrada de matriz M 3x3 con 0s (humano), 1s (máquina) y previamiente inicializada en "-3"s (importantente que sea así para que funcione -- por tema sumas de check_win) --> decide una jugada para la máquina (estrategia basic)

    #Compruebo jugadas ganadoras para la máquina
    for i in range(len(M)):
        for j in range(len(M)):
            if(M[i][j] == -3 and check_win(M,i,j)):
                return i,j

    return -1,-1


def moveBasic(M):
    i, j = move(M)
    # Mover al azar si no hay ningún movimiento. Esto se podría mejorar.
    if i == -1:
        for ip in range(3):
            for jp in range(3):
                if M[ip][jp] == -3:
                    M[ip][jp] = 1
                    return
    M[i][j] = 1
