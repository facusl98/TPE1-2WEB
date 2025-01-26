<?php
class PeliModel {
    private $db;

    public function __construct() {
       $this->db = new PDO('mysql:host=localhost;dbname=db_films;charset=utf8', 'root', '');
    }

    public function getPelis() {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM peliculas');
        $query->execute();
    
        // 3. Obtengo los datos en un arreglo de objetos
        $pelis = $query->fetchAll(PDO::FETCH_OBJ); 
    
        return $pelis;
    }


    public function insertPelis($name, $director, $date){
        $query = $this->db->prepare('INSERT INTO peliculas(nombre, director, fecha_estreno) VALUES (?, ?, ?)');
        $query->execute([$name, $director, $date]);


    }


    public function deletePeli($id){

        $query = $this->db->prepare('DELETE FROM peliculas WHERE id_peliculas = ?');
        $query->execute([$id]);
    }

    public function editarPeli($id, $nombre, $director, $fecha_estreno) {

        echo "$id,$nombre llegueeeeeeeeeeeeeeee";
        $query = $this->db->prepare('UPDATE peliculas SET nombre = ?, director = ?, fecha_estreno = ? WHERE id_peliculas = ?');
        $query->execute([$nombre, $director, $fecha_estreno, $id]);
    }
}

