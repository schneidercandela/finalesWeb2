<?php
require_once './app/models/historia.model.php';
require_once './app/models/mascota.model.php';
require_once './app/views/json.view.php';

class MascotaApiController
{
	private $view;
	private $mascotaModel;
	private $historiaModel;

	public function __construct($res)
	{
		$this->mascotaModel = new MascotaModel();
		$this->clienteModel = new ClienteModel();
		$this->historiaModel = new HistoriaModel();
		$this->view = new JSONView($res);
	}

    // POST api/mascota
    function add($req, $res)
    {
        if(empty($req->body->nombre) || empty($req->body->ultimo_peso))
        {
            return $this->view->response("Faltan datos obligatorios", 400);
        }
        $mascota = $body->mascota;
        $mascota->id_cliente = $res->user->id;
        $id = $this->mascotaModel->add($mascota);
        return $this->view->response($this->mascotaModel->get($id), 200);
    }

    // PATCH api/mascota/:id
    function partialUpdate($req, $res)
    {
        $id = $req->params[':id'];
        $mascota = $this->mascotaModel->get($id);
        if(!$mascota)
        {
            return $this->view->response(["No existe la mascota", $id], 404);
        }
        $body = $req->body;
        if(!empty($body->ultimo_peso))
        {
            $mascota->ultimo_peso = $body->ultimo_peso;
        }
        $this->mascotaModel->update($mascota);
        return $this->view->response($this->mascotaModel->get($id), 200);
    }
}
