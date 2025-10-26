<?php

class TurnoModel
{
	private $db;

	public function __construct()
	{
		$this->db = new PDO('mysql:host=localhost;dbname=db_veterinaria;charset=utf8', 'root', '');
	}

	// Ejercicio 1 y 2
	// NOTA: El Ej. 1 no pedía model, así que podría no estar la hora
	public function getTurnosDiaActual($dia, $mes, $anio, $hora = null)
	{
		$query = 'SELECT *
        FROM turno t
        WHERE t.dia = ? AND t.mes = ? AND t.anio = ?';

		$queryExecute = [$dia, $mes, $anio];

		if ($hora) { // Solo ej. 1, no se pedía para el parcial
			$query = $query . ' AND t.hora = ?';
			array_push($queryExecute, $hora);
		}

		$query = $query . ' ORDER BY t.hora';

		$query = $this->db->prepare($query);
		$query->execute($queryExecute);
		return $query->fetchAll(PDO::FETCH_OBJ);
	}

	// Ejercicio 1
	public function insertTurno($dia, $mes, $id_mascota, $anio, $hora)
	{
		$query = $this->db->prepare('INSERT INTO turno (dia, mes, id_mascota, anio, hora) VALUES (?, ?, ?, ?, ?)');
		$query->execute([$dia, $mes, $id_mascota, $anio, $hora]);
		$id = $this->db->lastInsertId();
		return $id;
	}
}
