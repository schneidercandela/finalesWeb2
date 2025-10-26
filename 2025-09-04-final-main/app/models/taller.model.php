<?php

class TallerModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_faro;charset=utf8', 'root', '');
	}

	public function get($id)
	{
		$query = $this->db->prepare('SELECT * FROM Taller WHERE id = ?');
		$query->execute([$id]);
		return $query->fetch(PDO::FETCH_OBJ);
	}

    public function abrir($id)
    {
        $query = $this->db->prepare('UPDATE Taller SET inscripcion_abierta = true WHERE id = ?');
        $query->execute([$id]);
    }

    public function getAbiertos($order) 
    {
        // Podemos usar order porque no viene del usuario, viene de constantes en código
        $query = $this->db->prepare("SELECT * FROM Taller WHERE inscripcion_abierta = true ORDER BY nombre $order");
        $query->execute([]);
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}
