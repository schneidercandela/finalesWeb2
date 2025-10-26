<?php

class InscripcionModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_faro;charset=utf8', 'root', '');
	}

	public function getByAlumnoTaller($id_alumno, $id_taller)
	{
		$query = $this->db->prepare('SELECT * FROM Inscripcion WHERE id_alumno = ? AND id_taller = ? AND cancelada = False');
		$query->execute([$id_alumno, $id_taller]);
		return $query->fetch(PDO::FETCH_OBJ);
	}
    
    public function cancelar($id)
	{
		$query = $this->db->prepare('UPDATE Inscripcion SET cancelada = False WHERE id = ?');
		$query->execute([$id]);
		return $query->fetch(PDO::FETCH_OBJ);
	}
    

    public function getInscriptosTaller($id_taller)
    {
		$query = $this->db->prepare('SELECT COUNT(1) FROM Inscripcion WHERE id_taller = ? AND cancelada = False');
		$query->execute([$id_taller]);
		return $query->fetchColumn();
    }

    

}

