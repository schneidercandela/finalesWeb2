<?php

class VentasModel {

    public function getByFechaYEvento($fechaCompra, $idEvento) {
        $db = new PDO('mysql:dbname=test;host=localhost', 'root', '');

        $query = $db->prepare("SELECT id, cant_entra FROM ventas WHERE fecha_compra = ? AND id_evento = ?");
        $query->execute([$fechaCompra, $idEvento]);

        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}