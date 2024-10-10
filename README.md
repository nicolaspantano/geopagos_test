# Proyecto Torneo de Tenis - Geopagos

Este proyecto simula un torneo de tenis, permitiendo registrar jugadores, torneos, y partidos utilizando **PHP** y **Eloquent ORM**. Además, se implementa una API REST para manejar las operaciones principales. El proyecto está configurado para correr en **Docker** y contiene un archivo json para importar en **Postman** y poder probar los endpoints.

## Requisitos

- **Docker**: Asegúrate de tener Docker instalado en tu sistema para ejecutar el contenedor.
- **PHP 8.1** o superior.
- **MySQL**  como base de datos.

## Instalación

### Clonar el repositorio

```bash
git clone https://github.com/nicolaspantano/geopagos_test.git
cd geopagos_test
```

### Configurar archivo .env
Para simplificar la revisiòn del challenge, el archivo .env no fue includio en el acrhivo .gitignore, por lo tanto no es necesario configurarlo.

### Iniciar contenedores
```bash
docker-compose up -d
```
## Endpoints de la API
    
### Listar torneos
#### Ruta: /torneos -  Método: GET

Descripción: Devuelve una lista de torneos, con posibilidad de aplicar filtros como fecha, tipo o ganador.

#### Parámetros opcionales:

+ fecha (formato yyyy-mm-dd)
+ tipo (Masculino / Femenino)
+ ganador (Id del ganador)

### Jugar torneo
#### Ruta: /torneos/jugar -  Método: POST

#### Parametro requerido:
+ jugadores: Cadena JSON que contiene los datos de los jugadores.
Descripción: Con base a una lista de jugadores en formato JSON, retorna el ganador del torneo. Dentro del repositorio se encuentran dos archivos .json con ejemplos de torneos masculinos y femeninos.

## Comentarios

### Posibles mejoras
+ Pruebas unitarias y estructura del repositorio. El objetivo era tener una estructura similar a la siguiente
```bash
/geopagos_test
├── tests/
├── src/
│composer.json
│Dockerfile
│docker-compose.json
```

Dentro de la carpeta test irian las pruebas unitarias, y la carpeta src tiene que contener el codigo del proyecto.

Al momento de llevar esto adelante, me vi enfrentado a algunas complicaciones relacionadas con la configuracion del proyecto y los contenedores, en donde las rutas no estaban siendo encontradas. Luego de dedicar cierto tiempo a intentar resolver esto, decidi no incluirlo en el repositorio para poder cumplir con el plazo estimado, ademas de que tampoco tengo experiencia profesional realizando pruebas unitarias por lo tanto no estoy seguro de cuanto tiempo me iba a llevar. Sin embario, me parece prudente dejar en claro la idea original acerca de la estructura del repositorio.