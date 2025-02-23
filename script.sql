CREATE DATABASE personaj_db;

USE persona5_db;

CREATE TABLE PersonaJ (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    arcano_id INT NOT NULL,
    nivel_afinidad INT NOT NULL,
    FOREIGN KEY (arcano_id) REFERENCES Arcanos(id)
);



CREATE TABLE Arcanos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE,
    imagen_arcano VARCHAR(100) NOT NULL
);


INSERT INTO Arcanos (nombre, imagen_arcano) VALUES
('El Loco', 'loco.jpg'),
('El Mago', 'mago.jpg'),
('La Sacerdotisa', 'sacerdotisa.jpg'),
('La Emperatriz', 'emperatriz.jpg'),
('El Emperador', 'emperador.jpg'),
('El Hierofante', 'hierofante.jpg'),
('Los Enamorados', 'enamorados.jpg'),
('El Carro', 'carro.jpg'),
('La Justicia', 'justicia.jpg'),
('El Ermitaño', 'ermitaño.jpg'),
('La Rueda de la Fortuna', 'rueda_fortuna.jpg'),
('La Fuerza', 'fuerza.jpg'),
('El Colgado', 'colgado.jpg'),
('La Muerte', 'muerte.jpg'),
('La Templanza', 'templanza.jpg'),
('El Diablo', 'diablo.jpg'),
('La Torre', 'torre.jpg'),
('La Estrella', 'estrella.jpg'),
('La Luna', 'luna.jpg'),
('El Sol', 'sol.jpg'),
('El Juicio', 'juicio.jpg'),
('El Mundo', 'mundo.jpg');