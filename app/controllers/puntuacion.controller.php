<?php
    include_once 'app/models/puntuacion.model.php';
    include_once 'app/views/puntuacion.view.php';
    include_once 'app/models/peli.model.php';

class PuntuacionController{

    private $model;
    private $modelPeli;
    private $view;

    function __construct($res){
        $this->model = new PuntuacionModel();
        $this->modelPeli = new PeliModel();
        $this->view = new PuntuacionView($res->usuario);
    }



    function showPuntajes() {
        // Obtengo todos los puntajes
        $puntajes = $this->model->getPuntaje();

        // Obtiene todas las películas usando el modelo de Pelis
        $peliculas = $this->modelPeli->getPelis();
        
        // Paso los puntajes a la vista para que los muestre
        $this->view->listarPuntajes($puntajes, $peliculas);
        
    }

    

    function verPuntuaciones($id){

        $puntuaciones = $this->model->getPuntajesId($id);
    
    
        $peliPuntuada = $this->model->getNombrePeliPuntuada($id);
    
        $this->view->showPuntajesPeli($peliPuntuada, $puntuaciones);
        
    }

    function addPuntuacion(){
    
        $puntaje = $_POST['valoracion'];
        $emp = $_POST['empresa'];
        $id_pel = $_POST['id_pelicula'];
    
        $this->model->insertPuntaje($puntaje, $emp, $id_pel);
    
        header('Location: ' . BASE_URL);
    
    }
    function removePuntaje($id){
        $this->model->deletePuntaje($id);
        
        header('Location: ' . BASE_URL);
    
    
    }

    function editarPuntaje($id){
        $this->view->showEditForm($id); 
    }

    function updatePuntaje() {
        // Obtener los datos del formulario
        $id = $_POST['id_puntuaciones'];
        $valoracion = $_POST['valoracion'];
        $empresa = $_POST['empresa'];
        // Llamo al modelo para actualizar la película
        $this->model->editarPuntuacion($id, $valoracion, $empresa);

       
        header('Location: ' . BASE_URL);
    }
}