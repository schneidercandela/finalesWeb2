<?php
require_once './ventas.model.php';
require_once './ventas.view.php';
require_once './eventos.model.php';

class VentasController {
    private $eventoModel;
    private $ventaModel;
    private $view;

    public function __construct() {
        $this->ventaModel = new VentasModel();
        $this->eventoModel = new EventosModel();
        $this->view = new VentasView();
    }
   
    public function getVentas() {
      
        // valido entrada de datos
        if (empty($_GET['fecha_compra']) || empty($_GET['id_evento'])) {
            $this->view->showError('Falta ingresar datos obligatorios');
            return;
        }

        // obtengo los datos por GET
        $fechaCompra = $_GET['fecha_compra'];
        $idEvento = $_GET['id_evento'];

        // valido que evento exista
        $evento = $this->eventoModel->getById($idEvento);
        if (empty($evento)) {
            $this->view->showError('No existe el evento solicitado');
            return;
        }

        // obtengo todas las ventas para la fecha y evento solicitado y calculo el total de cada una
        $ventas = $this->ventaModel->getByFechaYEvento($fechaCompra, $idEvento);
        foreach($ventas as $venta) {
            $venta->total = $venta->cant_entra * $evento->precio;
        }

        $this->view->showVentas($ventas);
    }
}