<?php

class EventosModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tickeya;charset=utf8', 'root', '');
    }

    /**
     * Obtiene y devuelve de la base de datos todas las tareas.
     */
    function get($id) {
        $query = $this->db->prepare('SELECT * FROM Eventos WHERE id = ?');
        $query->execute([$id]);

        // $tasks es un arreglo de tareas
        $evento = $query->fetch(PDO::FETCH_OBJ);

        return $evento;
    }


    function restarEntradas($id, $cant_entradas) {    
        $query = $this->db->prepare('UPDATE Eventos SET entradas_restantes = entradas_restantes - ? WHERE id = ?');
        return $query->execute([$cant_entradas, $id]);
    }
}