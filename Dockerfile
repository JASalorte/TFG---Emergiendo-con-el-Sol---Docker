## 
## Instalación del projecto Emergiendo con el Sol para docker basado en CentOS.
##

FROM centos:7

MAINTAINER The CentOS Project <cload-ops@centos.org> Author: Jesús Salazar (salazarcontactinfo@gmail.com)

#############
###	Instalación de paquetes necesarios
#############

RUN yum -y update; yum clean all
#Es necesario para acceder a /etc/sudoers para poner los permisos correctos
RUN yum -y install sudo; yum clean all 
#DEBUG nano no es realmente necesario una vez la aplicación esté acabada, así que eliminarlo cuando no sea necesario
#RUN yum -y install nano; yum clean all
#El servidor de ssh
RUN yum -y install openssh-server; yum clean all
#El servidor web
RUN yum -y install httpd; yum clean all
#PHP para el servicio web
RUN yum -y install php php-mysql; yum clean all
#PWGEN genera passwords aleatorias
RUN yum -y install epel-release; yum clean all
RUN yum -y install pwgen; yum clean all
#La base de datos
RUN yum -y install mariadb-server; yum clean all
RUN yum -y install mariadb; yum clean all
RUN yum -y install mariadb-devel.x86_64; yum clean all
#Instalamos un compilador de C++
RUN yum -y install gcc-c++.x86_64
RUN yum -y install libstdc++-devel.x86_64
RUN yum -y install gcc.x86_64
#Supervisor, lo necesitamos para poder ejecutar más de un servicio en el docker
RUN yum -y install python-setuptools
RUN easy_install pip
RUN pip install supervisor
RUN mkdir /var/log/supervisor

RUN yum -y install zip
RUN yum -y install openssh-clients

#############
###	Configuración del servidor SSH
#############

#El programa se encarga de hacer esto por cada usuario que sea crea
#Simplemente deberiamos bloquear el acceso por contraseña
#Para así proteger el servidor

RUN rm -f /etc/ssh/ssh_host_ecdsa_key /etc/ssh/ssh_host_rsa_key
RUN ssh-keygen -q -N "" -t dsa -f /etc/ssh/ssh_host_ecdsa_key
RUN ssh-keygen -q -N "" -t rsa -f /etc/ssh/ssh_host_rsa_key 


#############
###	Configuración de la Base de datos
#############

ADD ./scripts/mysqlScript.sql /home/admin/mysqlScripts.sql
ADD ./scripts/fix-permissions.sh /fix-permissions.sh
RUN chmod 333 /fix-permissions.sh
RUN ./fix-permissions.sh /var/lib/mysql/   && \
    ./fix-permissions.sh /var/log/mariadb/ && \
    ./fix-permissions.sh /var/run/
RUN chown -R mysql /var/lib/mysql
RUN chgrp -R mysql /var/lib/mysql


#############
###	Configuración inicial de usuarios de CentOS
#############

#RUN echo "root:root" | chpasswd 
#RUN useradd -m admin && echo "admin:admin" | chpasswd
RUN useradd -m admin
RUN echo 'admin ALL=(ALL) NOPASSWD: /usr/sbin/useradd' >> /etc/sudoers.d/admin
RUN echo 'admin ALL=(ALL) NOPASSWD: /bin/ls' >> /etc/sudoers.d/admin
RUN echo 'admin ALL=(ALL) NOPASSWD: /usr/sbin/chmod' >> /etc/sudoers.d/admin
RUN echo 'admin ALL=(ALL) NOPASSWD: /usr/sbin/chgrp' >> /etc/sudoers.d/admin
RUN echo 'admin ALL=(ALL) NOPASSWD: /usr/sbin/chown' >> /etc/sudoers.d/admin
RUN echo 'admin ALL=(ALL) NOPASSWD: /usr/sbin/chown' >> /etc/sudoers.d/admin

#############
###	Copiar archivos necesarios al docker
#############

ADD ./scripts/start.sh /start.sh
ADD ./scripts/run-httpd.sh /run-httpd.sh
RUN chmod 755 /start.sh
RUN chmod 755 /run-httpd.sh

ADD ./configs/supervisord.conf /etc/supervisord.conf

#############
###	Copiar archivos del proyecto Emergiendo con el Sol
#############

ADD ./code/html /var/www/html
RUN chmod 775 -R /var/www/html
RUN chown -R apache:admin /var/www/html
RUN mkdir /var/www/Installer
ADD ./code/Installer /home/admin/Installer
ADD ./code/Central   /home/admin/Central
#RUN chmod 770 -R /home/admin
RUN chown admin:admin -R /home/admin/

ADD ./code/scons-3.0.0 /home/admin/scons-3.0.0
ADD ./code/nsis-3.03 /home/admin/nsis/nsis-3.03
ADD ./code/nsis-3.03-src.tar.bz2 /home/admin/nsis/nsis-3.03-src.tar.bz2
#Borrar los siguientes comandos
#RUN chmod 777 -R /home/admin/nsis
#RUN chmod 777 -R /home/admin/scons-3.0.0


#############
###	Abertura de puertos
#############

EXPOSE 80 22

#############
###	 Iniciar el script start.sh 
#############

ADD ./scripts/extract.sh /home/admin/extract.sh
RUN chmod 666 /home/admin/extract.sh

#db
#home
#html
#etc

VOLUME /var/lib/mysql 
VOLUME /home
VOLUME /var/www/html
VOLUME /etc

CMD ["/bin/bash", "/start.sh"]
