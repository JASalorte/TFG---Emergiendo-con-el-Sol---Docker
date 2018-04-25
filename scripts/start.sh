#!/bin/bash
if [ ! -f /home/admin/installation-complete ]; then

#Generamos contrañas y las guardamos en el directorio de admin por si se necesitan consultar
MYSQL_PASSWORD=`pwgen -c -n -1 12`
MYSQL_MANAGER_PASSWORD=`pwgen -c -n -1 12`
ADMIN_PASSWORD=`pwgen -c -n -1 12`
ROOT_PASSWORD=`pwgen -c -n -1 12`

echo mysql root password: $MYSQL_PASSWORD
echo mysql root password: $MYSQL_PASSWORD >> /home/admin/pw.txt
echo mysql manager password: $MYSQL_MANAGER_PASSWORD
echo mysql manager password: $MYSQL_MANAGER_PASSWORD >> /home/admin/pw.txt
echo web admin password: $ADMIN_PASSWORD
echo web admin password: $ADMIN_PASSWORD >> /home/admin/pw.txt
echo "root:$ROOT_PASSWORD" | chpasswd 
echo root password: $ROOT_PASSWORD
echo root password: $ROOT_PASSWORD >> /home/admin/pw.txt

#Inicialización para la base de datos
/usr/bin/mysql_install_db > /dev/null
chown -R mysql:mysql /var/lib/mysql
mysqld_safe &
sleep 10s

#Creamos el usuario que controlará la base de datos
mysqladmin -u root password $MYSQL_PASSWORD
mysql -u root --password=$MYSQL_PASSWORD -e "CREATE DATABASE EmergiendoConElSol;
 CREATE USER 'gestor'@'localhost' IDENTIFIED BY '$MYSQL_MANAGER_PASSWORD';
 GRANT INSERT, SELECT, DELETE ON EmergiendoConElSol.* TO 'gestor'@'localhost';
 FLUSH PRIVILEGES;" 

#Creamos las tablas que utilizará el proyecto Emergiendo con el Sol y añadimos un administrador para la página web
mysql -u root --password=$MYSQL_PASSWORD EmergiendoConElSol < mysqlScripts.sql
mysql -u root --password=$MYSQL_PASSWORD EmergiendoConElSol -e "INSERT INTO users (username, password) VALUES ('admin', SHA1('$ADMIN_PASSWORD'))"

sed -i '/$dbname/c $dbname = "EmergiendoConElSol";' /var/www/html/mysqlData.php
sed -i '/$username/c $username = "gestor";' /var/www/html/mysqlData.php
sed -i '/$password/c $password = "'$MYSQL_MANAGER_PASSWORD'";' /var/www/html/mysqlData.php

pkill mysql
sleep 5s

#Preparación y compilación del programa que se encarga de actualizar la base de datos
sed -i '/*password = ""/c	char *password = "'$MYSQL_MANAGER_PASSWORD'";' /home/admin/Central/main.cpp
g++ -o /home/admin/Central/pro $(mysql_config --cflags) /home/admin/Central/main.cpp $(mysql_config --libs) > /dev/null
chmod 777 /home/admin/Central/pro

touch /home/admin/installation-complete

fi

PUBLIC_IP=`curl ipinfo.io/ip`

#Configuración para el correcto funcionamiento del servidor SSH
rm -f /home/admin/Installer/Base/keys/known_hosts
cat /etc/ssh/ssh_host_rsa_key.pub >> /home/admin/Installer/Base/keys/known_hosts
sed -i "1s/^/[$PUBLIC_IP]:$SSHPORT /" /home/admin/Installer/Base/keys/known_hosts
sed -i "s/ root.*//g" /home/admin/Installer/Base/keys/known_hosts

#DEBUG
#cat /etc/ssh/ssh_host_rsa_key.pub >> /home/admin/Installer/Base/keys/known_hosts
#sed -i "2s/^/[192.168.1.130]:$SSHPORT /" /home/admin/Installer/Base/keys/known_hosts
#sed -i "s/ root.*//g" /home/admin/Installer/Base/keys/known_hosts

sed -i '/Host:/c Host:'$PUBLIC_IP /var/www/html/JSON/Main.conf
sed -i '/Port:/c Port:'$SSHPORT /var/www/html/JSON/Main.conf

echo Installing NSIS...
python /home/admin/scons-3.0.0/setup.py install > /dev/null
cd /home/admin/nsis/nsis-3.03-src.tar.bz2/nsis-3.03-src
scons SKIPSTUBS=all SKIPPLUGINS=all SKIPUTILS=all SKIPMISC=all NSIS_CONFIG_CONST_DATA_PATH=no PREFIX=/home/admin/nsis/nsis-3.03/Bin install-compiler > /dev/null
chmod 777 -R /home/admin/nsis
ln -s /home/admin/nsis/nsis-3.03/Bin/makensis /usr/bin/makensis

supervisord -n
#bin/bash
