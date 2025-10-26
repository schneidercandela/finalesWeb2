<?php
require_once './app/models/historia.model.php';
require_once './app/models/mascota.model.php';
require_once './app/models/cliente.model.php';
require_once './app/views/histria.view.php';
define('CANT_TURNOS_MASCOTA', 1);

class HistoriaController
{
	private $view;
	private $mascotaModel;
	private $clienteModel;
	private $historiaModel;

	public function __construct($res)
	{
		$this->mascotaModel = new MascotaModel();
		$this->clienteModel = new ClienteModel();
		$this->historiaModel = new HistoriaModel();
		$this->view = new HistoriaView();
	}

	// Verificamos que el usuario esté logueado con los middleware en el router
	// sessionAuthMiddleware(res);
	// verifyAuthMiddleware(res);
	public function addHistoryRecord()
	{
		// verifica campos de historia clínica
		if (!isset($_POST['fecha']) || empty($_POST['fecha'])) {
			return $this->view->showMensaje('Falta completar la fecha.');
		}

		if (!isset($_POST['peso']) || empty($_POST['peso'])) {
			return $this->view->showMensaje('Falta completar el peso.');
		}

		if (!isset($_POST['tratamiento']) || empty($_POST['tratamiento'])) {
			return $this->view->showMensaje('Falta completar el tratamiento.');
		}

		if (!isset($_POST['notas']) || empty($_POST['notas'])) {
			return $this->view->showMensaje('Falta completar las notas.');
		}

		if (!isset($_POST['id_mascota']) || empty($_POST['id_mascota'])) {
			return $this->view->showMensaje('Falta agregar la mascota.');
		}

		$fecha = $_POST['fecha'];
		$peso = $_POST['peso'];
		$tratamiento = $_POST['tratamiento'];
		$notas = $_POST['notas'];
		$id_mascota = $_POST['id_mascota'];

		// verificamos que la mascosta exista
		$datos_mascota = $this->mascotaModel->getMascota($id_mascota);
		if (count($datos_mascota) < 1) { //  !isset($datosmascota)
			return $this->view->showMensaje('La mascota no existe.');
		}

		// verificamos que el cliente no esté suspendido
		// podemos obtener este dato usando el id_cliente de la mascota
		// otra opción válida: crear un método en el model de mascotas para traer el dato del cliente
		// en base al id_mascota
		$id_cliente = $datos_mascota->id_cliente;
		$datos_cliente = $this->clienteModel->getCliente($id_cliente);
		if ($datos_cliente->suspendido) { // variantes válidas: $datos_cliente->suspendido == true o $datos_cliente->suspendido == 1
			return $this->view->showMensaje('El cliente está suspendido.');
		}

		// verificamos si la mascota ya tiene un turno en esa fecha
		$tratamientos_mascota = $this->historiaModel->getTratamientosMascota($id_mascota, $fecha);
		if (count($tratamientos_mascota) >= CANT_TURNOS_MASCOTA) {
			return $this->view->showMensaje('La mascota no puede tener más de un tratamiento');
		}

		// Agregamos el registro
		$id_historia_clinica = $this->historiaModel->addHistoryRecord($fecha, $peso, $tratamiento, $notas, $id_mascota);
		if (!$id_historia_clinica) {
			return $this->view->showMensaje('No se pudo agregar el registro. Inténtalo de nuevo.');
		}

		// Actualizamos el peso de la mascota
		$this->mascotaModel->updateDatosMascota($id_mascota, $peso);

		// Aviso de carga exitosa
		$this->view->showMensaje('El tratamiento se agregó correctamente,');
	}
}
