<?php

class TurnoModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
	}

	// Ejercicio 1
	// Obtener datos de un turno
	public function getTurno($id_turno)
	{
		$query = $this->db->prepare('SELECT * FROM turno WHERE id = ?');
		$query->execute([$id_turno]);
		return $query->fetch(PDO::FETCH_OBJ);
	}

	// Actualizar turno
	public function updateTurno($dia, $mes, $anio, $hora, $id_mascota, $id_turno)
	{
		$query = $this->db->prepare('UPDATE turno SET dia = ?, mes = ?, anio = ?, hora = ?, id_mascota = ? WHERE id = ?');
		$query->execute([$dia, $mes, $anio, $hora, $id_mascota, $id_turno]);
	}

	// Obtener turnos de una mascota
	public function getTurnosPorMascota($id_mascota)
	{
		$query = $this->db->prepare('SELECT * FROM turno WHERE id_mascota = ?');
		$query->execute([$id_mascota]);
		return $query->fetchAll(PDO::FETCH_OBJ);
	}
}
