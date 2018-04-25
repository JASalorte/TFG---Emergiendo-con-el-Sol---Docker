# Puesta en marcha del proyecto Emergiendo con el Sol en Docker

## Instalación

### Instalación de Docker

Para la creación de la versión Docker del proyecto se ha utilizado la [Community Edition de Docker](https://www.docker.com/community-edition) siguiendo para su instalación la siguiente [guía](https://docs.docker.com/install/).

Podemos comprobar que nuestra instalación de nuestro Docker es correcta mediante el siguiente comando:

~~~bash
docker run hello-world
~~~

Si Docker se descarga la imagen de Hello World y nos muestra un mensaje de bienvenida sabremos que Docker está instalado correctamente.

### Ejecutar el contenedor de Emergiendo con el Sol

Para ello nos situamos en el directorio donde está el archivo Dockerfile y ejecutamos el siguiente comando

~~~bash
docker build . -t emergiendoconelsol 
~~~

Con esto Docker compilará la imagen descrita en el Dockerfile y la convertirá en el contenedor llamado "emergiendoconelsol". Una vez compilado el contenedor simplemente tenemos que ejecutarlo con las siguientes opciones:

~~~bash
docker run --restart always -v PEceS-db:/var/lib/mysql -v PEceS-home:/home -v PEceS-html:/var/www/html -v PEceS-etc:/etc -p XX:22 -p YY:80 -e SSHPORT="XX" emergiendoconelsol
~~~

Como el comando es extenso vamos a comentarlo por partes:

+ --restart always 

	Este parámetro hace que el contenedor se inicie si el contenedor se detiene por cualquier razón. Con esto aunque el servidor que esté ejecutando el contenedor se reinicie, volverá a iniciarse cuando el servidor haya completado su reinicio.

+ -v PEceS-db:/var/lib/mysql -v PEceS-home:/home -v PEceS-html:/var/www/html/JSON -v PEceS-etc:/etc

	-v Se refiera a los volúmenes que el contenedor utiliza ya que los datos son volátiles dentro del contenedor si no están en un volumen. Los nombres PEceS-XX son arbitrarios y se pueden cambiar a gusto, pero en caso de querer trasladar el contenedor sin pérdida de datos hay que conocer estos volúmenes para trasladarlos también.
	
+ -p XX:22 -p YY:80

	Estos parámetros son los que se encargan de redireccionar los puertos, el puerto 22 es para el SSH y el 80 para el servicio web. Esto hará que las peticiones SSH al puerto XX de nuestro servidor lleven a nuestro contenedor por el puerto 22 (que es donde está escuchando el servidor SSH en el contenedor). Similar con el puerto YY al puerto 80 del contenedor. Si se quieren usar los puertos estándares borrar estos parámetros.
	
+ SSHPORT="XX"

	Aquí simplemente tenemos que ponerle el mismo puerto de redirección para el puerto SSH que hemos usado en el parámetro anterior. i se quieren usar los puertos estándares, sustituir XX por 22.
	
+ emergiendoconelsol

	Por último se coloca el nombre de la imagen que se va a utilizar para ejecutar el contenedor, que es la imagen que acabamos de compilar.
	
Si se ejecuta tal cual el comando veremos la salida de como el contenedor se va desplegando y nos mostrará contraseñas relevantes, la cual las más importantes son las del usuario root y la del administrador web, que deberemos apuntar. También podemos ejecutar el contenedor con el parámetro -d que no mostrará esta información, pero tenemos otras formas de saber las contraseñas. Para eso ejecutamos el siguiente comando:

~~~bash
docker cp <IDContenedor>:/home/admin/pw.txt /DirectorioDelHost
~~~
	
Donde para saber la IDContenedor simplemente listamos los contenedores en ejecución y buscamos la ID del contenedor asociado con la imagen "emergiendoconelsol". 
	
~~~bash
docker ps
~~~

Una vez hayamos, o bien apuntado las contraseñas o copiado el archivo pw.txt es recomendable borrar el archivo pw.txt del contenedor.

~~~bash
docker exec <IDContenedor> rm -f /home/admin/pw.txt
~~~

## Administrar la página web

Para administrarla correctamente seguir los pasos en la [documentación del proyecto Emergiendo con el Sol](Documentación%20-%20Emergiendo%20con%20el%20Sol.pdf). Para lo que necesitaremos una cuenta de administrador, por lo que se ha creado ya una, con el nombre de usuario: "admin" y la contraseña se consigue siguiendo los pasos anteriormente. Una vez habiendo accedido con ese usuario se puede crear otras cuentas con nombres y contraseñas según convenga. 

## Operaciones relacionadas con el contenedor

### Traslado del contenedor

	En caso de querer trasladar el contenedor a otro servidor simplemente tenemos que volver a instalar todo el contenedor como hemos visto anteriormente pero esta vez antes de ejecutarlo tendremos que ponerle los volúmenes de los cuales habremos hecho un backup previamente. Para más información sobre los volúmenes de docker dejo la documentación [aquí](https://docs.docker.com/engine/reference/commandline/volume_inspect/#parent-command).
	
	Como un ejemplo de uso podemos usar el siguiente comando, donde por cada volumen de docker nos enseña datos del mismo, entre ellos donde está guardado en el disco duro, que sería lo que tendremos que guardar para después instalar en el otro servidor. La instalación de los volúmenes depende del sistema operativo, así que diríjase a la documentación para más información.
	
~~~bash
docker volume inspect $(docker volume ls -q)
~~~

Pero una vez trasladado el servidor, las centrales no se podrán conectar al nuevo servidor porque su conexión habrá cambiado. Por lo que tenemos que usar este comando para borrar todos los datos de las centrales anteriores para que se generen automáticamente los nuevos:
	
~~~bash
docker exec <IDContenedor> rm -f /var/www/Installer/*
~~~ 

Pasado un tiempo los clientes de las centrales se regeneraran con los nuevos datos, y los antiguos clientes deberán ser desinstalados y instalar estos en su lugar.

### Cambio de puertos

En el caso de querer cambiar el puerto del servidor, tanto el SSH o el HTML simplemente habría que volver ejecutar el contenedor cambiando el parámetros -p respectivo y después reiniciando los clientes como se ha explicado en el punto anterior.
	
### Cambio de IP

Simplemente tenemos que ejecutar el contenedor y después reiniciar los clientes como ya hemos visto.

## Mantenimiento

La base de datos se alimenta de los archivos que va recibiendo el servidor, lo que puede hacer que el contenedor vaya aumentando su tamaño considerablemente con el tiempo, más en concreto, sus volúmenes. Para saber el tamaño que ocupa nuestro contenedor usamos el siguiente comando:

~~~bash
docker system df -v
~~~ 

Buscamos el tamaño del volumen "home" (o el nombre que le hayamos puesto) y si se pasa de unos límites que consideremos aceptables, deberíamos pasar los archivos a un almacenamiento externo, para ello solo tendremos que ejecutar este script que se encuentra en el mismo directorio que el Dockerfile.

~~~bash
./BackupFiles.sh IDContenedor /DirectorioDelHostDondeSeGuardaránLosDatos
~~~ 



