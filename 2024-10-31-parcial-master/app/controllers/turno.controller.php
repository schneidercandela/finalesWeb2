<?php
require_once './app/models/turno.model.php';
require_once './app/models/mascota.model.php';
require_once './app/views/turno.view.php';
define('MAX_TURNOS_POR_HORA', 3);

class TurnoController
{
    private $turnoModel;
    private $view;
    private $res;
    private $mascotaModel;

    public function __construct()
    {
        $this->turnoModel = new TurnoModel();
        $this->mascotaModel = new MascotaModel();
        $this->view = new TurnoView($this->res->user);
    }

    // Ejercicio 2
    public function getTurnosDiaActual()
    {
        $fechaActual = $this->obtenerFechaActual();
        $dia = $fechaActual->dia;
        $mes = $fechaActual->mes;
        $anio = $fechaActual->anio;
        $turnos = $this->turnoModel->getTurnosDiaActual($dia, $mes, $anio);
        $totalTurnos = count($turnos);
        foreach ($turnos as $turno) {
            $mascota = $this->mascotaModel->getMascota($turno->id_mascota);
            $turno->nombre_mascota = $mascota->nombre;
            $turno->edad = $mascota->edad;
        }
        return $this->view->getTurnosDiaActual($turnos, $totalTurnos);
    }

    // Ejercicio 1
    public function addTurno()
    {
        if (!isset($_POST['dia']) || empty($_POST['dia'])) {
            return $this->view->showMensaje('Falta completar dia.');
        }

        if (!isset($_POST['id_mascota']) || empty($_POST['id_mascota'])) {
            return $this->view->showMensaje('Falta agregar la mascota.');
        }

        if (!isset($_POST['mes']) || empty($_POST['mes'])) {
            return $this->view->showMensaje('Falta completar el mes.');
        }

        if (!isset($_POST['anio']) || empty($_POST['anio'])) {
            return $this->view->showMensaje('Falta completar el año.');
        }

        if (!isset($_POST['hora']) || empty($_POST['hora'])) {
            return $this->view->showMensaje('Falta completar la hora.');
        }

        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $id_mascota = $_POST['id_mascota'];
        $anio = $_POST['anio'];
        $hora = $_POST['hora'];

        if ($this->mascotaModel->getMascota($id_mascota)) {
            return $this->view->showMensaje('La mascota no existe.');
        }

        $totalTurnos = count($this->turnoModel->getTurnosDiaActual($dia, $mes, $anio, $hora));
        if ($totalTurnos >= MAX_TURNOS_POR_HORA) {
            return $this->view->showMensaje('No se pueden agregar más de ' . MAX_TURNOS_POR_HORA . ' turnos a la misma hora.');
        }

        $id = $this->turnoModel->insertTurno($dia, $mes, $id_mascota, $anio, $hora);
        if (!$id) {
            $this->view->showMensaje('No se pudo agregar inténtalo de nuevo.');
        }
        $this->view->showMensaje('Se agregó correctamente.');
    }

    // Método extra para obtener la fecha con enteros
    private function obtenerFechaActual()
    {
        return (object) [
            'dia' => intval(date('d')),
            'mes' => intval(date('m')),
            'anio' => intval(date('Y')),
        ];
    }
}
