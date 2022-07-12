<?php
class SILSocketUser {
	public $id;
	public $tipo;
	public $login;
	public $socket;
	public $headers = array();
	public $handshake = false;

	public $partialBuffer = "";
	public $handlingPartialPacket = false;

	public $partialMessage = "";
	public $sendingContinuous = false;

	public $hasSentClose = false;

	function __construct($id, $socket) {
		$this->id = $id;
		$this->socket = $socket;
	}
}