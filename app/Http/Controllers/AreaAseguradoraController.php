<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\AreaAseguradora;
use App\App\Repositories\AreaAseguradoraRepo;
use App\App\Managers\AreaAseguradoraManager;

class AreaAseguradoraController extends BaseController {

	protected $areaAseguradoraRepo;

	public function __construct(AreaAseguradoraRepo $areaAseguradoraRepo)
	{
		$this->areaAseguradoraRepo = $areaAseguradoraRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$areas = $this->areaAseguradoraRepo->all('nombre');
		return View::make('administracion/areas_aseguradoras/index', compact('areas'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/areas_aseguradoras/agregar');
	}

	public function agregar()
	{
		$manager = new AreaAseguradoraManager(new AreaAseguradora(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó el area de aseguradora con éxito.');
		return Redirect::route('areas_aseguradoras');
	}

	public function mostrarEditar($id){
		$area = $this->areaAseguradoraRepo->find($id);
		return View::make('administracion/areas_aseguradoras/editar', compact('area'));
	}

	public function editar($id)
	{
		$area = $this->areaAseguradoraRepo->find($id);
		$manager = new AreaAseguradoraManager($area, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el area de aseguradora con éxito.');
		return Redirect::route('areas_aseguradoras');
	}
}
