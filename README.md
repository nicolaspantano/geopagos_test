# Proyecto Torneo de Tenis - Geopagos

Este proyecto simula un torneo de tenis, permitiendo registrar jugadores, torneos, y partidos utilizando **PHP** y **Eloquent ORM**. Además, se implementa una API REST para manejar las operaciones principales. El proyecto está configurado para correr en **Docker**.

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