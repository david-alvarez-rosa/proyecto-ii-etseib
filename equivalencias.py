"""
Diferentes funciones para aplicar simetrías y para comprobar si dos tableros
son equivalentes.

-> Ahora mismo no se miran giros, no hacen falta, pero podrían ser necesarios
   en un futuro. <-
"""


def simetria(boardP, sim):
    """
    Realiza la sim-ésima simetría al tablero.
    Las simetrías están numeradas en sentido horario comenzando por las 12:00.
    Casos especiales:
        * -1: si coinciden.
        * -2: si la simetría no existe.
    """
    boardC = []
    for i in range(3):
        boardC.append(list(boardP[i]))

    if sim == 0:
        for i in range(3):
            boardC[i][0], boardC[i][2] = boardC[i][2], boardC[i][0]
        return boardC

    if sim == 1:
        boardC[0][0], boardC[2][2] = boardC[2][2], boardC[0][0]
        boardC[0][1], boardC[1][2] = boardC[1][2], boardC[0][1]
        boardC[1][0], boardC[2][1] = boardC[2][1], boardC[1][0]
        return boardC

    if sim == 2:
        for j in range(3):
            boardC[0][j], boardC[2][j] = boardC[2][j], boardC[0][j]
        return boardC

    if sim == 3:
        boardC[0][1], boardC[1][0] = boardC[1][0], boardC[0][1]
        boardC[0][2], boardC[2][0] = boardC[2][0], boardC[0][2]
        boardC[1][2], boardC[2][1] = boardC[2][1], boardC[1][2]
        return boardC

    if sim == -1:
        return boardC

    return -2


def simetriaMultiple(boardP, sims):
    """
    Realiza múltiples simetrías.
    """
    boardC = []
    for i in range(3):
        boardC.append(list(boardP[i]))

    for sim in sims:
        boardC = simetria(boardC, sim)

    return boardC


def simetriaMultipleInversa(boardP, sims):
    """
    Realiza la inversa de una simetría múltiple.
    """
    boardC = []
    for i in range(3):
        boardC.append(list(boardP[i]))

    for i in range(len(sims)):
        boardC = simetria(boardC, sims[len(sims) - i - 1])

    return boardC


def equivalente(boardA, boardB):
    """
    Comprueba si los dos tableros son equivalente y devuelve el número de la
    simetría que convierte A en B.
    Las simetrías están numeradas en sentido horario comenzando por las 12:00.
    """
    for sim in range(-1, 4):
        boardSim = simetria(boardA, sim)
        if boardSim == boardB:
            return sim

    return -2
