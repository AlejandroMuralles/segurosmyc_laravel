<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\TipoNomina;
use App\App\Repositories\TipoNominaRepo;
use App\App\Managers\TipoNominaManager;

class TipoNominaController extends BaseController {

	protected $tipoNominaRepo;

	public function __construct(TipoNominaRepo $tipoNominaRepo)
	{
		$this->tipoNominaRepo = $tipoNominaRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$tipos = $this->tipoNominaRepo->all('descripcion');
		return View::make('administracion/tipos_nominas/index', compact('tipos'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/tipos_nominas/agregar');
	}

	public function agregar()
	{
		$manager = new TipoNominaManager(new TipoNomina(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó el tipo de nomina con éxito.');
		return Redirect::route('tipos_nominas');
	}

	public function mostrarEditar($id){
		$tipoNomina = $this->tipoNominaRepo->find($id);
		return View::make('administracion/tipos_nominas/editar', compact('tipoNomina'));
	}

	public function editar($id)
	{
		$tipoNomina = $this->tipoNominaRepo->find($id);
		$manager = new TipoNominaManager($tipoNomina, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el tipo de nomina con éxito.');
		return Redirect::route('tipos_nominas');
	}
}
