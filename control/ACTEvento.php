<?php
/**
*@package pXP
*@file gen-ACTEvento.php
*@author  (admin)
*@date 17-01-2019 22:19:07
*@description Clase que recibe los parametros enviados por la vista para mandar a la capa de Modelo
*/

session_start();
class ACTEvento extends ACTbase{    
			
	function listarEvento(){
		$this->objParam->defecto('ordenacion','id_evento');

		$this->objParam->defecto('dir_ordenacion','asc');
		if($this->objParam->getParametro('tipoReporte')=='excel_grid' || $this->objParam->getParametro('tipoReporte')=='pdf_grid'){
			$this->objReporte = new Reporte($this->objParam,$this);
			$this->res = $this->objReporte->generarReporteListado('MODEvento','listarEvento');
		} else{
			$this->objFunc=$this->create('MODEvento');
			
			$this->res=$this->objFunc->listarEvento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
				
	function insertarEvento(){
		$this->objFunc=$this->create('MODEvento');	
		if($this->objParam->insertar('id_evento')){
			$this->res=$this->objFunc->insertarEvento($this->objParam);			
		} else{			
			$this->res=$this->objFunc->modificarEvento($this->objParam);
		}
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
						
	function eliminarEvento(){
			$this->objFunc=$this->create('MODEvento');	
		$this->res=$this->objFunc->eliminarEvento($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
	function sincronizarEvento(){
		$this->objFunc=$this->create('MODEvento');	
		$this->res=$this->objFunc->sincronizarEvento($this->objParam);
		$this->res->imprimirRespuesta($this->res->generarJson());
	}
			
}

?>