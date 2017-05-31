DELETE FROM segurosmycdb.poliza_modificacion_detalle;
DELETE FROM segurosmycdb.poliza_modificacion;
DELETE FROM segurosmycdb.pago_requerimiento;
DELETE FROM segurosmycdb.pago;
DELETE FROM segurosmycdb.porcentaje_fraccionamiento_aseguradora;
DELETE FROM segurosmycdb.porcentaje_fraccionamiento_general;
DELETE FROM segurosmycdb.bitacora_poliza;
DELETE FROM segurosmycdb.nota_credito;
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
DELETE FROM segurosmycdb.colaborador;
DELETE FROM segurosmycdb.puesto;
DELETE FROM segurosmycdb.area;
DELETE FROM segurosmycdb.perfil;

INSERT INTO segurosmycdb.perfil
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.perfil;

INSERT INTO segurosmycdb.area
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.area;

INSERT INTO segurosmycdb.puesto
SELECT id, nombre, area_id, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.puesto;

INSERT INTO segurosmycdb.colaborador
SELECT id,nombres,apellidos,'M','profile-m.png',puesto_id,fecha_nacimiento,telefono,celular,email,'8:00',0,
dpi,15,'2017-01-01',1,0,'A',created_at,updated_at,user_created,user_updated
FROM segurosmycprod.colaborador;

INSERT INTO segurosmycdb.users
SELECT id,username,password,email,colaborador_id,primera_vez,perfil_id,remember_token,'A',created_at,updated_at,
user_created,user_updated
FROM segurosmycprod.users;

INSERT INTO segurosmycdb.area_aseguradora
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.area_aseguradora;

INSERT INTO segurosmycdb.aseguradora
SELECT id, nombre,nit,direccion,0,'A', created_at, updated_at, user_created, user_updated 
FROM segurosmycprod.aseguradora;

INSERT INTO segurosmycdb.banco
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.banco;

INSERT INTO segurosmycdb.cobertura
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.cobertura;

INSERT INTO segurosmycdb.consorcio
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.consorcio;

INSERT INTO segurosmycdb.frecuencia_pago
SELECT id, nombre, meses, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.frecuencia_pago;

INSERT INTO segurosmycdb.impuesto
SELECT id, nombre, porcentaje, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.impuesto;

INSERT INTO segurosmycdb.marca_vehiculo
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.marca_vehiculo;

INSERT INTO segurosmycdb.modulo
SELECT id, nombre, 'A', now(), now(), user_created, user_updated FROM segurosmycprod.modulo;

INSERT INTO segurosmycdb.motivo_anulacion
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.motivo_anulacion;

INSERT INTO segurosmycdb.pais
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.pais;

INSERT INTO segurosmycdb.departamento
SELECT id, nombre, pais_id, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.departamento;

INSERT INTO segurosmycdb.municipio
SELECT id, nombre, departamento_id, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.municipio;

INSERT INTO segurosmycdb.petrolera
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.petrolera;

INSERT INTO segurosmycdb.ramo
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.ramo;

INSERT INTO segurosmycdb.tipo_poliza_modificacion
SELECT id, descripcion, 'A', created_at, updated_at, user_created, user_updated 
FROM segurosmycprod.tipo_poliza_modificacion;

INSERT INTO segurosmycdb.tipo_vehiculo
SELECT id, nombre, 'A', created_at, updated_at, user_created, user_updated FROM segurosmycprod.tipo_vehiculo;

INSERT INTO segurosmycdb.vehiculo
SELECT id,tipo_placa,placa,tipo_vehiculo_id,modelo,marca_id,linea,color,numero_motor,numero_chasis,
numero_asientos,cilindraje,'A',created_at,updated_at,user_created,user_updated
FROM segurosmycprod.vehiculo;

INSERT INTO segurosmycdb.vista
SELECT id, nombre, ruta,modulo_id,menu,icono,parametros, 'A', now(), now(), user_created, user_updated 
FROM segurosmycprod.vista;

INSERT INTO segurosmycdb.cliente
SELECT id,nombre,nit,pais_fiscal_id,departamento_fiscal_id,municipio_fiscal_id,direccion_fiscal,zona_fiscal,
representante_legal,dpi,telefonos,nombre_facturacion,nit,pais_facturacion_id,departamento_facturacion_id,
municipio_facturacion_id,direccion_facturacion,zona_facturacion,correo,fecha_nacimiento,pais_correspondencia_id,
departamento_correspondencia_id,municipio_correspondencia_id,direccion_correspondencia,zona_correspondencia,
profesion,genero,tipo_actividad,oficio,consorcio_id,tipo_cliente,'A',created_at,updated_at,user_created,
user_updated
FROM segurosmycprod.cliente;

INSERT INTO segurosmycdb.contacto_aseguradora
SELECT id,nombre,telefonos,celular,empresa_celular,correo,aseguradora_id,fecha_nacimiento,area_aseguradora_id,
extension,observaciones,zona,'A',created_at,updated_at,user_created,user_updated
FROM segurosmycprod.contacto_aseguradora;

INSERT INTO segurosmycdb.contacto_cliente
SELECT id,nombre,telefonos,celular,empresa_celular,correo,cliente_id,fecha_nacimiento,'A',
created_at,updated_at,user_created,user_updated
FROM segurosmycprod.contacto_cliente;

INSERT INTO segurosmycdb.poliza
SELECT id,numero,estado,aseguradora_id,cliente_id,fecha_inicio,fecha_fin,cantidad_pagos,
ejecutivo_id,dueno_id,frecuencia_pago_id,tipo_pago_id,anual_declarativa,
pct_iva,pct_fraccionamiento,pct_emision,fecha_solicitud,fecha_aprobada,
fecha_anulada,fecha_renovada,motivo_anulacion_id,fecha_anulacion,poliza_anterior_id,
ramo_id,dirigida_a,created_at,updated_at,user_created,user_updated
FROM segurosmycprod.poliza;

INSERT INTO segurosmycdb.poliza_inclusion
SELECT * FROM segurosmycprod.poliza_inclusion;

INSERT INTO segurosmycdb.poliza_exclusion
SELECT * FROM segurosmycprod.poliza_exclusion;

INSERT INTO segurosmycdb.poliza_cobertura
SELECT * FROM segurosmycprod.poliza_cobertura;

INSERT INTO segurosmycdb.poliza_vehiculo
SELECT * FROM segurosmycprod.poliza_vehiculo;

INSERT INTO segurosmycdb.planilla
SELECT * FROM segurosmycprod.planilla;

INSERT INTO segurosmycdb.poliza_cobertura_vehiculo
SELECT * FROM segurosmycprod.poliza_cobertura_vehiculo;

INSERT INTO segurosmycdb.poliza_declaracion
SELECT * FROM segurosmycprod.poliza_declaracion;

INSERT INTO segurosmycdb.poliza_declaracion_vehiculo
SELECT * FROM segurosmycprod.poliza_declaracion_vehiculo;

UPDATE segurosmycdb.poliza_requerimiento
SET planilla_id = null
WHERE planilla_id = 0;

UPDATE segurosmycprod.poliza_requerimiento
SET fecha_pago = null
WHERE fecha_pago = '2016-11-29';

INSERT INTO segurosmycdb.poliza_requerimiento
SELECT * FROM segurosmycprod.poliza_requerimiento;

INSERT INTO segurosmycdb.poliza_vehiculo_reclamo
SELECT * FROM segurosmycprod.poliza_vehiculo_reclamo;

INSERT INTO segurosmycdb.poliza_reclamo_detalle
SELECT * FROM segurosmycprod.poliza_reclamo_detalle;

INSERT INTO segurosmycdb.nota_credito
SELECT * FROM segurosmycprod.nota_credito;

INSERT INTO segurosmycdb.bitacora_poliza
SELECT * FROM segurosmycprod.bitacora_poliza;

INSERT INTO segurosmycdb.porcentaje_fraccionamiento_aseguradora
SELECT * FROM segurosmycprod.porcentaje_fraccionamiento_aseguradora;

UPDATE segurosmycprod.pago
SET fecha_pago = '2016-11-29'
WHERE id = 268;

UPDATE segurosmycprod.pago
SET fecha_pago = '2016-11-29'
WHERE id = 298;

INSERT INTO segurosmycdb.pago
SELECT * FROM segurosmycprod.pago;

INSERT INTO segurosmycdb.pago_requerimiento
SELECT * FROM segurosmycprod.pago_requerimiento;

INSERT INTO segurosmycdb.poliza_modificacion
SELECT * FROM segurosmycprod.poliza_modificacion;

INSERT INTO segurosmycdb.poliza_modificacion_detalle
SELECT * FROM segurosmycprod.poliza_modificacion_detalle;