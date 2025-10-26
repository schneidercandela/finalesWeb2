<?php

require_once './app/models/taller.model.php';
require_once './app/models/inscripcion.model.php';
require_once './app/views/api.view.php';

class TallerController {
	private $view;
	private $tallerModel;
	private $inscripcionModel;

	public function __construct($req)
	{
        $this->tallerModel = new TallerModel();
        $this->inscripcionModel = new InscripcionModel();
		$this->view = new APIView($req);
	}

    function get($req) {
        // Verificamos que el usuario haya enviado un token
        if(!$req->user) {
            return $this->view->response("Credenciales invalidas", 401);
        }

		// ...

        // Si el usuario envía un ?disponibles=true le enviamos las que pueda inscribirse
        if($req->params->disponibles) {
            $order = 'asc';
            if($req-params->order == 'desc') $order = 'desc'; 

			$talleres_abiertos = $this->tallerModel->getAbiertos($order);
			$talleres = [];

            // Esto sería mas eficiente chequearlo en la base, pero ya excede a la materia
			foreach ($talleres_abiertos as $taller) {
				$inscripcion = $this->inscripcionModel->getByAlumnoTaller($req->user->id, $taller->id);
				if(!$inscripcion) {
					$talleres[] = $taller;
				}
			}
			return $this->view->response($talleres, 200);
		}

		// ...
    }
}