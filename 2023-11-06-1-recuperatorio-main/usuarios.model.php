<?php

class UsuariosModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tickeya;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todas las tareas.
     */
    function get($id) {
        $query = $this->db->prepare('SELECT * FROM Usuarios WHERE id = ?');
        $query->execute([$id]);

        // $tasks es un arreglo de tareas
        $usuario = $query->fetch(PDO::FETCH_OBJ);

        return $usuario;
    }
}