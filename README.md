# rest_client

#Bajamos la imagen
docker pull php:7.4-cli

#Ejecutamos los scrips arrancando el contenedor $PWD seria donde esta el codigo fuente.

docker run -it --rm --network=host --name my-running-script -v "$PWD":/usr/src/myapp -w /usr/src/myapp php:7.4-cli php client.php  “Nombre de archivo”

