#!/bin/bash

IDCONTAINER=$1
SAVEDIRECTORY=$2

CONTAINEREXIST=$(docker ps -q | grep $IDCONTAINER)

if [ "$CONTAINEREXIST" == "" ]; then
	echo El contenedor no existe.
	exit
fi

if [ ! -d "$SAVEDIRECTORY" ]; then
	echo El directorio debe existir.
	exit
fi

if [ ! -r "$SAVEDIRECTORY" ] || [ ! -w "$SAVEDIRECTORY" ]; then
	echo No tenemos permiso para escribir en ese directorio.
	exit
fi

docker exec $IDCONTAINER /home/admin/extract.sh
docker cp $IDCONTAINER:/extract $SAVEDIRECTORY
docker exec $IDCONTAINER rm -rdf /extract

