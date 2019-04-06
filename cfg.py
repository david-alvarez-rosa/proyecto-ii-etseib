"""
Usado únicamente para poder acceder a las variables de manera global entre
módulos.
"""

# Árbol de decisiones: 3 ramas con los nodos en orden y 3 vectores de conexiones
# entre nodos.
rama1 = [
    [0, 0],
    [1, 1],
    [0, 1], [0, 2], [1, 2], [2, 2],
    "EB", "EB", [2, 1], [0, 1],
    "EB", "EB"
]
conex1 = [
    [1], [2, 3, 4, 5], [6], [7], [8], [9], [], [], [10], [11], [], []
]
rama2 = [
    [1, 1],
    [0, 0],
    [0, 1], [0, 2], [1, 2], [2, 2],
    "EB", "EB", "EB", [0, 2],
    "EB"
]
conex2 = [
    [1], [2, 3, 4, 5], [6], [7], [8], [9], [], [], [], [10], []
]
rama3 = [
    # Falta
]
conex3 = [
    # Falta
]


# Conjunto de ramas y de conexiones.
ramas = [rama1, rama2, rama3]
conex = [conex1, conex2, conex3]


# Tableros inicializados como vacíos.
board = [
    [-3, -3, -3],
    [-3, -3, -3],
    [-3, -3, -3]
]
boardInt = [
    [-3, -3, -3],
    [-3, -3, -3],
    [-3, -3, -3]
]


# La lista sims es de simetrías y eb es estrategia básica.
rama = -1
nodo = -1
sims = []
eb = False
