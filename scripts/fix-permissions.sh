#!/bin/sh
#Corrige los permisos del directorio pasado por parámetros para permitir
#Al grupo poder leer/escribir archivos normales y ejecutar directorios

chgrp -R 0 $1
chmod -R g+rw $1
find $1 -type d -exec chmod g+x {} +
