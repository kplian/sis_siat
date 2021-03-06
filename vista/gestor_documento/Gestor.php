<?php
/**
*@package pXP
*@file gen-GestorDocumento.php
*@author  (jrivera)
*@date 16-12-2019 11:32:11
*@description Archivo con la interfaz de usuario que permite la ejecucion de todas las funcionalidades del sistema
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019				 (jrivera)				CREACION	

*/

header("content-type: text/javascript; charset=UTF-8");
?>
<script>
Phx.vista.Gestor=Ext.extend(Phx.gridInterfaz,{

	constructor:function(config){
		this.maestro=config.maestro;
    	//llama al constructor de la clase padre
		Phx.vista.Gestor.superclass.constructor.call(this,config);
		this.addButton('procesar', {
            text: 'Procesar',
            iconCls: 'badelante',
            disabled: false,
            handler: this.procesar,
            tooltip: 'Procesa el documento seleccionado'
        });
		this.init();
		
	},
			
	Atributos:[
		{
			//configuracion del componente
			config:{
					labelSeparator:'',
					inputType:'hidden',
					name: 'id_gestor_documento'
			},
			type:'Field',
			form:true 
		},
		{
			config:{
				name: 'fecha_hora_factura',
				fieldLabel: 'Fecha Peticion',
				allowBlank: false,
				anchor: '80%',
				gwidth: 120,
				maxLength:100
			},
				type:'TextField',				
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'razon_social',
				fieldLabel: 'Razon Social',
				allowBlank: false,
				anchor: '80%',
				gwidth: 130,
				maxLength:100
			},
				type:'TextField',
				filters:{pfiltro:'ven.razon_social',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},

		{
			config:{
				name: 'nro_factura',
				fieldLabel: 'Nro Factura',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:100
			},
				type:'TextField',
				filters:{pfiltro:'ven.nro_factura',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},

		{
			config:{
				name: 'monto_total',
				fieldLabel: 'Monto Total',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:100
			},
				type:'NumberField',				
				id_grupo:1,
				grid:true,
				form:false
		},

		{
			config:{
				name: 'moneda',
				fieldLabel: 'Moneda',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:100
			},
				type:'TextField',				
				id_grupo:1,
				grid:true,
				form:false
		},

		{
			config:{
				name: 'motivo_anulacion',
				fieldLabel: 'Motivo Anulacion',
				allowBlank: false,
				anchor: '80%',
				gwidth: 130,
				maxLength:100
			},
				type:'TextField',				
				id_grupo:1,
				grid:true,
				form:false
		},
				
		{
			config:{
				name: 'hash',
				fieldLabel: 'hash',
				allowBlank: false,
				anchor: '80%',
				gwidth: 120,
				maxLength:100
			},
				type:'TextField',				
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'metodo_servicio',
				fieldLabel: 'Metodo Servicio',
				allowBlank: false,
				anchor: '80%',
				gwidth: 130,
				maxLength:100
			},
				type:'TextField',
				filters:{pfiltro:'gesdoc.metodo_servicio',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		
		{
			config:{
				name: 'url_servicio',
				fieldLabel: 'Url Servicio',
				allowBlank: false,
				anchor: '80%',
				gwidth: 130,
				maxLength:200
			},
				type:'TextField',
				filters:{pfiltro:'gesdoc.url_servicio',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'estado',
				fieldLabel: 'Estado Peticion',
				allowBlank: false,
				anchor: '80%',
				gwidth: 100,
				maxLength:20
			},
				type:'TextField',
				filters:{pfiltro:'gesdoc.estado',type:'string'},
				id_grupo:1,
				grid:true,
				form:true
		},
		{
			config:{
				name: 'estado_reg',
				fieldLabel: 'Estado Reg.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:10
			},
				type:'TextField',
				filters:{pfiltro:'gesdoc.estado_reg',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		
		
		{
			config:{
				name: 'id_usuario_ai',
				fieldLabel: '',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'gesdoc.id_usuario_ai',type:'numeric'},
				id_grupo:1,
				grid:false,
				form:false
		},
		{
			config:{
				name: 'usuario_ai',
				fieldLabel: 'Funcionaro AI',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:300
			},
				type:'TextField',
				filters:{pfiltro:'gesdoc.usuario_ai',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_reg',
				fieldLabel: 'Fecha creación',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'gesdoc.fecha_reg',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_reg',
				fieldLabel: 'Creado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu1.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'fecha_mod',
				fieldLabel: 'Fecha Modif.',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
							format: 'd/m/Y', 
							renderer:function (value,p,record){return value?value.dateFormat('d/m/Y H:i:s'):''}
			},
				type:'DateField',
				filters:{pfiltro:'gesdoc.fecha_mod',type:'date'},
				id_grupo:1,
				grid:true,
				form:false
		},
		{
			config:{
				name: 'usr_mod',
				fieldLabel: 'Modificado por',
				allowBlank: true,
				anchor: '80%',
				gwidth: 100,
				maxLength:4
			},
				type:'Field',
				filters:{pfiltro:'usu2.cuenta',type:'string'},
				id_grupo:1,
				grid:true,
				form:false
		}
	],
	tam_pag:50,	
	title:'Gestor Documento',
	ActSave:'../../sis_siat/control/GestorDocumento/insertarGestorDocumento',
	ActDel:'../../sis_siat/control/GestorDocumento/eliminarGestorDocumento',
	ActList:'../../sis_siat/control/GestorDocumento/listarGestorDocumento',
	id_store:'id_gestor_documento',
	arrayDefaultColumHidden:['estado_reg','usuario_ai',
    'fecha_reg','fecha_mod','usr_reg','usr_mod','motivo_anulacion'],
	fields: [
		{name:'id_gestor_documento', type: 'numeric'},
		{name:'tipo', type: 'string'},
		{name:'contenido_base64_corrida1', type: 'string'},
		{name:'hash', type: 'string'},
		{name:'metodo_servicio', type: 'string'},
		{name:'id_venta', type: 'numeric'},
		{name:'url_servicio', type: 'string'},
		{name:'estado_reg', type: 'string'},
		{name:'estado', type: 'string'},
		{name:'contenido_base64_corrida2', type: 'string'},
		{name:'id_usuario_ai', type: 'numeric'},
		{name:'usuario_ai', type: 'string'},
		{name:'fecha_reg', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_reg', type: 'numeric'},
		{name:'fecha_mod', type: 'date',dateFormat:'Y-m-d H:i:s.u'},
		{name:'id_usuario_mod', type: 'numeric'},
		{name:'usr_reg', type: 'string'},
		{name:'usr_mod', type: 'string'},
		{name:'razon_social', type: 'string'},
		{name:'nro_factura', type: 'string'},
		{name:'monto_total', type: 'numeric'},
		{name:'motivo_anulacion', type: 'string'},
		{name:'fecha_hora_factura', type: 'string'},
		{name:'moneda', type: 'string'},
		
	],
	sortInfo:{
		field: 'id_gestor_documento',
		direction: 'ASC'
	},
	bdel:false,
	bnew:false,
	bedit:false,
	bsave:false,
	preparaMenu:function()
    {   var rec = this.sm.getSelected();        
        if (rec.data.estado == 'pendiente' || rec.data.estado == 'enviado') {              
              this.getBoton('procesar').enable();                          
        }
        Phx.vista.Gestor.superclass.preparaMenu.call(this);
    },
    liberaMenu:function()
    {   this.getBoton('procesar').disable();            
        Phx.vista.Gestor.superclass.liberaMenu.call(this);
    },
	procesar:function () {
			var rec = this.sm.getSelected(); 			
			Phx.CP.loadingShow();
			Ext.Ajax.request({
				url: '../../sis_siat/control/GestorDocumento/procesarGestorDocumento',
				params: {
					id_gestor_documento: rec.data.id_gestor_documento
				},
				success: this.successSave,
				failure: this.conexionFailure,
				timeout: this.timeout,
				scope: this
			});
	
	},
	}
)
</script>
		
		