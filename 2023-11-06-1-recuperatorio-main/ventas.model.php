<?php

class VentasModel {
    private $db;

    function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=db_tickeya;charset=utf8', 'root', '');
    }

    function create($id_evento, $id_usuario,$cant_entradas, $fecha_compra) {
        $query = $this->db->prepare('INSERT INTO Ventas (id_evento, id_usuario, cant_entradas, fecha_compra) VALUES(?,?,?)');
        $query->execute([$id_evento, $id_usuario,$cant_entradas, $fecha_compra]);

        return $this->db->lastInsertId();
    }

}