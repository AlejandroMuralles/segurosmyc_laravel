<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\TipoPolizaModificacion;
use App\App\Repositories\TipoPolizaModificacionRepo;
use App\App\Managers\TipoPolizaModificacionManager;

class TipoPolizaModificacionController extends BaseController {

	protected $tipoPolizaModificacionRepo;

	public function __construct(TipoPolizaModificacionRepo $tipoPolizaModificacionRepo)
	{
		$this->tipoPolizaModificacionRepo = $tipoPolizaModificacionRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$tipos = $this->tipoPolizaModificacionRepo->all('descripcion');
		return View::make('administracion/tipos_polizas_modificaciones/index', compact('tipos'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/tipos_polizas_modificaciones/agregar');
	}

	public function agregar()
	{
		$manager = new TipoPolizaModificacionManager(new TipoPolizaModificacion(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó el tipo de modificacion de poliza con éxito.');
		return Redirect::route('tipos_polizas_modificaciones');
	}

	public function mostrarEditar($id){
		$tipoPolizaModificacion = $this->tipoPolizaModificacionRepo->find($id);
		return View::make('administracion/tipos_polizas_modificaciones/editar', compact('tipoPolizaModificacion'));
	}

	public function editar($id)
	{
		$tipoPolizaModificacion = $this->tipoPolizaModificacionRepo->find($id);
		$manager = new TipoPolizaModificacionManager($tipoPolizaModificacion, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el tipo de vehiculo con éxito.');
		return Redirect::route('tipos_polizas_modificaciones');
	}
}
