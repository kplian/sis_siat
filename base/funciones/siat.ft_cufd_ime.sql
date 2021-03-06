CREATE OR REPLACE FUNCTION siat.ft_cufd_ime (
  p_administrador integer,
  p_id_usuario integer,
  p_tabla varchar,
  p_transaccion varchar
)
RETURNS varchar AS
$body$
/**************************************************************************
 SISTEMA:		Sistema de Ventas
 FUNCION: 		siat.ft_cufd_ime
 DESCRIPCION:   Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tcufd'
 AUTOR: 		 (admin)
 FECHA:	        22-01-2019 02:23:54
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				22-01-2019 02:23:54								Funcion que gestiona las operaciones basicas (inserciones, modificaciones, eliminaciones de la tabla 'siat.tcufd'	
 #
 ***************************************************************************/

DECLARE

	v_nro_requerimiento    	integer;
	v_parametros           	record;
	v_id_requerimiento     	integer;
	v_resp		            varchar;
	v_nombre_funcion        text;
	v_mensaje_error         text;
	v_id_cufd	integer;
    v_fecha_fin				timestamp;
			    
BEGIN

    v_nombre_funcion = 'siat.ft_cufd_ime';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_CUFD_INS'
 	#DESCRIPCION:	Insercion de registros
 	#AUTOR:		admin	
 	#FECHA:		22-01-2019 02:23:54
	***********************************/

	if(p_transaccion='SIA_CUFD_INS')then
					
        begin
        	update  siat.tcufd set
				estado_reg = 'inactivo',
				fecha_fin = now(),
				id_usuario_mod = p_id_usuario
			where estado_reg = 'activo';

			v_fecha_fin = to_timestamp(REPLACE(v_parametros.fecha_fin, 'T', ' ' ),'YYYY-MM-DD HH24:MI:SS.MS');
        		
        
        	--Sentencia de la insercion
        	insert into siat.tcufd(
			codigo,
			fecha_inicio,
			fecha_fin,
			estado_reg,			
			id_usuario_ai,
			id_usuario_reg,
			usuario_ai,
			fecha_reg,
			id_usuario_mod,
			fecha_mod
          	) values(
			v_parametros.codigo,
			now(),
			v_fecha_fin,
			'activo',			
			v_parametros._id_usuario_ai,
			p_id_usuario,
			v_parametros._nombre_usuario_ai,
			now(),
			null,
			null
							
			
			
			)RETURNING id_cufd, fecha_fin into v_id_cufd, v_fecha_fin;            
            			
			--Definicion de la respuesta
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje','CUFD almacenado(a) con exito (id_cufd'||v_id_cufd||')'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cufd',v_id_cufd::varchar);

            --Devuelve la respuesta
            return v_resp;

		end;

	/*********************************    
 	#TRANSACCION:  'SIA_CUFD_MOD'
 	#DESCRIPCION:	Modificacion de registros
 	#AUTOR:		admin	
 	#FECHA:		22-01-2019 02:23:54
	***********************************/

	elsif(p_transaccion='SIA_CUFD_MOD')then

		begin
			--Sentencia de la modificacion
			update siat.tcufd set
			codigo = v_parametros.codigo,
			fecha_inicio = v_parametros.fecha_inicio,
			fecha_fin = v_parametros.fecha_fin,
			id_cuis = v_parametros.id_cuis,
			id_usuario_mod = p_id_usuario,
			fecha_mod = now(),
			id_usuario_ai = v_parametros._id_usuario_ai,
			usuario_ai = v_parametros._nombre_usuario_ai
			where id_cufd=v_parametros.id_cufd;
               
			--Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','CUFD modificado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cufd',v_parametros.id_cufd::varchar);
               
            --Devuelve la respuesta
            return v_resp;
            
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_CUFD_ELI'
 	#DESCRIPCION:	Eliminacion de registros
 	#AUTOR:		admin	
 	#FECHA:		22-01-2019 02:23:54
	***********************************/

	elsif(p_transaccion='SIA_CUFD_ELI')then

		begin
			--Sentencia de la eliminacion
			delete from siat.tcufd
            where id_cufd=v_parametros.id_cufd;
               
            --Definicion de la respuesta
            v_resp = pxp.f_agrega_clave(v_resp,'mensaje','CUFD eliminado(a)'); 
            v_resp = pxp.f_agrega_clave(v_resp,'id_cufd',v_parametros.id_cufd::varchar);
              
            --Devuelve la respuesta
            return v_resp;

		end;
         
	else
     
    	raise exception 'Transaccion inexistente: %',p_transaccion;

	end if;

EXCEPTION
				
	WHEN OTHERS THEN
		v_resp='';
		v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
		v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
		v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
		raise exception '%',v_resp;
				        
END;
$body$
LANGUAGE 'plpgsql'
VOLATILE
CALLED ON NULL INPUT
SECURITY INVOKER
COST 100;