<?php

class HistoriaModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
    }

    public function getTratamientosMascota($id_mascota, $fecha)
    {
        $query = $this->db->prepare('SELECT * FROM historia WHERE id_mascota = ? AND fecha = ? ');
        $query->execute([$id_mascota, $fecha]);
        return $query->fetch(PDO::FETCH_OBJ); // debería traer una sola fila porque permite una historia clínca por mascota en esa fecha
    }

    public function addHistoryRecord($fecha, $peso, $tratamiento, $notas, $id_mascota)
    {
        $query = $this->db->prepare('INSERT INTO historia (fecha, peso, tratamiento, notas, id_mascota) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$fecha, $peso, $tratamiento, $notas, $id_mascota]);
        $id = $this->db->lastInsertId();
        return $id;
    }
}
