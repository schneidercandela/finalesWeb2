<?php

require_once './app/models/cliente.model.php';
require_once './app/models/historia.model.php';
require_once './app/models/mascota.model.php';
require_once './app/views/mascota.view.php';

class MascotaController
{
    private $clienteModel;
    private $historiaModel;
    private $mascotaModel;
    private $view;

    public function __construct()
    {
        $this->clienteModel = new ClienteModel();
        $this->historiaModel = new HistoriaModel();
        $this->mascotaModel = new MascotaModel();
        $this->view = new MascotaView();
    }

    public function delete($req, $res)
    {
        $id = $req->params[':id']; // o $_GET['id']
        
        $mascota = $this->mascotaModel->get($id);
        if(!$mascota)
        {
            return $this->view->showDeleteError('La mascota no existe', $id);
        }
        
        if(count($this->historiaModel->getByMascota($id)))
        {
            return $this->view->showDeleteError('La mascota tiene historias clínicas asociadas', $id);
        }
        
        $this->mascotaModel->delete($id);

        $clienteBorrado = false;
        if(!count($this->mascotaModel->getByIdCliente($mascota->id_cliente)))
        {
            $this->clienteModel->delete($mascota->id_cliente);
            $clienteBorrado = true;
        }
        
        return $this->view->showDeleteSuccess($mascota, $clienteBorrado);
    }
}
