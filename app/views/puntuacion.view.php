<?php

class PuntuacionView{


    private $usuario = null;

    public function __construct($usuario){
        $this->usuario = $usuario;
    }



    function listarPuntajes($puntajes, $peliculas) {
        require 'templates/form_alta_puntuacion.phtml';
        require 'templates/lista_puntuaciones.phtml';
        require 'templates/layout/footer.phtml';
    }
    



    function showPuntajesPeli($peliPuntuada, $puntuaciones){
        require 'templates/layout/header.phtml';

        if (empty($puntuaciones)) {
            require 'templates/error_sin_puntuacion.phtml';
        } else {
            require 'templates/lista_peli_puntuada.phtml';
        }
        require 'templates/layout/footer.phtml';

    }


    function mostrarFormularioPuntuacion($peliculas){
        require 'templates/form_alta_puntuacion.phtml';

    }

    function showEditForm($id){
        require 'templates/layout/header.phtml';
        require 'templates/form_edit_puntuacion.phtml';
    }

}