<?php
/**
*@package pXP
*@file gen-MODPais.php
*@author  (admin)
*@date 17-01-2019 22:29:35
*@description Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODPais extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarPais(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_pais_sel';
		$this->transaccion='SIA_PAISIA_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_pais','int4');
		$this->captura('codigo','numeric');
		$this->captura('descripcion','varchar');
		$this->captura('estado_reg','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('id_usuario_reg','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarPais(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_pais_ime';
		$this->transaccion='SIA_PAISIA_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('codigo','codigo','numeric');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarPais(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_pais_ime';
		$this->transaccion='SIA_PAISIA_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_pais','id_pais','int4');
		$this->setParametro('codigo','codigo','numeric');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('estado_reg','estado_reg','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarPais(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_pais_ime';
		$this->transaccion='SIA_PAISIA_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_pais','id_pais','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarPais(){
		$this->respuesta = $this->sincronizar('sincronizacion','pais','tpais');
		return $this->respuesta;
	}
			
}
?>