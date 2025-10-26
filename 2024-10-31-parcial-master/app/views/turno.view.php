<?php

class TurnoView
{
	private $user = null;

	public function __construct($user)
	{
		$this->user = $user;
	}

	public function getTurnosDiaActual($turnos, $cantidadTurnos)
	{
		$user = $this->user;
		require 'app/templates/layout/header.phtml';
		require 'app/templates/lista_turnos.phtml';
		require 'app/templates/layout/footer.phtml';
	}

	public function showMensaje($mensaje)
	{
		$user = $this->user;
		require 'app/templates/layout/header.phtml';
		require 'app/templates/mensaje.phtml';
		require 'app/templates/layout/footer.phtml';
	}
}
