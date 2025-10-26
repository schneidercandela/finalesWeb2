<?php

require_once './app/models/taller.model.php';
require_once './app/models/inscripcion.model.php';
require_once './app/views/inscripcion.view.php';

class InscripcionController {
	private $view;
	private $tallerModel;
	private $inscripcionModel;

	public function __construct($req)
	{
		$this->tallerModel = new TallerModel();
		$this->inscripcionModel = new InscripcionModel();
		$this->view = new InscripcionView($req);
	}

    function cancelar($req) {
        // Verificamos que el usuario esté logueado y sea un alumno
        if($req->user->role!='ALUMNO') {
            return $this->view->showError("Solo los alumnos pueden cancelar su inscripción");
        }

        // Como alternativa podemos pedir que el usuario nos pase el id de la inscripción y con ella obtenemos el id del taller,
        //  pero debemos chequear que esa inscripción se corresponda con el alumno
        $taller = $this->tallerModel->get($req->body->taller_id);
        if(!$taller) {
            return $this->view->showError("El taller no existe");
        }
        if(!taller->inicio) {
            return $this->view->showError("El taller ya inició");
        }

        $inscripcion = $this->inscripcionModel->getByAlumnoTaller($req->user->id, $taller->id);
        if(!$inscripcion) {
            return $this->view->showError("El alumno no está inscripto al taller");
        }

        $this->inscripcionModel->cancelar($inscripcion);
        
        $inscriptos = $this->inscripcionModel->getInscriptosTaller($taller->id);
        if($inscriptos<$taller->cupo_max) { // Ya chequeamos que no inició en la linea 31
            $this->tallerModel->abrir($taller->id);
        }

        $this->view->showCancelado("Inscripción cancelada con éxito", $inscripcion, $taller);
    }

}
