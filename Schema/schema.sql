CREATE DATABASE IF NOT EXISTS torneo_de_tenis;

CREATE USER IF NOT EXISTS 'user'@'%' IDENTIFIED BY 'password';

use torneo_de_tenis;

CREATE TABLE IF NOT EXISTS jugadores (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    habilidad INT CHECK (habilidad BETWEEN 0 AND 100),
    genero ENUM('Masculino', 'Femenino') NOT NULL,
    tiempo_de_reaccion INT CHECK (tiempo_de_reaccion BETWEEN 0 AND 10),
    velocidad_de_desplazamiento INT CHECK (velocidad_de_desplazamiento BETWEEN 0 AND 10),
    fuerza INT CHECK (fuerza BETWEEN 0 AND 10)
);

CREATE TABLE IF NOT EXISTS torneos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    tipo ENUM('Masculino', 'Femenino') NOT NULL,
    ganador_id INT,
    fecha DATE DEFAULT (CURRENT_DATE),
    FOREIGN KEY (ganador_id) REFERENCES jugadores(id)
);

CREATE INDEX idx_fecha ON torneos (fecha);
CREATE INDEX idx_ganador_id ON torneos (ganador_id);
CREATE INDEX idx_tipo ON torneos (tipo);

CREATE TABLE IF NOT EXISTS partidos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    torneo_id INT,
    ganador_id INT,
    perdedor_id INT,
    fecha DATE DEFAULT (CURRENT_DATE),
    FOREIGN KEY (torneo_id) REFERENCES torneos(id),
    FOREIGN KEY (ganador_id) REFERENCES jugadores(id),
    FOREIGN KEY (perdedor_id) REFERENCES jugadores(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);