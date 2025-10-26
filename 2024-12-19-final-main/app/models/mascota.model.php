<?php

class MascotaModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
	}

	public function get($id)
	{
		$query = $this->db->prepare('SELECT * FROM mascota WHERE id = ?');
		$query->execute([$id]);
		return $query->fetch(PDO::FETCH_OBJ);
	}

	public function delete($id)
	{
		$query = $this->db->prepare('DELETE FROM mascota WHERE id = ?');
		$query->execute([$id]);
	}

	public function getByIdCliente($id_cliente)
	{
		$query = $this->db->prepare('SELECT * FROM mascota WHERE id_cliente = ?');
		$query->execute([$id_cliente]);
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
}
