<?php
require_once './app/models/turno.model.php';
require_once './app/models/mascota.model.php';
require_once './app/views/turno.view.php';
define('CANT_TURNOS_PREMIUM', 10);

class TurnoController
{
    private $turnoModel;
    private $view;
    private $res;
    private $mascotaModel;

    public function __construct($res)
    {
        $this->turnoModel = new TurnoModel();
        $this->mascotaModel = new MascotaModel();
        $this->view = new TurnoView($res->user);
    }

    // Ejercicio 1

    // Verificamos que el usuario esté logueado con los middleware en el router
    // sessionAuthMiddleware(res);
    // verifyAuthMiddleware(res);
    public function editarTurno($id_turno = null)
    {
        // Verifica turno
        if ($id_turno == null) {
            return $this->view->showMensaje('Falta detallar el id del turno');
        }

        $datosTurno = $this->turnoModel->getTurno($id_turno);
        if ($datosTurno == null) {
            return $this->view->showMensaje('No existe el turno con id ' . $id_turno . '.');
        }

        // verifica campos
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

        // Toma valores de los campos
        $dia = $_POST['dia'];
        $mes = $_POST['mes'];
        $id_mascota = $_POST['id_mascota'];
        $anio = $_POST['anio'];
        $hora = $_POST['hora'];

        // Verifica que la mascota exista 
        $datosMascota = $this->mascotaModel->getMascota($id_mascota);
        if (count($datosMascota) < 1) { // No es necesario crear el model
            return $this->view->showMensaje('La mascota no existe.');
        }

        // Actualiza turno 
        $this->turnoModel->updateTurno($dia, $mes, $anio, $hora, $id_mascota, $id_turno);

        // Actualiza premium de la mascota (de ser necesario)        
        // Obtengo turnos de la mascota
        $turnosMascota = $this->turnoModel->getTurnosPorMascota($id_mascota);

        // Verifica cantidad de turnos
        if (count($turnosMascota) > CANT_TURNOS_PREMIUM) {
            $valorPremium = 1; // 1 true, 0 false
            $this->mascotaModel->updateMascotaPremium($valorPremium);
        }

        // Aviso de actualización exitosa
        $this->view->showMensaje('Se actualizó correctamente.');
    }
}
