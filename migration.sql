DELETE FROM segurosmycdb.poliza_modificacion_detalle;
DELETE FROM segurosmycdb.poliza_modificacion;
DELETE FROM segurosmycdb.pago_requerimiento;
DELETE FROM segurosmycdb.pago;
DELETE FROM segurosmycdb.porcentaje_fraccionamiento_aseguradora;
DELETE FROM segurosmycdb.porcentaje_fraccionamiento_general;
DELETE FROM segurosmycdb.rubro;
DELETE FROM segurosmycdb.poliza_ubicacion;
DELETE FROM segurosmycdb.poliza_declaracion_hidrocarburo;
DELETE FROM segurosmycdb.poliza_reclamo_detalle;
DELETE FROM segurosmycdb.poliza_vehiculo_reclamo;
DELETE FROM segurosmycdb.poliza_requerimiento;
DELETE FROM segurosmycdb.poliza_declaracion_vehiculo;
DELETE FROM segurosmycdb.poliza_declaracion;
DELETE FROM segurosmycdb.poliza_cobertura_vehiculo;
DELETE FROM segurosmycdb.planilla;
DELETE FROM segurosmycdb.poliza_vehiculo;
DELETE FROM segurosmycdb.poliza_cobertura;
DELETE FROM segurosmycdb.poliza_exclusion;
DELETE FROM segurosmycdb.poliza_inclusion;
UPDATE segurosmycdb.poliza SET poliza_anterior_id = null;
DELETE FROM segurosmycdb.poliza;
DELETE FROM segurosmycdb.contacto_cliente;
DELETE FROM segurosmycdb.contacto_aseguradora;
DELETE FROM segurosmycdb.cliente;
DELETE FROM segurosmycdb.vista;
DELETE FROM segurosmycdb.vehiculo;
DELETE FROM segurosmycdb.tipo_vehiculo;
DELETE FROM segurosmycdb.tipo_poliza_modificacion;
DELETE FROM segurosmycdb.ramo;
DELETE FROM segurosmycdb.petrolera;
DELETE FROM segurosmycdb.municipio;
DELETE FROM segurosmycdb.departamento;
DELETE FROM segurosmycdb.pais;
DELETE FROM segurosmycdb.motivo_anulacion;
DELETE FROM segurosmycdb.modulo;
DELETE FROM segurosmycdb.marca_vehiculo;
DELETE FROM segurosmycdb.impuesto;
DELETE FROM segurosmycdb.frecuencia_pago;
DELETE FROM segurosmycdb.consorcio;
DELETE FROM segurosmycdb.cobertura;
DELETE FROM segurosmycdb.banco;
DELETE FROM segurosmycdb.aseguradora;
DELETE FROM segurosmycdb.area_aseguradora;
DELETE FROM segurosmycdb.users;
DELETE FROM segurosmycdb.perfil;
DELETE FROM segurosmycdb.colaborador;
DELETE FROM segurosmycdb.puesto;
DELETE FROM segurosmycdb.area;
/*DELETE FROM segurosmycdb.migrations;*/


INSERT INTO segurosmycdb.area
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.area;

INSERT INTO segurosmycdb.puesto
SELECT id, nombre, area_id, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.puesto;

INSERT INTO segurosmycdb.perfil
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.perfil;

INSERT INTO segurosmycdb.colaborador(id,nombres,apellidos,sexo,foto,puesto_id,fecha_nacimiento,telefono,celular,email,horario_entrada,sueldo_base,dpi,
dias_vacaciones,fecha_ingreso,en_nomina,aplica_igss,estado,created_at,updated_at,created_by,updated_by)
SELECT id, nombres, apellidos,case sexo when 1 then 'M' when 0 then 'F' else 'F' end, foto,puesto_id,fecha_nacimiento,telefono,celular,email, horario_entrada, 
case when sueldo_base is null then 0 else sueldo_base end, dpi, 15, '2017-01-01',1,1,'A',created_at,updated_at,user_created,user_updated 
 FROM segurosmyc.colaborador;
 
INSERT INTO segurosmycdb.users
SELECT id, username,password,email,colaborador_id,primera_vez,perfil_id,remember_token,'A',created_at,updated_at,user_created,user_updated 
FROM segurosmyc.users;

INSERT INTO segurosmycdb.area_aseguradora
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.area_aseguradora;

INSERT INTO segurosmycdb.aseguradora
SELECT id, nombre,nit,direccion, case when codigo_agente is null then 0 else codigo_agente end,'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.aseguradora;

INSERT INTO segurosmycdb.banco
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.banco;

INSERT INTO segurosmycdb.cobertura
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.cobertura;

INSERT INTO segurosmycdb.consorcio
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.consorcio;

INSERT INTO segurosmycdb.pais
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.pais;

INSERT INTO segurosmycdb.departamento
SELECT id, nombre,pais_id,'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.departamento;

INSERT INTO segurosmycdb.municipio
SELECT id, nombre,departamento_id,'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.municipio;

INSERT INTO segurosmycdb.frecuencia_pago
SELECT id, nombre,meses,'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.frecuencia_pago;

INSERT INTO segurosmycdb.impuesto
SELECT id, nombre,porcentaje,'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.impuesto;

INSERT INTO segurosmycdb.marca_vehiculo
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.marca_vehiculo;

INSERT INTO segurosmycdb.modulo
SELECT id, nombre, 'A',now(),now(),user_created,user_updated FROM segurosmyc.modulo;

INSERT INTO segurosmycdb.motivo_anulacion
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.motivo_anulacion;

INSERT INTO segurosmycdb.petrolera
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.petrolera;

INSERT INTO segurosmycdb.ramo
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.ramo;

INSERT INTO segurosmycdb.tipo_poliza_modificacion
SELECT id, descripcion, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.tipo_poliza_modificacion;

INSERT INTO segurosmycdb.tipo_vehiculo
SELECT id, nombre, 'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.tipo_vehiculo;

INSERT INTO segurosmycdb.vehiculo
SELECT id, tipo_placa,placa,tipo_vehiculo_id,modelo,marca_id,linea,color,numero_motor,numero_chasis,numero_asientos,cilindraje,'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.vehiculo;

INSERT INTO segurosmycdb.vista
SELECT id, nombre,ruta,modulo_id,menu,icono,parametros,'A',now(),now(),'alejandro','alejandro' FROM segurosmyc.vista;

INSERT INTO segurosmycdb.cliente
SELECT id, nombre,nit,pais_fiscal_id,departamento_fiscal_id,municipio_fiscal_id,direccion_fiscal,zona_fiscal,
representante_legal,dpi,telefonos,
nombre_facturacion,nit,pais_facturacion_id,departamento_facturacion_id,municipio_facturacion_id,direccion_facturacion,zona_facturacion,
correo,fecha_nacimiento,
pais_correspondencia_id,departamento_correspondencia_id,municipio_correspondencia_id,direccion_correspondencia,zona_correspondencia,
profesion,genero,tipo_actividad,oficio,consorcio_id,tipo_cliente,'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.cliente;

INSERT INTO segurosmycdb.contacto_aseguradora
SELECT id, nombre,telefonos,celular,empresa_celular,
correo,aseguradora_id,fecha_nacimiento,area_aseguradora_id,extension,observaciones,zona,
'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.contacto_aseguradora;

INSERT INTO segurosmycdb.contacto_cliente
SELECT id, nombre,telefonos,celular,empresa_celular,
correo,cliente_id,fecha_nacimiento,'A',created_at,updated_at,user_created,user_updated FROM segurosmyc.contacto_cliente;

INSERT INTO segurosmycdb.poliza
SELECT id,numero,estado,aseguradora_id,cliente_id,fecha_inicio,fecha_fin,cantidad_pagos,ejecutivo_id,dueno_id,
frecuencia_pago_id,tipo_pago_id,anual_declarativa,pct_iva,pct_fraccionamiento,pct_emision,fecha_solicitud,
fecha_aprobada,fecha_anulada,fecha_renovada,motivo_anulacion_id,fecha_anulacion,ramo_id,
case when ruta is null then 'ver_poliza' else ruta end,dirigida_a,created_at,updated_at,user_created,user_updated,poliza_anterior_id
FROM segurosmyc.poliza;

INSERT INTO segurosmycdb.poliza_inclusion
SELECT * FROM segurosmyc.poliza_inclusion;

INSERT INTO segurosmycdb.poliza_exclusion
SELECT * FROM segurosmyc.poliza_exclusion;

INSERT INTO segurosmycdb.poliza_cobertura
SELECT * FROM segurosmyc.poliza_cobertura;

INSERT INTO segurosmycdb.poliza_vehiculo
SELECT * FROM segurosmyc.poliza_vehiculo;

INSERT INTO segurosmycdb.planilla
SELECT * FROM segurosmyc.planilla;

INSERT INTO segurosmycdb.poliza_cobertura_vehiculo
SELECT * FROM segurosmyc.poliza_cobertura_vehiculo;

INSERT INTO segurosmycdb.poliza_declaracion
SELECT * FROM segurosmyc.poliza_declaracion;

INSERT INTO segurosmycdb.poliza_declaracion_vehiculo
SELECT * FROM segurosmyc.poliza_declaracion_vehiculo;

UPDATE segurosmyc.poliza_requerimiento
SET poliza_declaracion_id = null;

UPDATE segurosmyc.poliza_requerimiento
SET fecha_pago = null
WHERE id in (374,599);

INSERT INTO segurosmycdb.poliza_requerimiento
SELECT * FROM segurosmyc.poliza_requerimiento;

INSERT INTO segurosmycdb.poliza_vehiculo_reclamo
SELECT * FROM segurosmyc.poliza_vehiculo_reclamo;

INSERT INTO segurosmycdb.poliza_reclamo_detalle
SELECT * FROM segurosmyc.poliza_reclamo_detalle;

INSERT INTO segurosmycdb.poliza_declaracion_hidrocarburo
SELECT * FROM segurosmyc.poliza_declaracion_hidrocarburo;

INSERT INTO segurosmycdb.poliza_ubicacion
SELECT * FROM segurosmyc.poliza_ubicacion;

INSERT INTO segurosmycdb.rubro
SELECT * FROM segurosmyc.rubro;

INSERT INTO segurosmycdb.porcentaje_fraccionamiento_general
SELECT id,cantidad_pagos,porcentaje,now(),now(),user_created,user_updated
FROM segurosmyc.porcentaje_fraccionamiento_general;

INSERT INTO segurosmycdb.porcentaje_fraccionamiento_aseguradora
SELECT * FROM segurosmyc.porcentaje_fraccionamiento_aseguradora;

INSERT INTO segurosmycdb.pago
SELECT * FROM segurosmyc.pago;

INSERT INTO segurosmycdb.pago_requerimiento
SELECT * FROM segurosmyc.pago_requerimiento;

INSERT INTO segurosmycdb.poliza_modificacion
SELECT * FROM segurosmyc.poliza_modificacion;

INSERT INTO segurosmycdb.poliza_modificacion_detalle
SELECT * FROM segurosmyc.poliza_modificacion_detalle;
