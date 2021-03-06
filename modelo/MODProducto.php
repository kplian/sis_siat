<?php
/**
*@package pXP
*@file gen-MODProducto.php
*@author  (admin)
*@date 16-01-2019 19:47:00
*@descripcion Clase que envia los parametros requeridos a la Base de datos para la ejecucion de las funciones, y que recibe la respuesta del resultado de la ejecucion de las mismas
*/
include dirname(__FILE__).'/MODBaseSiat.php';
class MODProducto extends MODBaseSiat{
	
	function __construct(CTParametro $pParam){
		parent::__construct($pParam);
	}
			
	function listarProducto(){
		//Definicion de variables para ejecucion del procedimientp
		$this->procedimiento='siat.ft_producto_sel';
		$this->transaccion='SIA_PRD_SEL';
		$this->tipo_procedimiento='SEL';//tipo de transaccion
				
		//Definicion de la lista del resultado del query
		$this->captura('id_producto','int4');
		$this->captura('codigo','numeric');
		$this->captura('estado_reg','varchar');
		$this->captura('descripcion','varchar');
		$this->captura('id_usuario_reg','int4');
		$this->captura('usuario_ai','varchar');
		$this->captura('fecha_reg','timestamp');
		$this->captura('id_usuario_ai','int4');
		$this->captura('fecha_mod','timestamp');
		$this->captura('id_usuario_mod','int4');
		$this->captura('usr_reg','varchar');
		$this->captura('usr_mod','varchar');
		$this->captura('actividad','varchar');
		$this->captura('codigo_concepto_ingas','varchar');
		
		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();
		
		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function insertarProducto(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_producto_ime';
		$this->transaccion='SIA_PRD_INS';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('actividad','actividad','varchar');
		$this->setParametro('codigo','codigo','numeric');
		$this->setParametro('estado_reg','estado_reg','varchar');
		$this->setParametro('descripcion','descripcion','varchar');
		$this->setParametro('codigo_concepto_ingas','codigo_concepto_ingas','varchar');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function modificarProducto(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_producto_ime';
		$this->transaccion='SIA_PRD_MOD';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_producto','id_producto','int4');
		$this->setParametro('codigo_concepto_ingas','codigo_concepto_ingas','varchar');		

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}
			
	function eliminarProducto(){
		//Definicion de variables para ejecucion del procedimiento
		$this->procedimiento='siat.ft_producto_ime';
		$this->transaccion='SIA_PRD_ELI';
		$this->tipo_procedimiento='IME';
				
		//Define los parametros para la funcion
		$this->setParametro('id_producto','id_producto','int4');

		//Ejecuta la instruccion
		$this->armarConsulta();
		$this->ejecutarConsulta();

		//Devuelve la respuesta
		return $this->respuesta;
	}

	function sincronizarProducto(){
		$this->respuesta = $this->sincronizar('sincronizacion','producto','tproducto');
		return $this->respuesta;
	}
			
}
?>