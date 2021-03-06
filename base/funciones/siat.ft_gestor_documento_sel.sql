CREATE OR REPLACE FUNCTION "siat"."ft_gestor_documento_sel"(	
				p_administrador integer, p_id_usuario integer, p_tabla character varying, p_transaccion character varying)
RETURNS character varying AS
$BODY$
/**************************************************************************
 SISTEMA:		Sistema SIAT
 FUNCION: 		siat.ft_gestor_documento_sel
 DESCRIPCION:   Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tgestor_documento'
 AUTOR: 		 (jrivera)
 FECHA:	        16-12-2019 11:32:11
 COMENTARIOS:	
***************************************************************************
 HISTORIAL DE MODIFICACIONES:
#ISSUE				FECHA				AUTOR				DESCRIPCION
 #0				16-12-2019 11:32:11								Funcion que devuelve conjuntos de registros de las consultas relacionadas con la tabla 'siat.tgestor_documento'	
 #
 ***************************************************************************/

DECLARE

	v_consulta    		varchar;
	v_parametros  		record;
	v_nombre_funcion   	text;
	v_resp				varchar;
			    
BEGIN

	v_nombre_funcion = 'siat.ft_gestor_documento_sel';
    v_parametros = pxp.f_get_record(p_tabla);

	/*********************************    
 	#TRANSACCION:  'SIA_GESDOC_SEL'
 	#DESCRIPCION:	Consulta de datos
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:11
	***********************************/

	if(p_transaccion='SIA_GESDOC_SEL')then
     				
    	begin
    		--Sentencia de la consulta
			v_consulta:='select
						gesdoc.id_gestor_documento,
						gesdoc.tipo,
						gesdoc.contenido_base64_corrida1,
						gesdoc.hash,
						gesdoc.metodo_servicio,
						gesdoc.id_venta,
						gesdoc.url_servicio,
						gesdoc.estado_reg,
						gesdoc.estado,
						gesdoc.contenido_base64_corrida2,
						gesdoc.id_usuario_ai,
						gesdoc.usuario_ai,
						gesdoc.fecha_reg,
						gesdoc.id_usuario_reg,
						gesdoc.fecha_mod,
						gesdoc.id_usuario_mod,
						usu1.cuenta as usr_reg,
						usu2.cuenta as usr_mod,	
						ven.nombre_factura::varchar as razon_social,
						ven.nro_factura,
						ven.total_venta as monto_total,
						mon.codigo as moneda,	
						moa.descripcion::varchar as motivo_anulacion,
						to_char(gesdoc.fecha_hora_factura,''DD/MM/YYYY HH24:MI:SS'')::varchar as fecha_hora_factura
						from siat.tgestor_documento gesdoc
						inner join segu.tusuario usu1 on usu1.id_usuario = gesdoc.id_usuario_reg
						inner join vef.tventa ven on ven.id_venta = gesdoc.id_venta
						inner join param.tmoneda mon on mon.id_moneda = ven.id_moneda
						left join siat.tmotivo_anulacion moa on moa.codigo = ven.codigo_motivo_anulacion
						left join segu.tusuario usu2 on usu2.id_usuario = gesdoc.id_usuario_mod
				        where  ';
			
			--Definicion de la respuesta
			v_consulta:=v_consulta||v_parametros.filtro;
			v_consulta:=v_consulta||' order by ' ||v_parametros.ordenacion|| ' ' || v_parametros.dir_ordenacion || ' limit ' || v_parametros.cantidad || ' offset ' || v_parametros.puntero;

			--Devuelve la respuesta
			return v_consulta;
						
		end;

	/*********************************    
 	#TRANSACCION:  'SIA_GESDOC_CONT'
 	#DESCRIPCION:	Conteo de registros
 	#AUTOR:		jrivera	
 	#FECHA:		16-12-2019 11:32:11
	***********************************/

	elsif(p_transaccion='SIA_GESDOC_CONT')then

		begin
			--Sentencia de la consulta de conteo de registros
			v_consulta:='select count(id_gestor_documento)
					    from siat.tgestor_documento gesdoc
					    inner join segu.tusuario usu1 on usu1.id_usuario = gesdoc.id_usuario_reg
						inner join vef.tventa ven on ven.id_venta = gesdoc.id_venta
						inner join param.tmoneda mon on mon.id_moneda = ven.id_moneda
						left join siat.tmotivo_anulacion moa on moa.codigo = ven.codigo_motivo_anulacion
						left join segu.tusuario usu2 on usu2.id_usuario = gesdoc.id_usuario_mod
					    where ';
			
			--Definicion de la respuesta		    
			v_consulta:=v_consulta||v_parametros.filtro;

			--Devuelve la respuesta
			return v_consulta;

		end;
					
	else
					     
		raise exception 'Transaccion inexistente';
					         
	end if;
					
EXCEPTION
					
	WHEN OTHERS THEN
			v_resp='';
			v_resp = pxp.f_agrega_clave(v_resp,'mensaje',SQLERRM);
			v_resp = pxp.f_agrega_clave(v_resp,'codigo_error',SQLSTATE);
			v_resp = pxp.f_agrega_clave(v_resp,'procedimientos',v_nombre_funcion);
			raise exception '%',v_resp;
END;
$BODY$
LANGUAGE 'plpgsql' VOLATILE
COST 100;
ALTER FUNCTION "siat"."ft_gestor_documento_sel"(integer, integer, character varying, character varying) OWNER TO postgres;
