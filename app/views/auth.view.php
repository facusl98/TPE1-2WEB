<?php

class AuthView {
    private $usuario = null;

    public function showLogin($error = '') {
        require 'templates/form_login.phtml';
    }
}
