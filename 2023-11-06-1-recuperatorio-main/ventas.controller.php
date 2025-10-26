<?php
require_once './app/models/ventas.model.php';
require_once './app/models/eventos.model.php';
require_once './app/models/usuarios.model.php';

class VentasController {

    private $view;

    private $ventasModel;
    private $eventosModel;
    private $usuariosModel;

    public function __construct() {
        $this->ventasModel = new VentasModel();
        $this->eventosModel = new EventosModel();
        $this->usuariosModel = new UsuariosModel();
        $this->view = new VentasView();
    }

    public function create() {
        if( empty($_POST['id_evento']) || 
            empty($_POST['id_usuario']) ||
            empty($_POST['cant_entradas']) )
        {
            $this->view->error("Faltan completar campos");
            return;
        }
        
        $id_evento = $_POST['id_evento'];
        $id_usuario = $_POST['id_usuario'];
        $cant_entradas = $_POST['cant_entradas'];
        
        $evento = $this->eventosModel->get($id_evento);

        if(!$evento){
            $this->view->error("El evento no existe");
            return;
        }
        
        $usuario = $this->usuariosModel->get($id_usuario);

        if(!$usuario){
            $this->view->error("El usuario no existe");
            return;
        }

        if($evento->entradas_restantes<$cant_entradas) {
            $this->view->error("No hay suficientes entradas");
            return;
        }

        $restadas = $this->eventoModel->restarEntradas($id_evento, $cant_entradas);
        
        $venta = $this->ventasModel->create($id_evento, $id_usuario,$cant_entradas, now());

        $this->view->ventaCreada($venta);
    }

}