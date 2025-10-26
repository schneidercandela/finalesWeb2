<?php

class HistoriaModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
	}

	public function getByIdMascota($id_mascota)
	{
		$query = $this->db->prepare('SELECT * FROM historia WHERE id_mascota = ?');
		$query->execute([$id_mascota]);
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
}
