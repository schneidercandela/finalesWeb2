<?php
function sessionAuthMiddleware($res)
{
    session_start();
    if (isset($_SESSION['NOMBRE'])) {
        $res->user = new stdClass();
        $res->user->id = $_SESSION['ID_USER'];
        $res->user->nombre = $_SESSION['NOMBRE'];
        return;
    }
}
