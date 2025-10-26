<?php
require_once './app/models/historia.model.php';
require_once './app/models/mascota.model.php';
require_once './app/views/historia.view.php';
define('CANT_TURNOS_MASCOTA', 1);

class HistoriaApiController
{
	private $historaView;
	private $mascotaModel;
	private $historiaModel;

	public function __construct($res)
	{
		$this->mascotaModel = new MascotaModel();
		$this->clienteModel = new ClienteModel();
		$this->historiaModel = new HistoriaModel();
		$this->historaView = new HistoriaView();
	}


	function update($req, $res)
	{
		// verificamos el id hostoria/:id
		if (!isset($req->body->fecha) || empty($req->params->id)) {
			return $this->historaView->response('Falta agregar el id de la historia clinica que se desea actualizar', 400);
		};

		// verificamos que exita una historia con ese id
		$historia = $this->historiaModel->getById($req->params->id);
		if (!$historia) {
			return $this->historaView->response('Historia no encontrada', 404);
		}

		// verificamos los campos del body
		if (
			!isset($req->body->fecha) || !isset($req->body->peso) ||
			!isset($req->body->tratamiento) ||  !isset($req->body->notas) || !isset($req->body->id_mascota)
		) {
			return $this->historaView->response('Faltan completar datos', 400);
		}

		// verificamos que exista la mascota con ese id_mascota
		$mascota = $this->mascotaModel->getById($req->body->id_mascota);
		if (!isset($mascota)) {
			return $this->historaView->response('Mascota no encontrada', 404);
		}

		// actualizamos la historia clínica
		$this->historiaModel->update(
			$req->params->id,
			$req->body->fecha,
			$req->body->peso,
			$req->body->tratamiento,
			$req->body->notas,
			$req->body->id_mascota
		);
		return $this->historaView->response('Historia actualizada con exito', 200);
	}

	// mascota?sortBy=fecha&oder=ASC
	// mascota?sortBy=fecha&oder=DESC
	function listar($req, $res)
	{
		// obtenemos la columna por la cual ordenamos
		$sortBy = 'fecha';
		if ((isset($req->query->sortBy) || !empty($req->query->sortBy)) && $this->checkExistenceColumn($req->query->sortBy)) {
			$sortBy = $req->query->sortBy;
		}

		// obtenemos la forma por la cual ordenamos
		$order = 'ASC';
		if ((isset($req->query->order) || !empty($req->query->order)) && ($req->query->order == 'DESC')) {
			$order = $req->query->order;
		}

		// obtenemos toda la lista
		$historias = $this->historiaModel->getAll($sortBy, $order);
		return $this->historaView->response($historias, 200);
	}

	// método para verificar que la columna determinada en la URL esté dentro de las columnas de la tabla historia
	private function checkExistenceColumn($param)
	{
		return (
			$param == 'id' || $param == 'fecha' || $param == 'peso' || $param == 'tratamiento' || $param == 'notas' || $param == 'id_mascota'
		);
	}
}
