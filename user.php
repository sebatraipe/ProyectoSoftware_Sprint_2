<?php

class user{

    private $id;
    private $nombre;
    private $apellido;
    private $username;
    private $password;
    private $email;
    private $rol;

    public function __construct($id, $nombre, $apellido, $username, $password, $email, rol $rol)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->rol = $rol;
    }

    public function getId(){
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRol() {
        return $this->rol->getNombre();
    }
}
