<?php

class ClienteModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
    }


    public function getCliente($id_cliente)
    {
        $query = $this->db->prepare('SELECT * FROM cliente WHERE id = ?');
        $query->execute([$id_cliente]);
        return $query->fetch(PDO::FETCH_OBJ);
    }
}
