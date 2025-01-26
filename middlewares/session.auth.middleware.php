<?php
    function sessionAuthMiddleware($res) {
        session_start();
        if(isset($_SESSION['ID_USER'])){
            $res->usuario = new stdClass();
            $res->usuario->id_usuario = $_SESSION['ID_USER'];
            $res->usuario->usuario = $_SESSION['USER_NAME'];
            return;
        }
    }
?>