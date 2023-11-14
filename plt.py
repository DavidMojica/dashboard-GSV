import matplotlib.pyplot as plt
import numpy as np

# Definir la ecuación
def ecuacion(x):
    return (2/7) - 3 * x+x

# Generar valores x
x_values = np.linspace(-5, 5, 100)  # genera 100 puntos en el rango de -5 a 5

# Calcular los valores y correspondientes
y_values = ecuacion(x_values)

# Crear la gráfica
plt.plot(x_values, y_values, label='y = (2/7) - 2x')

# Agregar etiquetas y título
plt.xlabel('x')
plt.ylabel('y')
plt.title('Gráfica de la ecuación y = (2/7) - 2x')
plt.grid(True)
plt.axhline(0, color='black',linewidth=0.5)
plt.axvline(0, color='black',linewidth=0.5)

# Mostrar la leyenda
plt.legend()

# Mostrar la gráfica
plt.show()
