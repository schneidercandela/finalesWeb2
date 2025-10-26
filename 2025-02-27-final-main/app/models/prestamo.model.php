<?php

class PrestamoModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_biblioteca;charset=utf8', 'root', '');
	}

	public function getCurrentByLibro($id_libro)
	{
		$query = $this->db->prepare('SELECT * FROM prestamo WHERE id_libro = ? AND devuelto = false');
		$query->execute([$id_libro]);
		return $query->fetch(PDO::FETCH_OBJ);
	}

    public function devolver($id, $fecha_devolucion)
    {
        $query = $this->db->prepare('UPDATE prestamo SET devuelto = true, fecha_fin = ? WHERE id = ?');
        $query->execute([$fecha_devolucion, $id]);
    }
}
