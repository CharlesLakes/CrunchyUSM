# CrunchyUSM

## Datos Alumno

Nombre: Carlos Lagos Cortés

ROL: 202073571-9

## Requerimientos

- Instalar PHP (en este caso se uso PHP7)
- Permitir la subida de archvos minimo 1G
- Instalar POSTGRESS
- Instalar las dependencias necesarias para usar postgress en PHP
- Instalar apache (opcional si solo es para pruebas)

## Modo de ejecución de para pruebas

Para ejecutar sin Apache se debe ingresar a la carpeta src y usar el siguiente comando:

```
php -S 0.0.0.0:80
```

o si quieres detallar la ip y puerto:

```
php -S ip:port
```

## Modo de ejecución para apache

Al ejecutarlo en apache se tiene que tener en cuenta que nuestro htaccess seria la carpeta src. Entonces al subirlo al server los archivos externos al htaccess deben estar en la misma carpeta que este aunque no se puedan acceder desde el servidor web. Tambien se podria cambiar la ruta del htaccess confiurado para que mas ordenado.

Si se quiere cambiar esto se tendran que configurar las rutas una por una de los archivos.

## Tablas sql y datos prueba

En la carpeta sql se pueden observar todos los documentos necesarios para el funcionamiento de nuestra base de datos.
Ademas el archivo "datos_de_prueba.sql" tiene datos de animes de prueba.
