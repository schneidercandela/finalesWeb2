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
		$this->historiaModel = new HistoriaModel();
		$this->view = new JSONView($res);
	}

    // GET api/historias?id_mascota=:id_mascota&orderBy=:orderBy&order=[asc|desc]
    function getByMascota($req, $res)
    {
        $orderBy = 'id';
        if(!empty($req->query['orderBy']) && $req->query['orderBy'] == 'fecha')
        {
            $orderBy = $req->query['orderBy'];
        }

        $order = 'asc';
        if(!empty($req->query['order']) && strtolower($req->query['order']) == 'desc')
        {
            $order = 'desc';
        }

        $historias = [];
        if(!empty($req->query['id_mascota']))
        {
            $id_mascota = $req->query['id_mascota'];
            $mascota = $this->mascotaModel->get($id_mascota);
            if(!$mascota)
            {
                return $this->view->response(["No existe la mascota", $id_mascota], 404);
            }
            $historias = $this->historiaModel->getByIdMascota($id_mascota, $orderBy, $order);    
        } else {
            $historias = $this->historiaModel->getAll($orderBy, $order);
        }
        
        return $this->view->response($historias, 200);
    }

}
