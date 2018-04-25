#!/bin/bash

mkdir -p -m 0700 /extract

while read LINE; do 
if [[ $LINE == "Usuario:"* ]]; then
	USER=$(echo $LINE| cut -d':' -f 2)
	echo "$USER"
fi
if [[ $LINE == "Central:"* ]]; then
	CENTRAL=$(echo $(echo $LINE| cut -d':' -f 2) | sed 's/ /\_/g')
	echo "$CENTRAL"
	mkdir -p -m 666 /extract/$CENTRAL
	mv /home/$USER/workdir/* /extract/$CENTRAL
	chmod -R 777 /extract	
	rm -f /home/$USER/filecheck
fi	
done < /var/www/html/JSON/Main.conf
