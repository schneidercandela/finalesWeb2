<?php

require_once './app/models/prestamo.model.php';
require_once './app/models/libro.model.php';
require_once './app/views/prestamo.view.php';

class PrestamoController {
	private $view;
	private $libroModel;
	private $prestamoModel;

	public function __construct($res)
	{
		$this->prestamoModel = new PrestamoModel();
		$this->libroModel = new LibroModel();
		$this->view = new PrestamoView($res);
	}

    function devolver($req, $res) {
        if ($req->user->role != 'ADMIN') { // o if(!$this->AuthHelper->isAdmin())
            return $this->view->showErrorDevolver("No tiene permisos para devolver libros");
        }

        $id_libro = $req->params[':id']; // o $_GET['id']
        $libro = $this->libroModel->get($id_libro);
        if(!$libro)
        {
            return $this->view->showErrorDevolver("No existe el libro", $id_libro);
        }

        $prestamo = $this->prestamoModel->getCurrentByLibro($id_libro);
        if(!$prestamo)
        {
            return $this->view->showErrorDevolver("El libro no está prestado", $id_libro);
        }

        $fecha_fin = date('Y-m-d');
        $this->prestamoModel->devolver($prestamo->id, $fecha_fin);
        return $this->view->response("Libro devuelto");
    }
}