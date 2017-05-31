<?php
date_default_timezone_set('America/Guatemala');

Route::group(['middleware' => 'auth'], function(){

	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
	Route::get('/', ['as'=>'inicio', function()
	{
		return Redirect::route('login');
	}]);
	
	Route::get('cambiar-contrasena', ['as' => 'cambiar_password', 'uses' => 'UserController@mostrarCambiarPassword']);
	Route::post('cambiar-contrasena', ['as' => 'cambiar_password', 'uses' => 'UserController@cambiarPassword']);

	/* ADMINISTRACION */
	Route::get('dashboard','AdminController@mostrarDashboard')->name('dashboard');
	/* RECURSOS HUMANOS */
	Route::get('Colaboradores/listado', ['as' => 'colaboradores', 'uses' => 'ColaboradorController@listado']);
	Route::get('Colaboradores/agregar/', ['as' => 'agregar_colaborador', 'uses' => 'ColaboradorController@mostrarAgregar']);
	Route::post('Colaboradores/agregar/', ['as' => 'agregar_colaborador', 'uses' => 'ColaboradorController@agregar']);
	Route::get('Colaboradores/editar/{id}', ['as' => 'editar_colaborador', 'uses' => 'ColaboradorController@mostrarEditar']);
	Route::put('Colaboradores/editar/{id}', ['as' => 'editar_colaborador', 'uses' => 'ColaboradorController@editar']);
	Route::get('Colaboradores/ver/{id}', ['as' => 'ver_colaborador', 'uses' => 'ColaboradorController@mostrarVer']);

	/*INGRESOS SALARIOS*/
	Route::get('Ingreso-Salario/listado', ['as' => 'ingresos_salarios', 'uses' => 'IngresoSalarioController@listado']);
	Route::get('Ingreso-Salario/agregar/', ['as' => 'agregar_ingreso_salario', 'uses' => 'IngresoSalarioController@mostrarAgregar']);
	Route::post('Ingreso-Salario/agregar/', ['as' => 'agregar_ingreso_salario', 'uses' => 'IngresoSalarioController@agregar']);
	Route::get('Ingreso-Salario/editar/{id}', ['as' => 'editar_ingreso_salario', 'uses' => 'IngresoSalarioController@mostrarEditar']);
	Route::put('Ingreso-Salario/editar/{id}', ['as' => 'editar_ingreso_salario', 'uses' => 'IngresoSalarioController@editar']);

	/*INGRESOS COLABORADORES*/
	/*INGRESOS SALARIOS*/
	Route::get('Ingreso-Colaborador/agregar/{colaboradorId}', ['as' => 'agregar_ingreso_colaborador', 'uses' => 'IngresoColaboradorController@mostrarAgregar']);
	Route::post('Ingreso-Colaborador/agregar/{colaboradorId}', ['as' => 'agregar_ingreso_colaborador', 'uses' => 'IngresoColaboradorController@agregar']);
	Route::get('Ingreso-Colaborador/editar/{id}', ['as' => 'editar_ingreso_colaborador', 'uses' => 'IngresoColaboradorController@mostrarEditar']);
	Route::put('Ingreso-Colaborador/editar/{id}', ['as' => 'editar_ingreso_colaborador', 'uses' => 'IngresoColaboradorController@editar']);

	/*PRESTAMOS*/
	Route::get('Prestamos/agregar/{colaboradorId}', ['as' => 'agregar_prestamo', 'uses' => 'PrestamoController@mostrarAgregar']);
	Route::post('Prestamos/agregar/{colaboradorId}', ['as' => 'agregar_prestamo', 'uses' => 'PrestamoController@agregar']);
	Route::get('Prestamos/editar/{id}', ['as' => 'editar_prestamo', 'uses' => 'PrestamoController@mostrarEditar']);
	Route::put('Prestamos/editar/{id}', ['as' => 'editar_prestamo', 'uses' => 'PrestamoController@editar']);

	Route::get('Prestamos-Cuota/editar/{id}', ['as' => 'editar_prestamo_cuota', 'uses' => 'PrestamoCuotaController@mostrarEditar']);
	Route::put('Prestamos-Cuota/editar/{id}', ['as' => 'editar_prestamo_cuota', 'uses' => 'PrestamoCuotaController@editar']);

	/*VACACIONES*/
	Route::get('Vacaciones/agregar/{colaboradorId}', ['as'=>'agregar_vacacion_colaborador', 'uses' => 'VacacionColaboradorController@mostrarAgregar']);
	Route::post('Vacaciones/agregar/{colaboradorId}', ['as' => 'agregar_vacacion_colaborador', 'uses' => 'VacacionColaboradorController@agregar']);
	Route::get('Vacaciones/editar/{id}', ['as' => 'editar_vacacion_colaborador', 'uses' => 'VacacionColaboradorController@mostrarEditar']);
	Route::put('Vacaciones/editar/{id}', ['as' => 'editar_vacacion_colaborador', 'uses' => 'VacacionColaboradorController@editar']);

	/*SUSPENSIONES IGSS*/
	Route::get('Suspensiones-Igss/agregar/{colaboradorId}', ['as'=>'agregar_suspension_igss_colaborador', 'uses' => 'SuspensionIgssColaboradorController@mostrarAgregar']);
	Route::post('Suspensiones-Igss/agregar/{colaboradorId}', ['as'=>'agregar_suspension_igss_colaborador','uses'=>'SuspensionIgssColaboradorController@agregar']);
	Route::get('Suspensiones-Igss/editar/{id}', ['as' => 'editar_suspension_igss_colaborador', 'uses' => 'SuspensionIgssColaboradorController@mostrarEditar']);
	Route::put('Suspensiones-Igss/editar/{id}', ['as' => 'editar_suspension_igss_colaborador', 'uses' => 'SuspensionIgssColaboradorController@editar']);

	/* RECURSOS HUMANOS */
	Route::get('Ausencias/listado', ['as' => 'ausencias', 'uses' => 'AusenciaController@listado']);
	Route::get('Ausencias/agregar/', ['as' => 'agregar_ausencia', 'uses' => 'AusenciaController@mostrarAgregar']);
	Route::post('Ausencias/agregar/', ['as' => 'agregar_ausencia', 'uses' => 'AusenciaController@agregar']);
	Route::get('Ausencias/editar/{id}', ['as' => 'editar_ausencia', 'uses' => 'AusenciaController@mostrarEditar']);
	Route::put('Ausencias/editar/{id}', ['as' => 'editar_ausencia', 'uses' => 'AusenciaController@editar']);

	/*AUSENCIAS COLABORADOR*/
	Route::get('Ausencias-Colaboradores/agregar/{colaboradorId}', ['as'=>'agregar_ausencia_colaborador', 'uses' => 'AusenciaColaboradorController@mostrarAgregar']);
	Route::post('Ausencias-Colaboradores/agregar/{colaboradorId}', ['as' => 'agregar_ausencia_colaborador', 'uses' => 'AusenciaColaboradorController@agregar']);
	Route::get('Ausencias-Colaboradores/editar/{id}', ['as' => 'editar_ausencia_colaborador', 'uses' => 'AusenciaColaboradorController@mostrarEditar']);
	Route::put('Ausencias-Colaboradores/editar/{id}', ['as' => 'editar_ausencia_colaborador', 'uses' => 'AusenciaColaboradorController@editar']);

	/* TIPOS DE DESCUENTOS */
	Route::get('Tipos-Descuentos/listado', ['as' => 'tipos_descuentos', 'uses' => 'TipoDescuentoController@listado']);
	Route::get('Tipos-Descuentos/agregar', ['as' => 'agregar_tipo_descuento', 'uses' => 'TipoDescuentoController@mostrarAgregar']);	
	Route::post('Tipos-Descuentos/agregar', ['as' => 'agregar_tipo_descuento', 'uses' => 'TipoDescuentoController@agregar']);	
	Route::get('Tipos-Descuentos/editar/{id}', ['as' => 'editar_tipo_descuento', 'uses' => 'TipoDescuentoController@mostrarEditar']);	
	Route::put('Tipos-Descuentos/editar/{id}', ['as' => 'editar_tipo_descuento', 'uses' => 'TipoDescuentoController@editar']);

	/* DESCUENTOS COLABORADOR */
	Route::get('Descuentos-Colaborador/agregar/{colaboradorId}', ['as' => 'agregar_descuento_colaborador', 'uses' => 'DescuentoColaboradorController@mostrarAgregar']);	
	Route::post('Descuentos-Colaborador/agregar/{colaboradorId}', ['as' => 'agregar_descuento_colaborador', 'uses' => 'DescuentoColaboradorController@agregar']);	
	Route::get('Descuentos-Colaborador/editar/{id}', ['as' => 'editar_descuento_colaborador', 'uses'=>'DescuentoColaboradorController@mostrarEditar']);	
	Route::put('Descuentos-Colaborador/editar/{id}', ['as' => 'editar_descuento_colaborador', 'uses' => 'DescuentoColaboradorController@editar']);

	/* TIPOS DE NOMINAS */
	Route::get('Tipos-Nominas/listado', ['as' => 'tipos_nominas', 'uses' => 'TipoNominaController@listado']);
	Route::get('Tipos-Nominas/agregar', ['as' => 'agregar_tipo_nomina', 'uses' => 'TipoNominaController@mostrarAgregar']);	
	Route::post('Tipos-Nominas/agregar', ['as' => 'agregar_tipo_nomina', 'uses' => 'TipoNominaController@agregar']);	
	Route::get('Tipos-Nominas/editar/{id}', ['as' => 'editar_tipo_nomina', 'uses' => 'TipoNominaController@mostrarEditar']);	
	Route::put('Tipos-Nominas/editar/{id}', ['as' => 'editar_tipo_nomina', 'uses' => 'TipoNominaController@editar']);

	/* NOMINAS */
	Route::get('Nominas/listado', ['as' => 'nominas', 'uses' => 'NominaController@listado']);
	Route::get('Nominas/agregar', ['as' => 'agregar_nomina', 'uses' => 'NominaController@mostrarAgregar']);	
	Route::post('Nominas/agregar', ['as' => 'agregar_nomina', 'uses' => 'NominaController@agregar']);	
	Route::get('Nominas/editar/{id}', ['as' => 'editar_nomina', 'uses' => 'NominaController@mostrarEditar']);	
	Route::put('Nominas/editar/{id}', ['as' => 'editar_nomina', 'uses' => 'NominaController@editar']);
	Route::get('Nominas/generar/{id}', ['as' => 'generar_nomina', 'uses' => 'NominaController@generar']);
	Route::get('Nominas/ver/{id}', ['as' => 'ver_nomina', 'uses' => 'NominaController@ver']);

	/* CLIENTES */
	Route::get('Cliente/listado', ['as' => 'clientes', 'uses' => 'ClienteController@listado']);
	Route::get('Cliente/agregar/{tipo_cliente}', ['as' => 'agregar_cliente', 'uses' => 'ClienteController@mostrarAgregar']);
	Route::post('Cliente/agregar/{tipo_cliente}', ['as' => 'agregar_cliente', 'uses' => 'ClienteController@agregar']);
	Route::get('Cliente/editar/{id}', ['as' => 'editar_cliente', 'uses' => 'ClienteController@mostrarEditar']);
	Route::put('Cliente/editar/{id}', ['as' => 'editar_cliente', 'uses' => 'ClienteController@editar']);
	Route::get('Cliente/ver/{id}', ['as' => 'ver_cliente', 'uses' => 'ClienteController@mostrarVer']);

	/* CONTACTOS DE CLIENTES*/
	Route::get('Contacto-Cliente/listado/{clienteId}', ['as' => 'contactos_clientes', 'uses' => 'ContactoClienteController@listado']);
	Route::get('Contacto-Cliente/agregar/{clienteId}', ['as' => 'agregar_contacto_cliente', 'uses' => 'ContactoClienteController@mostrarAgregar']);
	Route::post('Contacto-Cliente/agregar/{clienteId}', ['as' => 'agregar_contacto_cliente', 'uses' => 'ContactoClienteController@agregar']);
	Route::get('Contacto-Cliente/editar/{id}', ['as' => 'editar_contacto_cliente', 'uses' => 'ContactoClienteController@mostrarEditar']);
	Route::put('Contacto-Cliente/editar/{id}', ['as' => 'editar_contacto_cliente', 'uses' => 'ContactoClienteController@editar']);

	/* USUARIOS */
	Route::get('Usuarios/listado', ['as' => 'usuarios', 'uses' => 'UserController@mostrarUsuarios']);
	Route::get('Usuarios/agregar/', ['as' => 'agregar_usuario', 'uses' => 'UserController@mostrarAgregar']);
	Route::post('Usuarios/agregar/', ['as' => 'agregar_usuario', 'uses' => 'UserController@agregar']);
	Route::get('Usuarios/editar/{id}', ['as' => 'editar_usuario', 'uses' => 'UserController@mostrarEditar']);
	Route::put('Usuarios/editar/{id}', ['as' => 'editar_usuario', 'uses' => 'UserController@editar']);

	/* PERFILES */
	Route::get('Perfil/listado', ['as' => 'perfiles', 'uses' => 'PerfilController@listado']);
	Route::get('Perfil/agregar/', ['as' => 'agregar_perfil', 'uses' => 'PerfilController@mostrarAgregar']);
	Route::post('Perfil/agregar/', ['as' => 'agregar_perfil', 'uses' => 'PerfilController@agregar']);
	Route::get('Perfil/editar/{id}', ['as' => 'editar_perfil', 'uses' => 'PerfilController@mostrarEditar']);
	Route::put('Perfil/editar/{id}', ['as' => 'editar_perfil', 'uses' => 'PerfilController@editar']);
	Route::get('Perfil/permisos/{id}', ['as' => 'permisos', 'uses' => 'PermisoController@permisos']);	
	Route::post('Perfil/permisos/{id}', ['as' => 'permisos', 'uses' => 'PermisoController@editar']);	

	/* PAIS */
	Route::get('Paises/listado', ['as' => 'paises', 'uses' => 'PaisController@listado']);
	Route::get('Paises/agregar', ['as' => 'agregar_pais', 'uses' => 'PaisController@mostrarAgregar']);	
	Route::post('Paises/agregar', ['as' => 'agregar_pais', 'uses' => 'PaisController@agregar']);	
	Route::get('Paises/editar/{id}', ['as' => 'editar_pais', 'uses' => 'PaisController@mostrarEditar']);	
	Route::put('Paises/editar/{id}', ['as' => 'editar_pais', 'uses' => 'PaisController@editar']);

	/* DEPARTAMENTO */
	Route::get('Departamentos/listado/{paisId}', ['as' => 'departamentos', 'uses' => 'DepartamentoController@listado']);
	Route::get('Departamentos/agregar/{paisId}', ['as' => 'agregar_departamento', 'uses' => 'DepartamentoController@mostrarAgregar']);	
	Route::post('Departamentos/agregar/{paisId}', ['as' => 'agregar_departamento', 'uses' => 'DepartamentoController@agregar']);	
	Route::get('Departamentos/editar/{id}', ['as' => 'editar_departamento', 'uses' => 'DepartamentoController@mostrarEditar']);	
	Route::put('Departamentos/editar/{id}', ['as' => 'editar_departamento', 'uses' => 'DepartamentoController@editar']);

	/* MUNICIPIO */
	Route::get('Municipios/listado/{departamentoId}', ['as' => 'municipios', 'uses' => 'MunicipioController@listado']);
	Route::get('Municipios/agregar/{departamentoId}', ['as' => 'agregar_municipio', 'uses' => 'MunicipioController@mostrarAgregar']);	
	Route::post('Municipios/agregar/{departamentoId}', ['as' => 'agregar_municipio', 'uses' => 'MunicipioController@agregar']);	
	Route::get('Municipios/editar/{id}', ['as' => 'editar_municipio', 'uses' => 'MunicipioController@mostrarEditar']);	
	Route::put('Municipios/editar/{id}', ['as' => 'editar_municipio', 'uses' => 'MunicipioController@editar']);

	/* AREA */
	Route::get('Areas/listado', ['as' => 'areas', 'uses' => 'AreaController@listado']);
	Route::get('Areas/agregar', ['as' => 'agregar_area', 'uses' => 'AreaController@mostrarAgregar']);	
	Route::post('Areas/agregar', ['as' => 'agregar_area', 'uses' => 'AreaController@agregar']);	
	Route::get('Areas/editar/{id}', ['as' => 'editar_area', 'uses' => 'AreaController@mostrarEditar']);	
	Route::put('Areas/editar/{id}', ['as' => 'editar_area', 'uses' => 'AreaController@editar']);

	/* RAMO */
	Route::get('Ramos/listado', ['as' => 'ramos', 'uses' => 'RamoController@listado']);
	Route::get('Ramos/agregar', ['as' => 'agregar_ramo', 'uses' => 'RamoController@mostrarAgregar']);	
	Route::post('Ramos/agregar', ['as' => 'agregar_ramo', 'uses' => 'RamoController@agregar']);	
	Route::get('Ramos/editar/{id}', ['as' => 'editar_ramo', 'uses' => 'RamoController@mostrarEditar']);	
	Route::put('Ramos/editar/{id}', ['as' => 'editar_ramo', 'uses' => 'RamoController@editar']);

	/* RUBRO */
	Route::get('Rubros/listado', ['as' => 'rubros', 'uses' => 'RubroController@listado']);
	Route::get('Rubros/agregar', ['as' => 'agregar_rubro', 'uses' => 'RubroController@mostrarAgregar']);	
	Route::post('Rubros/agregar', ['as' => 'agregar_rubro', 'uses' => 'RubroController@agregar']);	
	Route::get('Rubros/editar/{id}', ['as' => 'editar_rubro', 'uses' => 'RubroController@mostrarEditar']);	
	Route::put('Rubros/editar/{id}', ['as' => 'editar_rubro', 'uses' => 'RubroController@editar']);

	/* COBERTURA */
	Route::get('Coberturas/listado', ['as' => 'coberturas', 'uses' => 'CoberturaController@listado']);
	Route::get('Coberturas/agregar', ['as' => 'agregar_cobertura', 'uses' => 'CoberturaController@mostrarAgregar']);	
	Route::post('Coberturas/agregar', ['as' => 'agregar_cobertura', 'uses' => 'CoberturaController@agregar']);	
	Route::get('Coberturas/editar/{id}', ['as' => 'editar_cobertura', 'uses' => 'CoberturaController@mostrarEditar']);	
	Route::put('Coberturas/editar/{id}', ['as' => 'editar_cobertura', 'uses' => 'CoberturaController@editar']);

	/* PETROLERA */
	Route::get('Petroleras/listado', ['as' => 'petroleras', 'uses' => 'PetroleraController@listado']);
	Route::get('Petroleras/agregar', ['as' => 'agregar_petrolera', 'uses' => 'PetroleraController@mostrarAgregar']);	
	Route::post('Petroleras/agregar', ['as' => 'agregar_petrolera', 'uses' => 'PetroleraController@agregar']);	
	Route::get('Petroleras/editar/{id}', ['as' => 'editar_petrolera', 'uses' => 'PetroleraController@mostrarEditar']);	
	Route::put('Petroleras/editar/{id}', ['as' => 'editar_petrolera', 'uses' => 'PetroleraController@editar']);

	/* PUESTO */
	Route::get('Puestos/listado', ['as' => 'puestos', 'uses' => 'PuestoController@listado']);
	Route::get('Puestos/agregar', ['as' => 'agregar_puesto', 'uses' => 'PuestoController@mostrarAgregar']);	
	Route::post('Puestos/agregar', ['as' => 'agregar_puesto', 'uses' => 'PuestoController@agregar']);	
	Route::get('Puestos/editar/{id}', ['as' => 'editar_puesto', 'uses' => 'PuestoController@mostrarEditar']);	
	Route::put('Puestos/editar/{id}', ['as' => 'editar_puesto', 'uses' => 'PuestoController@editar']);

	/* BANCO */
	Route::get('Bancos/listado', ['as' => 'bancos', 'uses' => 'BancoController@listado']);
	Route::get('Bancos/agregar', ['as' => 'agregar_banco', 'uses' => 'BancoController@mostrarAgregar']);	
	Route::post('Bancos/agregar', ['as' => 'agregar_banco', 'uses' => 'BancoController@agregar']);	
	Route::get('Bancos/editar/{id}', ['as' => 'editar_banco', 'uses' => 'BancoController@mostrarEditar']);	
	Route::put('Bancos/editar/{id}', ['as' => 'editar_banco', 'uses' => 'BancoController@editar']);

	/* MODULO */
	Route::get('Modulos/listado', ['as' => 'modulos', 'uses' => 'ModuloController@listado']);
	Route::get('Modulos/agregar', ['as' => 'agregar_modulo', 'uses' => 'ModuloController@mostrarAgregar']);	
	Route::post('Modulos/agregar', ['as' => 'agregar_modulo', 'uses' => 'ModuloController@agregar']);	
	Route::get('Modulos/editar/{id}', ['as' => 'editar_modulo', 'uses' => 'ModuloController@mostrarEditar']);	
	Route::put('Modulos/editar/{id}', ['as' => 'editar_modulo', 'uses' => 'ModuloController@editar']);

	/* MODULO */
	Route::get('Motivos-Anulacion/listado', ['as' => 'motivos_anulacion', 'uses' => 'MotivoAnulacionController@listado']);
	Route::get('Motivos-Anulacion/agregar', ['as' => 'agregar_motivo_anulacion', 'uses' => 'MotivoAnulacionController@mostrarAgregar']);	
	Route::post('Motivos-Anulacion/agregar', ['as' => 'agregar_motivo_anulacion', 'uses' => 'MotivoAnulacionController@agregar']);	
	Route::get('Motivos-Anulacion/editar/{id}', ['as' => 'editar_motivo_anulacion', 'uses' => 'MotivoAnulacionController@mostrarEditar']);	
	Route::put('Motivos-Anulacion/editar/{id}', ['as' => 'editar_motivo_anulacion', 'uses' => 'MotivoAnulacionController@editar']);

	/* VISTA */
	Route::get('Vistas/listado', ['as' => 'vistas', 'uses' => 'VistaController@listado']);
	Route::get('Vistas/agregar', ['as' => 'agregar_vista', 'uses' => 'VistaController@mostrarAgregar']);	
	Route::post('Vistas/agregar', ['as' => 'agregar_vista', 'uses' => 'VistaController@agregar']);	
	Route::get('Vistas/editar/{id}', ['as' => 'editar_vista', 'uses' => 'VistaController@mostrarEditar']);	
	Route::put('Vistas/editar/{id}', ['as' => 'editar_vista', 'uses' => 'VistaController@editar']);

	/* IMPUESTO */
	Route::get('Impuestos/listado', ['as' => 'impuestos', 'uses' => 'ImpuestoController@listado']);
	Route::get('Impuestos/agregar', ['as' => 'agregar_impuesto', 'uses' => 'ImpuestoController@mostrarAgregar']);	
	Route::post('Impuestos/agregar', ['as' => 'agregar_impuesto', 'uses' => 'ImpuestoController@agregar']);	
	Route::get('Impuestos/editar/{id}', ['as' => 'editar_impuesto', 'uses' => 'ImpuestoController@mostrarEditar']);	
	Route::put('Impuestos/editar/{id}', ['as' => 'editar_impuesto', 'uses' => 'ImpuestoController@editar']);

	/* ASEGURADORAS */
	Route::get('Aseguradoras/listado', ['as' => 'aseguradoras', 'uses' => 'AseguradoraController@listado']);
	Route::get('Aseguradoras/agregar/', ['as' => 'agregar_aseguradora', 'uses' => 'AseguradoraController@mostrarAgregar']);
	Route::post('Aseguradoras/agregar/', ['as' => 'agregar_aseguradora', 'uses' => 'AseguradoraController@agregar']);
	Route::get('Aseguradoras/editar/{id}', ['as' => 'editar_aseguradora', 'uses' => 'AseguradoraController@mostrarEditar']);
	Route::put('Aseguradoras/editar/{id}', ['as' => 'editar_aseguradora', 'uses' => 'AseguradoraController@editar']);
	Route::get('Aseguradoras/ver/{id}', ['as' => 'ver_aseguradora', 'uses' => 'AseguradoraController@mostrarVer']);

	/* CONTACTOS DE ASEGURADORA */
	Route::get('Contacto-Aseguradora/listado/{aseguradoraId}', ['as' => 'contactos_aseguradoras', 'uses' => 'ContactoAseguradoraController@listado']);
	Route::get('Contacto-Aseguradora/agregar/{aseguradoraId}', ['as' => 'agregar_contacto_aseguradora', 'uses' => 'ContactoAseguradoraController@mostrarAgregar']);
	Route::post('Contacto-Aseguradora/agregar/{aseguradoraId}', ['as' => 'agregar_contacto_aseguradora', 'uses' => 'ContactoAseguradoraController@agregar']);
	Route::get('Contacto-Aseguradora/editar/{id}', ['as' => 'editar_contacto_aseguradora', 'uses' => 'ContactoAseguradoraController@mostrarEditar']);
	Route::put('Contacto-Aseguradora/editar/{id}', ['as' => 'editar_contacto_aseguradora', 'uses' => 'ContactoAseguradoraController@editar']);

	/* AREAS DE ASEGURADORA */
	Route::get('Area-Aseguradora/listado', ['as' => 'areas_aseguradoras', 'uses' => 'AreaAseguradoraController@listado']);
	Route::get('Area-Aseguradora/agregar', ['as' => 'agregar_area_aseguradora', 'uses' => 'AreaAseguradoraController@mostrarAgregar']);
	Route::post('Area-Aseguradora/agregar', ['as' => 'agregar_area_aseguradora', 'uses' => 'AreaAseguradoraController@agregar']);
	Route::get('Area-Aseguradora/editar/{id}', ['as' => 'editar_area_aseguradora', 'uses' => 'AreaAseguradoraController@mostrarEditar']);
	Route::put('Area-Aseguradora/editar/{id}', ['as' => 'editar_area_aseguradora', 'uses' => 'AreaAseguradoraController@editar']);

	/* CONSORCIO */
	Route::get('Consorcios/listado', ['as' => 'consorcios', 'uses' => 'ConsorcioController@listado']);
	Route::get('Consorcios/agregar', ['as' => 'agregar_consorcio', 'uses' => 'ConsorcioController@mostrarAgregar']);	
	Route::post('Consorcios/agregar', ['as' => 'agregar_consorcio', 'uses' => 'ConsorcioController@agregar']);	
	Route::get('Consorcios/editar/{id}', ['as' => 'editar_consorcio', 'uses' => 'ConsorcioController@mostrarEditar']);	
	Route::put('Consorcios/editar/{id}', ['as' => 'editar_consorcio', 'uses' => 'ConsorcioController@editar']);

	/* PRODUCTO */
	Route::get('Productos/listado', ['as' => 'productos', 'uses' => 'ProductoController@listado']);
	Route::get('Productos/agregar', ['as' => 'agregar_producto', 'uses' => 'ProductoController@mostrarAgregar']);	
	Route::post('Productos/agregar', ['as' => 'agregar_producto', 'uses' => 'ProductoController@agregar']);	
	Route::get('Productos/editar/{id}', ['as' => 'editar_producto', 'uses' => 'ProductoController@mostrarEditar']);	
	Route::put('Productos/editar/{id}', ['as' => 'editar_producto', 'uses' => 'ProductoController@editar']);

	/* PRODUCTO */
	Route::get('Productos/coberturas/{productoId}', ['as' => 'producto_coberturas', 'uses' => 'ProductoCoberturaController@listado']);
	Route::get('Productos/agregar-coberturas/{productoId}', ['as' => 'agregar_producto_coberturas', 'uses' => 'ProductoCoberturaController@mostrarAgregar']);	
	Route::post('Productos/agregar-coberturas/{productoId}', ['as' => 'agregar_producto_coberturas', 'uses' => 'ProductoCoberturaController@agregar']);	
	Route::get('Productos/editar-coberturas/{productoId}', ['as' => 'editar_producto_cobertura', 'uses' => 'ProductoCoberturaController@mostrarEditar']);	
	Route::put('Productos/editar-coberturas/{productoId}', ['as' => 'editar_producto_cobertura', 'uses' => 'ProductoCoberturaController@editar']);

	/* VEHICULO */
	Route::get('Vehiculos/listado', ['as' => 'vehiculos', 'uses' => 'VehiculoController@listado']);
	Route::get('Vehiculos/agregar', ['as' => 'agregar_vehiculo', 'uses' => 'VehiculoController@mostrarAgregar']);	
	Route::post('Vehiculos/agregar', ['as' => 'agregar_vehiculo', 'uses' => 'VehiculoController@agregar']);	
	Route::get('Vehiculos/editar/{id}', ['as' => 'editar_vehiculo', 'uses' => 'VehiculoController@mostrarEditar']);	
	Route::put('Vehiculos/editar/{id}', ['as' => 'editar_vehiculo', 'uses' => 'VehiculoController@editar']);
	Route::get('Vehiculos/ver/{id}', ['as' => 'ver_vehiculo', 'uses' => 'VehiculoController@mostrarVer']);	

	/* TIPOS DE VEHICULO */
	Route::get('Tipos-Vehiculos/listado', ['as' => 'tipos_vehiculos', 'uses' => 'TipoVehiculoController@listado']);
	Route::get('Tipos-Vehiculos/agregar', ['as' => 'agregar_tipo_vehiculo', 'uses' => 'TipoVehiculoController@mostrarAgregar']);	
	Route::post('Tipos-Vehiculos/agregar', ['as' => 'agregar_tipo_vehiculo', 'uses' => 'TipoVehiculoController@agregar']);	
	Route::get('Tipos-Vehiculos/editar/{id}', ['as' => 'editar_tipo_vehiculo', 'uses' => 'TipoVehiculoController@mostrarEditar']);	
	Route::put('Tipos-Vehiculos/editar/{id}', ['as' => 'editar_tipo_vehiculo', 'uses' => 'TipoVehiculoController@editar']);

	/* TIPOS DE MODIFICACIONES EN POLIZA */
	Route::get('Tipos-Polizas-Modificaciones/listado', ['as' => 'tipos_polizas_modificaciones', 'uses' => 'TipoPolizaModificacionController@listado']);
	Route::get('Tipos-Polizas-Modificaciones/agregar', ['as' => 'agregar_tipo_poliza_modificacion', 'uses' => 'TipoPolizaModificacionController@mostrarAgregar']);	
	Route::post('Tipos-Polizas-Modificaciones/agregar', ['as' => 'agregar_tipo_poliza_modificacion', 'uses' => 'TipoPolizaModificacionController@agregar']);	
	Route::get('Tipos-Polizas-Modificaciones/editar/{id}', ['as' => 'editar_tipo_poliza_modificacion', 'uses' => 'TipoPolizaModificacionController@mostrarEditar']);	
	Route::put('Tipos-Polizas-Modificaciones/editar/{id}', ['as' => 'editar_tipo_poliza_modificacion', 'uses' => 'TipoPolizaModificacionController@editar']);


	/* MARCAS DE VEHICULO */
	Route::get('Marcas-Vehiculos/listado', ['as' => 'marcas_vehiculos', 'uses' => 'MarcaVehiculoController@listado']);
	Route::get('Marcas-Vehiculos/agregar', ['as' => 'agregar_marca_vehiculo', 'uses' => 'MarcaVehiculoController@mostrarAgregar']);	
	Route::post('Marcas-Vehiculos/agregar', ['as' => 'agregar_marca_vehiculo', 'uses' => 'MarcaVehiculoController@agregar']);	
	Route::get('Marcas-Vehiculos/editar/{id}', ['as' => 'editar_marca_vehiculo', 'uses' => 'MarcaVehiculoController@mostrarEditar']);	
	Route::put('Marcas-Vehiculos/editar/{id}', ['as' => 'editar_marca_vehiculo', 'uses' => 'MarcaVehiculoController@editar']);

	/* POLIZAS */
	Route::get('Polizas/solicitudes', ['as' => 'solicitudes_polizas', 'uses' => 'PolizaController@solicitudes']);
	Route::get('Polizas/agregar-solicitud', ['as' => 'agregar_solicitud_poliza', 'uses' => 'PolizaController@mostrarAgregarSolicitud']);	
	Route::post('Polizas/agregar-solicitud', ['as' => 'agregar_solicitud_poliza', 'uses' => 'PolizaController@agregarSolicitud']);	
	Route::get('Polizas/ver-solicitud/{id}', ['as' => 'ver_solicitud_poliza', 'uses' => 'PolizaController@mostrarVerSolicitud']);
	Route::get('Polizas/aprobar-solicitud/{polizaId}', ['as' => 'aprobar_solicitud_poliza', 'uses' => 'PolizaController@mostrarAprobarSolicitudPoliza']);
	Route::post('Polizas/aprobar-solicitud/{polizaId}', ['as' => 'aprobar_solicitud_poliza', 'uses' => 'PolizaController@aprobarSolicitudPoliza']);
	Route::get('Polizas/renovar/{polizaId}', ['as' => 'renovar_poliza', 'uses' => 'PolizaController@mostrarRenovar']);
	Route::post('Polizas/renovar/{polizaId}', ['as' => 'renovar_poliza', 'uses' => 'PolizaController@renovar']);
	Route::post('Polizas/anular/{polizaId}', ['as' => 'anular_poliza', 'uses' => 'PolizaController@anular']);
	Route::delete('Polizas/eliminar-solicitud', ['as' => 'eliminar_solicitud_poliza', 'uses' => 'PolizaController@eliminarSolicitud']);
	Route::get('Polizas/listado', ['as' => 'polizas', 'uses' => 'PolizaController@listado']);
	Route::get('Polizas/vigentes', ['as' => 'polizas_vigentes', 'uses' => 'PolizaController@vigentes']);
	Route::get('Polizas/ver/{id}', ['as' => 'ver_poliza', 'uses' => 'PolizaController@mostrarVerPoliza']);
	Route::get('Polizas/reporte-solicitudes-pendientes', ['as' => 'polizas_reporte_solicitudes_pendientes', 'uses' => 'PolizaController@reporteSolicitudesPendientes']);
	Route::get('Polizas/reporte-solicitud/{polizaId}', ['as' => 'polizas_reporte_solicitud', 'uses' => 'PolizaController@reporteSolicitud']);
	Route::get('Polizas/reporte-solicitud-cliente-vehiculo/{polizaId}', ['as' => 'polizas_reporte_solicitud_cliente_vehiculo', 'uses' => 'PolizaController@reporteSolicitudClientePorVehiculo']);
	Route::get('Polizas/reporte-renovacion/{polizaId}', ['as' => 'polizas_reporte_renovacion', 'uses' => 'PolizaController@reporteRenovacion']);
	Route::get('Polizas/editar/{id}', ['as' => 'editar_poliza', 'uses' => 'PolizaController@mostrarEditar']);
	Route::put('Polizas/editar/{id}', ['as' => 'editar_poliza', 'uses' => 'PolizaController@editar']);
	Route::get('Polizas/copiar-solicitud/{id}', ['as' => 'copiar_solicitud_poliza', 'uses' => 'PolizaController@mostrarCopiarSolicitud']);	
	Route::post('Polizas/copiar-solicitud/{id}', ['as' => 'copiar_solicitud_poliza', 'uses' => 'PolizaController@copiarSolicitud']);
	Route::get('Polizas/vencidas', ['as' => 'polizas_vencidas', 'uses' => 'PolizaController@polizasVencidas']);
	Route::get('Polizas/reporte-vencidas', ['as' => 'reporte_polizas_vencidas', 'uses' => 'PolizaController@reportePolizasVencidas']);
	Route::get('Polizas/vencidas-mes/{anio}/{mes}', ['as' => 'polizas_vencidas_mes', 'uses' => 'PolizaController@polizasVencidasMes']);

	/* POLIZAS DECLARATIVAS */
	Route::get('Polizas/ver-declarativa/{id}', ['as' => 'ver_poliza_declarativa', 'uses' => 'PolizaController@mostrarVerPolizaDeclarativa']);
	Route::post('Polizas-Declaracion/generar-solicitud/{polizaId}', ['as' => 'generar_poliza_declaracion', 'uses' => 'PolizaDeclaracionController@generar']);
	Route::get('Polizas-Declaracion/aprobar-solicitud/{id}', ['as' => 'aprobar_poliza_declaracion', 'uses' => 'PolizaDeclaracionController@mostrarAprobarSolicitud']);
	Route::post('Polizas-Declaracion/aprobar-solicitud/{id}', ['as' => 'aprobar_poliza_declaracion', 'uses' => 'PolizaDeclaracionController@aprobarSolicitud']);
	Route::get('Polizas-Declaracion/ver/{id}', ['as' => 'ver_poliza_declaracion', 'uses' => 'PolizaDeclaracionController@mostrarVer']);

	Route::get('Polizas-Declaracion-Vehiculo/agregar/{id}', ['as' => 'agregar_poliza_declaracion_vehiculo', 'uses' => 'PolizaDeclaracionVehiculoController@mostrarAgregar']);
	Route::post('Polizas-Declaracion-Vehiculo/agregar/{id}', ['as' => 'agregar_poliza_declaracion_vehiculo', 'uses' => 'PolizaDeclaracionVehiculoController@agregar']);
	Route::post('Polizas-Declaracion-Vehiculo/eliminar', ['as' => 'eliminar_poliza_declaracion_vehiculo', 'uses' => 'PolizaDeclaracionVehiculoController@eliminar']);

	/* POLIZAS DE HIDROCARBUROS */
	Route::get('Polizas/ver-hidrocarburos/{id}', ['as' => 'ver_poliza_hidrocarburos', 'uses' => 'PolizaController@mostrarVerPolizaHidrocarburos']);
	Route::get('Polizas-Declaracion/agregar-hidrocarburo/{polizaId}', ['as' => 'agregar_poliza_declaracion_hidrocarburo', 'uses' => 'PolizaDeclaracionController@mostrarAgregarHidrocarburo']);
	Route::post('Polizas-Declaracion/agregar-hidrocarburo/{polizaId}', ['as' => 'agregar_poliza_declaracion_hidrocarburo', 'uses' => 'PolizaDeclaracionController@agregarHidrocarburo']);
	Route::get('Polizas-Declaracion/editar-hidrocarburo/{id}', ['as' => 'editar_poliza_declaracion_hidrocarburo', 'uses' => 'PolizaDeclaracionController@mostrarEditarHidrocarburo']);
	Route::post('Polizas-Declaracion/editar-hidrocarburo/{id}', ['as' => 'editar_poliza_declaracion_hidrocarburo', 'uses' => 'PolizaDeclaracionController@editarHidrocarburo']);

	/* MARCAS DE VEHICULO */
	Route::get('Frecuencias-Pagos/listado', ['as' => 'frecuencias_pagos', 'uses' => 'FrecuenciaPagoController@listado']);
	Route::get('Frecuencias-Pagos/agregar', ['as' => 'agregar_frecuencia_pago', 'uses' => 'FrecuenciaPagoController@mostrarAgregar']);	
	Route::post('Frecuencias-Pagos/agregar', ['as' => 'agregar_frecuencia_pago', 'uses' => 'FrecuenciaPagoController@agregar']);	
	Route::get('Frecuencias-Pagos/editar/{id}', ['as' => 'editar_frecuencia_pago', 'uses' => 'FrecuenciaPagoController@mostrarEditar']);	
	Route::put('Frecuencias-Pagos/editar/{id}', ['as' => 'editar_frecuencia_pago', 'uses' => 'FrecuenciaPagoController@editar']);

	/* POLIZAS - VEHICULO */
	Route::get('Polizas-Vehiculos/agregar/{polizaId}', ['as' => 'agregar_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@mostrarAgregar']);
	Route::post('Polizas-Vehiculos/agregar/{polizaId}', ['as' => 'agregar_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@agregar']);
	Route::get('Polizas-Vehiculos/agregar-varios/{polizaId}', ['as' => 'agregar_poliza_vehiculos', 'uses' => 'PolizaVehiculoController@mostrarAgregarVarios']);
	Route::post('Polizas-Vehiculos/agregar-varios/{polizaId}', ['as' => 'agregar_poliza_vehiculos', 'uses' => 'PolizaVehiculoController@agregarVarios']);
	Route::get('Polizas-Vehiculos/editar/{id}', ['as' => 'editar_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@mostrarEditar']);	
	Route::put('Polizas-Vehiculos/editar/{id}', ['as' => 'editar_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@editar']);
	Route::delete('Polizas-Vehiculos/eliminar', ['as' => 'eliminar_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@eliminar']);
	Route::get('Polizas-Vehiculos/editar-certificado/{id}', ['as' => 'editar_certificado_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@mostrarEditarCertificado']);
	Route::put('Polizas-Vehiculos/editar-certificado/{id}', ['as' => 'editar_certificado_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@editarCertificado']);
	Route::get('Polizas-Vehiculos/ver/{id}', ['as' => 'ver_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@mostrarVer']);	
	Route::get('Polizas-Vehiculos/buscar', ['as' => 'buscar_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@mostrarBuscar']);
	Route::post('Polizas-Vehiculos/buscar', ['as' => 'buscar_poliza_vehiculo', 'uses' => 'PolizaVehiculoController@buscar']);
	Route::get('Polizas-Vehiculos/cambiar-estado-declaracion/{id}/{estado}', ['as' => 'poliza_vehiculo_cambiar_estado_declaracion', 'uses' => 'PolizaVehiculoController@cambiarEstadoDeclaracion']);

	/* POLIZA COBERTURAS VEHICULO*/
	Route::get('Polizas-Coberturas-Vehiculo/agregar/{polizaVehiculoId}', ['as' => 'agregar_poliza_cobertura_vehiculo', 'uses' => 'PolizaCoberturaVehiculoController@mostrarAgregar']);	
	Route::post('Polizas-Coberturas-Vehiculo/agregar/{polizaVehiculoId}', ['as' => 'agregar_poliza_cobertura_vehiculo', 'uses' => 'PolizaCoberturaVehiculoController@agregar']);
	Route::get('Polizas-Coberturas-Vehiculos/editar/{id}', ['as' => 'editar_poliza_cobertura_vehiculo', 'uses' => 'PolizaCoberturaVehiculoController@mostrarEditar']);	
	Route::put('Polizas-Coberturas-Vehiculos/editar/{id}', ['as' => 'editar_poliza_cobertura_vehiculo', 'uses' => 'PolizaCoberturaVehiculoController@editar']);
	Route::delete('Polizas-Coberturas-Vehiculos/eliminar', ['as' => 'eliminar_poliza_cobertura_vehiculo', 'uses' => 'PolizaCoberturaVehiculoController@eliminar']);

	/* POLIZAS - INCLUSIONES */
	Route::post('Polizas-Inclusion/agregar/{polizaId}', ['as' => 'agregar_poliza_inclusion', 'uses' => 'PolizaInclusionController@agregar']);
	Route::get('Polizas-Inclusion/ver/{inclusionId}', ['as' => 'ver_poliza_inclusion', 'uses' => 'PolizaInclusionController@mostrarVer']);
	Route::get('Polizas-Inclusion/agregar-vehiculo/{inclusionId}', ['as' => 'agregar_poliza_inclusion_vehiculo', 'uses' => 'PolizaInclusionController@mostrarAgregarVehiculo']);
	Route::post('Polizas-Inclusion/agregar-vehiculo/{inclusionId}', ['as' => 'agregar_poliza_inclusion_vehiculo', 'uses' => 'PolizaInclusionController@agregarVehiculo']);
	Route::get('Polizas-Inclusion/agregar-cobertura/{inclusionId}', ['as' => 'agregar_poliza_inclusion_cobertura', 'uses' => 'PolizaInclusionController@mostrarAgregarCobertura']);
	Route::post('Polizas-Inclusion/agregar-cobertura/{inclusionId}', ['as' => 'agregar_poliza_inclusion_cobertura', 'uses' => 'PolizaInclusionController@agregarCobertura']);
	Route::get('Polizas-Inclusion/agregar-cobertura-vehiculo/{inclusionId}/{vehiculoId}', ['as' => 'agregar_poliza_inclusion_cobertura_vehiculo', 'uses' => 'PolizaInclusionController@mostrarAgregarCoberturaVehiculo']);
	Route::post('Polizas-Inclusion/agregar-cobertura-vehiculo/{inclusionId}/{vehiculoId}', ['as' => 'agregar_poliza_inclusion_cobertura_vehiculo', 'uses' => 'PolizaInclusionController@agregarCoberturaVehiculo']);
	Route::get('Polizas-Inclusion/aprobar-solicitud/{inclusionId}', ['as' => 'aprobar_poliza_inclusion', 'uses' => 'PolizaInclusionController@mostrarAprobarSolicitud']);
	Route::post('Polizas-Inclusion/aprobar-solicitud/{inclusionId}', ['as' => 'aprobar_poliza_inclusion', 'uses' => 'PolizaInclusionController@aprobarSolicitud']);
	Route::get('Polizas-Inclusion/reporte-solicitud/{inclusionId}', ['as' => 'poliza_inclusion_reporte_solicitud', 'uses' => 'PolizaInclusionController@reporteSolicitud']);

	/* POLIZAS - EXCLUSIONES */
	Route::post('Polizas-Exclusion/agregar/{polizaId}', ['as' => 'agregar_poliza_exclusion', 'uses' => 'PolizaExclusionController@agregar']);
	Route::get('Polizas-Exclusion/ver/{exclusionId}', ['as' => 'ver_poliza_exclusion', 'uses' => 'PolizaExclusionController@mostrarVer']);
	Route::get('Polizas-Exclusion/agregar-vehiculo/{exclusionId}', ['as' => 'agregar_poliza_exclusion_vehiculo', 'uses' => 'PolizaExclusionController@mostrarAgregarVehiculo']);
	Route::post('Polizas-Exclusion/agregar-vehiculo/{exclusionId}', ['as' => 'agregar_poliza_exclusion_vehiculo', 'uses' => 'PolizaExclusionController@agregarVehiculo']);
	Route::post('Polizas-Exclusion/eliminar-vehiculo/{exclusionId}', ['as' => 'eliminar_poliza_exclusion_vehiculo', 'uses' => 'PolizaExclusionController@eliminarVehiculo']);
	Route::get('Polizas-Exclusion/agregar-cobertura/{exclusionId}', ['as' => 'agregar_poliza_exclusion_cobertura', 'uses' => 'PolizaExclusionController@mostrarAgregarCobertura']);
	Route::post('Polizas-Exclusion/agregar-cobertura/{exclusionId}', ['as' => 'agregar_poliza_exclusion_cobertura', 'uses' => 'PolizaExclusionController@agregarCobertura']);
	Route::post('Polizas-Exclusion/eliminar-cobertura/{exclusionId}', ['as' => 'eliminar_poliza_exclusion_cobertura', 'uses' => 'PolizaExclusionController@eliminarCobertura']);
	Route::get('Polizas-Exclusion/agregar-cobertura-vehiculo/{exclusionId}/{vehiculoId}', ['as' => 'agregar_poliza_exclusion_cobertura_vehiculo', 'uses' => 'PolizaExclusionController@mostrarAgregarCoberturaVehiculo']);
	Route::post('Polizas-Exclusion/agregar-cobertura-vehiculo/{exclusionId}/{vehiculoId}', ['as' => 'agregar_poliza_exclusion_cobertura_vehiculo', 'uses' => 'PolizaExclusionController@agregarCoberturaVehiculo']);
	Route::get('Polizas-Exclusion/aprobar-solicitud/{exclusionId}', ['as' => 'aprobar_poliza_exclusion', 'uses' => 'PolizaExclusionController@mostrarAprobarSolicitud']);
	Route::post('Polizas-Exclusion/aprobar-solicitud/{exclusionId}', ['as' => 'aprobar_poliza_exclusion', 'uses' => 'PolizaExclusionController@aprobarSolicitud']);

	/* POLIZAS - MODIFICACIONES */
	Route::post('Polizas-Modificacion/agregar/{polizaId}', ['as' => 'agregar_poliza_modificacion', 'uses' => 'PolizaModificacionController@agregar']);
	Route::get('Polizas-Modificacion/ver/{modificacionId}', ['as' => 'ver_poliza_modificacion', 'uses' => 'PolizaModificacionController@mostrarVer']);
	Route::get('Polizas-Modificacion/aprobar-solicitud/{modificacionId}', ['as' => 'aprobar_poliza_modificacion', 'uses' => 'PolizaModificacionController@mostrarAprobarSolicitud']);
	Route::post('Polizas-Modificacion/aprobar-solicitud/{modificacionId}', ['as' => 'aprobar_poliza_modificacion', 'uses' => 'PolizaModificacionController@aprobarSolicitud']);
	Route::get('Polizas-Modificacion/reporte-solicitud/{modificacionId}', ['as' => 'poliza_modificacion_reporte_solicitud', 'uses' => 'PolizaModificacionController@reporteSolicitud']);

	/* POLIZAS - MODIFICACIONES DETALLE */
	Route::get('Polizas-Modificacion-Detalle/agregar/{polizaModificacionId}', ['as' => 'agregar_poliza_modificacion_detalle', 'uses' => 'PolizaModificacionDetalleController@mostrarAgregar']);
	Route::post('Polizas-Modificacion-Detalle/agregar/{polizaModificacionId}', ['as' => 'agregar_poliza_modificacion_detalle', 'uses' => 'PolizaModificacionDetalleController@agregar']);
	Route::get('Polizas-Modificacion-Detalle/editar/{polizaModificacionDetalleId}', ['as' => 'editar_poliza_modificacion_detalle', 'uses' => 'PolizaModificacionDetalleController@mostrarEditar']);
	Route::put('Polizas-Modificacion-Detalle/editar/{polizaModificacionDetalleId}', ['as' => 'editar_poliza_modificacion_detalle', 'uses' => 'PolizaModificacionDetalleController@editar']);

	/* POLIZAS - RECLAMOS */
	Route::get('Polizas-Vehiculos-Reclamos/agregar/{polizaVehiculoId}', ['as' => 'agregar_poliza_vehiculo_reclamo', 'uses' => 'PolizaVehiculoReclamoController@mostrarAgregar']);
	Route::post('Polizas-Vehiculos-Reclamos/agregar/{polizaVehiculoId}', ['as' => 'agregar_poliza_vehiculo_reclamo', 'uses' => 'PolizaVehiculoReclamoController@agregar']);
	Route::get('Polizas-Vehiculos-Reclamos/editar/{id}', ['as' => 'editar_poliza_vehiculo_reclamo', 'uses' => 'PolizaVehiculoReclamoController@mostrarEditar']);
	Route::put('Polizas-Vehiculos-Reclamos/editar/{id}', ['as' => 'editar_poliza_vehiculo_reclamo', 'uses' => 'PolizaVehiculoReclamoController@editar']);
	Route::get('Polizas-Vehiculos-Reclamos/ver/{id}', ['as' => 'ver_poliza_vehiculo_reclamo', 'uses' => 'PolizaVehiculoReclamoController@ver']);

	/* NOTAS DE CREDITO */
	Route::get('Notas-Credito/agregar/{exclusionId}', ['as' => 'agregar_nota_credito', 'uses' => 'NotaCreditoController@mostrarAgregar']);
	Route::post('Notas-Credito/agregar/{exclusionId}', ['as' => 'agregar_nota_credito', 'uses' => 'NotaCreditoController@agregar']);
	Route::get('Notas-Credito/editar/{id}', ['as' => 'editar_nota_credito', 'uses' => 'NotaCreditoController@mostrarEditar']);
	Route::post('Notas-Credito/editar/{id}', ['as' => 'editar_nota_credito', 'uses' => 'NotaCreditoController@editar']);

	/* BITACORA POLIZA */
	Route::get('Bitacora-Poliza/agregar/{polizaId}', ['as' => 'agregar_bitacora_poliza', 'uses' => 'BitacoraPolizaController@mostrarAgregar']);
	Route::post('Bitacora-Poliza/agregar/{polizaId}', ['as' => 'agregar_bitacora_poliza', 'uses' => 'BitacoraPolizaController@agregar']);
	

	/* POLIZAS - COBERTURA */
	Route::get('Polizas-Coberturas/agregar-producto/{polizaId}/{productoId}',['as' => 'agregar_poliza_producto', 'uses' => 'PolizaCoberturaController@mostrarAgregarProducto']);
	Route::post('Polizas-Coberturas/agregar-producto/{polizaId}/{productoId}',['as' => 'agregar_poliza_producto', 'uses' => 'PolizaCoberturaController@agregarProducto']);	
	Route::get('Polizas-Coberturas/agregar/{polizaId}',['as' => 'agregar_poliza_cobertura', 'uses' => 'PolizaCoberturaController@mostrarAgregar']);
	Route::post('Polizas-Coberturas/agregar/{polizaId}',['as' => 'agregar_poliza_cobertura', 'uses' => 'PolizaCoberturaController@agregar']);
	Route::get('Polizas-Coberturas/editar/{id}', ['as' => 'editar_poliza_cobertura', 'uses' => 'PolizaCoberturaController@mostrarEditar']);	
	Route::put('Polizas-Coberturas/editar/{id}', ['as' => 'editar_poliza_cobertura', 'uses' => 'PolizaCoberturaController@editar']);
	Route::delete('Polizas-Coberturas/eliminar', ['as' => 'eliminar_poliza_cobertura', 'uses' => 'PolizaCoberturaController@eliminar']);

	/* POLIZAS - REQUERIMIENTO */
	Route::post('Polizas-Requerimientos/generar/{polizaId}', ['as' => 'generar_poliza_requerimiento', 'uses' => 'PolizaRequerimientoController@generarRequerimientos']);
	Route::get('Polizas-Requerimientos/agregar/{polizaId}', ['as' => 'agregar_poliza_requerimiento', 'uses' => 'PolizaRequerimientoController@mostrarAgregar']);
	Route::post('Polizas-Requerimientos/agregar/{polizaId}', ['as' => 'agregar_poliza_requerimiento', 'uses' => 'PolizaRequerimientoController@agregar']);
	Route::get('Polizas-Requerimientos/editar/{id}', ['as' => 'editar_poliza_requerimiento', 'uses' => 'PolizaRequerimientoController@mostrarEditar']);	
	Route::put('Polizas-Requerimientos/editar/{id}', ['as' => 'editar_poliza_requerimiento', 'uses' => 'PolizaRequerimientoController@editar']);
	Route::put('Polizas-Requerimientos/anular', ['as' => 'anular_poliza_requerimiento', 'uses' => 'PolizaRequerimientoController@anular']);
	Route::delete('Polizas-Requerimientos/eliminar', ['as' => 'eliminar_poliza_requerimiento', 'uses' => 'PolizaRequerimientoController@eliminar']);
	Route::get('Polizas-Requerimientos/pendientes', ['as' => 'requerimientos_pendientes', 'uses' => 'PolizaRequerimientoController@mostrarPendientes']);
	Route::get('Polizas-Requerimientos/no-cobrados-mes', ['as' => 'requerimientos_no_cobrados_mes', 'uses' => 'PolizaRequerimientoController@mostrarNoCobradosPorMes']);

	Route::get('Pago-Requerimiento/agregar/{polizaId}', ['as' => 'agregar_pago_requerimiento', 'uses' => 'PagoRequerimientoController@mostrarAgregar']);
	Route::post('Pago-Requerimiento/agregar/{polizaId}', ['as' => 'agregar_pago_requerimiento', 'uses' => 'PagoRequerimientoController@agregar']);

	/* PLANILLA */
	Route::get('Planillas/listado/{aseguradoraId}', ['as' => 'planillas', 'uses' => 'PlanillaController@listado']);
	Route::get('Planillas/agregar/{aseguradoraId}', ['as' => 'agregar_planilla', 'uses'=> 'PlanillaController@mostrarAgregar']);
	Route::post('Planillas/agregar/{aseguradoraId}', ['as' => 'agregar_planilla', 'uses'=> 'PlanillaController@agregar']);
	Route::get('Planillas/buscar/{planillaId}', ['as' => 'buscar_requerimientos_planilla', 'uses' => 'PlanillaController@mostrarBuscarRequerimientos']);
	Route::post('Planillas/buscar/{planillaId}', ['as' => 'buscar_requerimientos_planilla', 'uses' => 'PlanillaController@buscarRequerimientos']);
	Route::post('Planillas/agregar-requerimientos/{planillaId}', ['as' => 'agregar_requerimientos_planilla', 'uses'=> 'PlanillaController@agregarRequerimientos']);
	Route::get('Planillas/editar/{id}', ['as' => 'editar_planilla', 'uses' => 'PlanillaController@mostrarEditar']);
	Route::put('Planillas/editar/{id}', ['as' => 'editar_planilla', 'uses' => 'PlanillaController@editar']);
	Route::get('Planillas/ver/{id}', ['as' => 'ver_planilla', 'uses' => 'PlanillaController@ver']);
	Route::get('Planillas/reporte-diaria/{id}', ['as' => 'reporte_planilla_diaria', 'uses' => 'PlanillaController@reporteDiaria']);
	Route::get('Planillas/agregar-poliza/{polizaId}', ['as' => 'agregar_planilla_poliza', 'uses' => 'PlanillaController@mostrarAgregarPlanillaPoliza']);
	Route::post('Planillas/agregar-poliza/{polizaId}', ['as' => 'agregar_planilla_poliza', 'uses' => 'PlanillaController@agregarPlanillaPoliza']);
	Route::get('Planillas/reporte-poliza/{id}', ['as' => 'reporte_planilla_poliza', 'uses' => 'PlanillaController@reportePoliza']);

	/* PORCENTAJES DE FRACCIONAMIENTO GENERALES */
	Route::get('Porcentajes-Fraccionamientos-Generales/listado', ['as' => 'porcentajes_fraccionamientos_generales', 'uses' => 'PorcentajeFraccionamientoGeneralController@listado']);
	Route::get('Porcentajes-Fraccionamientos-Generales/agregar', ['as' => 'agregar_porcentaje_fraccionamiento_general', 'uses' => 'PorcentajeFraccionamientoGeneralController@mostrarAgregar']);	
	Route::post('Porcentajes-Fraccionamientos-Generales/agregar', ['as' => 'agregar_porcentaje_fraccionamiento_general', 'uses' => 'PorcentajeFraccionamientoGeneralController@agregar']);	
	Route::get('Porcentajes-Fraccionamientos-Generales/editar/{id}', ['as' => 'editar_porcentaje_fraccionamiento_general', 'uses' => 'PorcentajeFraccionamientoGeneralController@mostrarEditar']);	
	Route::put('Porcentajes-Fraccionamientos-Generales/editar/{id}', ['as' => 'editar_porcentaje_fraccionamiento_general', 'uses' => 'PorcentajeFraccionamientoGeneralController@editar']);

	/* PORCENTAJES DE FRACCIONAMIENTO POR ASEGURADORA */
	Route::get('Porcentajes-Fraccionamientos-Aseguradora/listado/{aseguradoraId}', ['as' => 'porcentajes_fraccionamientos_aseguradoras', 'uses' => 'PorcentajeFraccionamientoAseguradoraController@listado']);
	Route::get('Porcentajes-Fraccionamientos-Aseguradora/agregar/{aseguradoraId}', ['as' => 'agregar_porcentaje_fraccionamiento_aseguradora', 'uses' => 'PorcentajeFraccionamientoAseguradoraController@mostrarAgregar']);	
	Route::post('Porcentajes-Fraccionamientos-Aseguradora/agregar/{aseguradoraId}', ['as' => 'agregar_porcentaje_fraccionamiento_aseguradora', 'uses' => 'PorcentajeFraccionamientoAseguradoraController@agregar']);	
	Route::get('Porcentajes-Fraccionamientos-Aseguradora/editar/{id}', ['as' => 'editar_porcentaje_fraccionamiento_aseguradora', 'uses' => 'PorcentajeFraccionamientoAseguradoraController@mostrarEditar']);	
	Route::put('Porcentajes-Fraccionamientos-Aseguradora/editar/{id}', ['as' => 'editar_porcentaje_fraccionamiento_aseguradora', 'uses' => 'PorcentajeFraccionamientoAseguradoraController@editar']);

});


Route::get('login', ['as' => 'login', 'uses' => 'AuthController@mostrarLogin']);
Route::post('login', ['as' => 'login', 'uses' => 'AuthController@login']);


/* AJAX */
Route::get('ajax/puestos/{id}', ['as' => 'ajax_puestos', 'uses' => 'ColaboradorController@ajaxPuestosByArea']);
Route::get('ajax/departamentos-pais/{paisId}', ['as' => 'ajax_departamentos_pais', 'uses' => 'DepartamentoController@ajaxByPais']);
Route::get('ajax/municipios-departamento/{departamentoId}', ['as' => 'ajax_municipos_departamento', 'uses' => 'MunicipioController@ajaxByDepartamento']);

