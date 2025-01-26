<?php

class PeliView{

    private $usuario = null;

    public function __construct($usuario){
        $this->usuario = $usuario;
    }



    
    function showPelis($pelis){
        require 'templates/layout/header.phtml';
    
    
        require 'templates/form_alta_pelicula.phtml';
    
    
        require 'templates/lista_peliculas.phtml';
        
    
    }

    function showEditForm($id){
        require 'templates/layout/header.phtml';
        require 'templates/form_edit_peli.phtml';
    }



}