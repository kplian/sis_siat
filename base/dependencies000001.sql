/***********************************I-DEP-JRR-SIAT-0-16/01/2019******************************************/

select pxp.f_insert_testructura_gui ('SIAT', 'SISTEMA');
select pxp.f_insert_testructura_gui ('SIASINC', 'SIAT');
select pxp.f_insert_testructura_gui ('SIAPROD', 'SIASINC');

/***********************************F-DEP-JRR-SIAT-0-16/01/2019******************************************/
/***********************************I-DEP-JMH-SIAT-0-05/02/2019******************************************/
select pxp.f_insert_testructura_gui ('CUF', 'SIAT');
select pxp.f_insert_testructura_gui ('CUIS', 'SIAT');
select pxp.f_insert_testructura_gui ('SIAT', 'SISTEMA');
select pxp.f_insert_testructura_gui ('SIASINC', 'SIAT');
select pxp.f_insert_testructura_gui ('SIAPROD', 'SIASINC');
/***********************************F-DEP-JMH-SIAT-0-05/02/2019******************************************/