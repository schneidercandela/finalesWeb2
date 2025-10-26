<?php

class LibroModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_biblioteca;charset=utf8', 'root', '');
	}

	public function get($id)
	{
		$query = $this->db->prepare('SELECT * FROM libro WHERE id = ?');
		$query->execute([$id]);
		return $query->fetch(PDO::FETCH_OBJ);
	}
}
