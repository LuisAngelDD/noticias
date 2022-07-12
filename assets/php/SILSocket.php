#!/usr/bin/env php
<?php

spl_autoload_register(function ($class){
	$paths = array(".", "../BackEnd", "../BackEnd/descriptores");
	foreach ($paths as $path){
		if(file_exists("$path/$class.php")) {
			require_once("$path/$class.php");
			break;
		}
	}
});

class SILSocket extends WebSocketServer {
	function __construct($addr, $bufferLength) {
		parent::__construct($addr, 9000, $bufferLength);
	}

	//
	// Método despachador
	//
	protected function proceso ($usuario, $mensaje) {
		$mensaje = json_decode($mensaje, true);

		$this->stdout($mensaje["mensaje"]);
		$this->stdout(json_encode($mensaje["data"]));

		if(method_exists($this, $mensaje["mensaje"])) {
			$op = $mensaje["mensaje"];
			$this->$op($usuario, $mensaje['data']);
		}
	}

	//
	// Gestores de eventos
	//
	protected function conectando($usuario){
	}

	protected function conectado($usuario) {
		$this->IDENTIFICATE($usuario);
	}

	protected function cerrado($usuario) {
		$this->stdout("Cliente desconectado. " . $usuario->id);
	}

	// Mensajes hacia la aplicación sesiones
	protected function VOTACION_ABIERTA($usuario, $data){
		$obj = new stdClass();
		$obj->data = new stdClass();
		$obj->mensaje = "VOTACION_ABIERTA";
		$obj->data->votacion = $data['votacion'];

		foreach($this->users as $user)
			if($user->tipo == "sesion"){
				$this->send($user, json_encode($obj));
				$this->stdout("VOTACION_ABIERTA - enviado");
			}
	}

	protected function VOTACION_CERRADA($usuario, $data){
		$obj = new stdClass();
		$obj->data = new stdClass();
		$obj->mensaje = "VOTACION_CERRADA";

		foreach($this->users as $user)
			if($user->tipo == "sesion"){
				$this->send($user, json_encode($obj));
				$this->stdout("VOTACION_CERRADA - enviado");
			}
	}	

	//
	// Mensajes desde/hacia todas las aplicaciones
	//
	protected function ECO($usuario, $data){
		$obj = new stdClass();

		$obj->mensaje = "ECO";
		$obj->data = $data;
		$this->send($usuario, json_encode($obj));
	}

	protected function IDENTIFICATE($usuario){
		$obj = new stdClass();

		$obj->mensaje = "IDENTIFICATE";
		$this->send($usuario, json_encode($obj));
	}

	protected function IDENTIFICACION($usuario, $data) {
		// Registro el nuevo usuario
		$this->users[$usuario->id]->tipo = $data['tipo'];
		$this->users[$usuario->id]->login = $data['login'];

		// Comunico a los clientes web y a las pantallas
		$msg = new stdClass();
		$msg->data = new stdClass();
		$msg->mensaje = "IDENTIFICACION";
		$msg->data->usuario = $data['login'];
		foreach($this->users as $user)
			if($user->tipo == "pantalla" || $user->tipo == "sesion")
				$this->send($user, json_encode($msg));
	}

	//
	// Mensajes hacia el portal de noticias
	//

	protected function NOTICIAS_ALTAS($usuario, $data) {
		$msg = new stdClass();
		$msg->data = new stdClass();
		$msg->mensaje = "NOTICIAS_ALTAS";
		$msg->data->add = $data['add'];
		foreach($this->users as $user)
			if($user->tipo == "pantalla")
				$this->send($user, json_encode($msg));
	}

	protected function NOTICIAS_MODIFICACIONES($usuario, $data) {
		$msg = new stdClass();
		$msg->data = new stdClass();
		$msg->mensaje = "NOTICIAS_MODIFICACIONES";
		$msg->data->up = $data['up'];
		foreach($this->users as $user)
			if($user->tipo == "pantalla")
				$this->send($user, json_encode($msg));
	}

	protected function NOTICIAS_BAJAS($usuario, $data) {
		$msg = new stdClass();
		$msg->data = new stdClass();
		$msg->mensaje = "NOTICIAS_BAJAS";
		$msg->data->sup = $data['sup'];
		foreach($this->users as $user)
			if($user->tipo == "pantalla")
				$this->send($user, json_encode($msg));
	}
}
$socket = new SILSocket("0.0.0.0", 4096);
try { $socket->run(); }
catch (Exception $e) { $socket->stdout($e->getMessage()); }