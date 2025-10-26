<?php

require_once './app/models/prestamo.model.php';
require_once './app/models/libro.model.php';
require_once './app/views/api.view.php';

class PrestamoController {
	private $view;
	private $libroModel;
	private $prestamoModel;

	public function __construct($res)
	{
		$this->prestamoModel = new PrestamoModel();
		$this->libroModel = new LibroModel();
		$this->view = new APIView($res);
	}

    function get($req, $res) {
		// ...

        if($req->params->disponible) {
			$alllibros = $this->libroModel->getAll();
			$libros = [];
			// Esto sería mas eficiente chequearlo en la base, pero ya excede a la materia
			foreach ($alllibros as $libro) {
				$prestamo = $this->prestamoModel->getCurrentByLibro($libro->id);
				if(!$prestamo) {
					$libros[] = $libro;
				}
			}
			return $this->view->response($libros, 200);
		}

		// ...
    }
}