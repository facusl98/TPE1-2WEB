<?php
    include_once 'app/models/peli.model.php';
    include_once 'app/views/peli.view.php';

    

class PeliController{
    private $model;
    private $view;

    function __construct($res){
        $this->model = new PeliModel();
        $this->view = new PeliView($res->usuario);


    }

    function showPelis(){
        $pelis = $this->model->getPelis();


        return $this->view->showPelis($pelis);


    }


    function addPeli(){
    
        $name = $_POST['name'];
        $director = $_POST['director'];
        $date = $_POST['date'];
    
        $this->model->insertPelis($name, $director, $date);
    
        header('Location: ' . BASE_URL);
    
    
    
    }


    function removePeli($id){
        $this->model->deletePeli($id);
        
        header('Location: ' . BASE_URL);
    
    
    }

    function editarPeli($id){
        $this->view->showEditForm($id); 
    }

    function updatePeli() {
        // Obtener los datos del formulario
        $id = $_POST['id_peliculas']; 
        $nombre = $_POST['nombre'];
        $director = $_POST['director'];
        $fecha_estreno = $_POST['fecha_estreno'];

        // Llamo al modelo para actualizar la película
        $this->model->editarPeli($id, $nombre, $director, $fecha_estreno);

        
        header('Location: ' . BASE_URL);
    }


}


