<?php
class PuntuacionModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_films;charset=utf8', 'root', '');
    }

    public function getPuntaje() {
        // Hago un JOIN entre las tablas puntuaciones y peliculas para obtener el nombre de la película
        $query = $this->db->prepare('
            SELECT p.*, pel.nombre AS nombre_pelicula 
            FROM puntuaciones p
            JOIN peliculas pel ON p.id_pelicula = pel.id_peliculas');
        $query->execute();
    
        // Obtengo los datos en un arreglo de objetos
        $puntajes = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $puntajes;
    }
    


    public function insertPuntaje($puntaje, $emp, $id_pel){
        $query = $this->db->prepare('INSERT INTO puntuaciones(valoracion, empresa, id_pelicula) VALUES (?, ?, ?)');
        $query->execute([$puntaje, $emp, $id_pel]);


    }

    function getPuntajesId($id){

        $query = $this->db->prepare('SELECT * FROM puntuaciones WHERE id_pelicula = ?');
        $query->execute([$id]);

        $puntuaciones = $query->fetchAll(PDO::FETCH_OBJ); 

        return $puntuaciones;

    }


    function getNombrePeliPuntuada($id){
        $query = $this->db->prepare('
        SELECT p.nombre 
        FROM peliculas p
        JOIN puntuaciones pu ON p.id_peliculas = pu.id_pelicula
        WHERE pu.id_pelicula = ?');
        $query->execute([$id]);

        $nombrePeli = $query->fetch(PDO::FETCH_OBJ); 

        return $nombrePeli;

    }

    public function deletePuntaje($id){
        $query = $this->db->prepare('DELETE FROM puntuaciones WHERE id_puntuaciones = ?');
        $query->execute([$id]);
    }


    public function getPeliById($id) {
        $query = $this->db->prepare('SELECT * FROM peliculas WHERE id_peliculas = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function editarPuntuacion($id_puntuaciones, $valoracion, $empresa) {
        // Corrige la consulta SQL
        $query = $this->db->prepare('UPDATE puntuaciones SET valoracion = ?, empresa = ? WHERE id_puntuaciones = ?');
        $query->execute([$valoracion, $empresa, $id_puntuaciones]); // Asegúrate de que $id esté al final
    }


}