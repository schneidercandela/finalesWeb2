<?php

class MascotaModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
	}

	// obtener datos de la mastoca
	public function getMascota($id)
	{
		$query = $this->db->prepare('SELECT * FROM mascota WHERE id = ?');
		$query->execute([$id]);
		return $query->fetch(PDO::FETCH_OBJ);
	}

	// actualizar peso de la mascota
	public function updateDatosMascota($peso, $id_mascota)
	{
		$query = $this->db->prepare('UPDATE mascota SET ultimo_peso = ? WHERE id_mascota');
		$query->execute([$peso, $id_mascota]);
	}
}
