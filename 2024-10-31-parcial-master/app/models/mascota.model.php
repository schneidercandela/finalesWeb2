<?php

class MascotaModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
	}

	// Ejercicio 1 y 2
	public function getMascota($id)
	{
		$query = $this->db->prepare('SELECT * FROM mascota WHERE id = ?');
		$query->execute([$id]);
		return $query->fetch(PDO::FETCH_OBJ);
	}
}
