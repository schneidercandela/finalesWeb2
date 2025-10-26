<?php

class ClienteModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
	}

	public function delete($id)
	{
		$query = $this->db->prepare('DELETE FROM cliente WHERE id = ?');
		$query->execute([$id]);
	}
}
