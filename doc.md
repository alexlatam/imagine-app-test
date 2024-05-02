## ¿Qué es un espacio de color?
Un espacio de color es un modelo tridimensional que describe un conjunto de colores matemáticamente en relación con los demás. 
Los colores se mapean a lo largo de ejes que representan diferentes aspectos del color, como el tono o la saturación. 
Los aspectos mapeados varían según el tipo de espacio de color.

## ¿Qué es el Espacio CIELAB?
El espacio CIELAB (con coordenadas L*,a*,b*) es una reasignación de coordenadas del espacio coincidente XYZ. 
Pretende ser perceptivamente uniforme, lo que significa que la distancia entre los 
colores mapeados corresponde a sus diferencias visuales.

En coordenadas rectangulares, CIELAB expresa los colores según tres valores:

- L*: Luminosidad, de negro (0) a blanco (100)
- a*: Cantidad de verde (-) a rojo (+)
- b*: Cantidad de azul (-) a amarillo (+)

La diferencia CIELAB entre dos colores en estas coordenadas, llamada CIELAB DE, 
es simplemente la raíz _cuadrada euclidiana_ de la suma de los cuadrados de las diferencias de coordenadas.