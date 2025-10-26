<?php
class TurnoApiController
{
    private $turnoModel;
    private $mascotaModel;
    private $view;

    // Ejercicio 2
    // URL ->// ...api/turnos
    // Método: POST
    public function addTurno($req, $res)
    {
        // Verificamos el usuario
        if (!$res->user) {
            return $this->view->response('Unauthorized', 401);
        }

        // Chequeamos los datos
        if (
            !isset($req->body->dia) || !isset($req->body->id_mascota)
            || !isset($req->body->hora) || !isset($req->body->anio)
            || !isset($req->body->mes) || !isset($req->body->estado)
        ) {
            return $this->view->response("Faltan completar datos", 400);
        }

        // Verificamos la mascota
        if (!$this->mascotaModel->getById($req->body->id_mascota)) {
            return $this->view->response("La mascota no existe", 404);
        }
        $turno = $req->body;
        $turno['id_usuario'] = $res->user->id;
        // En el execute del modelo accedemos a cada atributo del objeto $turno para hacer la inserción
        $id = $this->turnoModel->add($turno);
        $newTurno = $this->turnoModel->getById($id);
        // Enviamos la respuesta
        return $this->view->response($newTurno, 201);
    }
}
