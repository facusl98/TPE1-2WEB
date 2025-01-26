<?php
require_once 'config.php';


class UserModel {
    protected $db;

    public function __construct() {
        $this->db = new PDO(
            'mysql:host=' . MYSQL_HOST . ';dbname=' . MYSQL_DB . ';charset=utf8', 
            MYSQL_USER, 
            MYSQL_PASS
        );
       $this->_deploy();
    }
 

    private function _deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables) == 0) {
            $sql =<<<END
CREATE TABLE IF NOT EXISTS `peliculas` (
  `id_peliculas` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `director` varchar(50) NOT NULL,
  `fecha_estreno` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

INSERT INTO `peliculas` (`id_peliculas`, `nombre`, `director`, `fecha_estreno`) VALUES
(6, 'Batman', 'Lautaro', '2024-10-23'),
(8, 'Superman', 'Juan', '2024-10-23'),
(9, 'Iron man', 'Facundo', '2024-10-23'),
(10, 'El hombre araña', 'Rodrigo', '2024-11-07'),
(11, 'Hulk', 'Lautaro', '2024-11-14'),
(12, 'Deadpool', 'Lautaro', '2024-11-20');

CREATE TABLE IF NOT EXISTS `puntuaciones` (
  `id_puntuaciones` int(11) NOT NULL,
  `valoracion` decimal(3,1) NOT NULL,
  `empresa` varchar(20) NOT NULL,
  `id_pelicula` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

INSERT INTO `puntuaciones` (`id_puntuaciones`, `valoracion`, `empresa`, `id_pelicula`) VALUES
(10, 4.0, 'Imdb', 6),
(17, 5.0, 'SensaCine', 12),
(18, 5.0, 'SensaCine', 9),
(19, 2.0, 'Imdb', 11),
(20, 3.0, 'Filmaffinity', 11),
(21, 10.0, 'Filmaffinity', 8),
(22, 9.0, 'Imdb', 9),
(23, 7.0, 'Filmaffinity', 10);

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(100) NOT NULL,
  `password` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_swedish_ci;

INSERT INTO `usuario` (`id_usuario`, `usuario`, `password`) VALUES
(1, 'webadmin', '$2y$10$IYn0jLwmKQUE5icQEzatv./P5VdzCL37MbxvhA6d94IAF76HYD7jK');

-- Añadir índices y claves foráneas
ALTER TABLE `peliculas`
  ADD PRIMARY KEY (`id_peliculas`);

ALTER TABLE `puntuaciones`
  ADD PRIMARY KEY (`id_puntuaciones`),
  ADD KEY `FKpelicula` (`id_pelicula`);

ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

-- Configurar AUTO_INCREMENT
ALTER TABLE `peliculas`
  MODIFY `id_peliculas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

ALTER TABLE `puntuaciones`
  MODIFY `id_puntuaciones` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

-- Añadir restricciones
ALTER TABLE `puntuaciones`
  ADD CONSTRAINT `puntuaciones_ibfk_1` FOREIGN KEY (`id_pelicula`) REFERENCES `peliculas` (`id_peliculas`) ON DELETE CASCADE ON UPDATE CASCADE;
END;

$this->db->exec($sql);

}
}


    public function getUserByUserName($userName) {    
        $query = $this->db->prepare("SELECT * FROM usuario WHERE usuario = ?");
        $query->execute([$userName]);
    
        $usuario = $query->fetch(PDO::FETCH_OBJ);
    
        return $usuario;
    }
}