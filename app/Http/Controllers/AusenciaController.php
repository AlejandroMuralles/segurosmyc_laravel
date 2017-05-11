<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\Ausencia;
use App\App\Repositories\AusenciaRepo;
use App\App\Managers\AusenciaManager;

class AusenciaController extends BaseController {

	protected $ausenciaRepo;

	public function __construct(AusenciaRepo $ausenciaRepo)
	{
		$this->ausenciaRepo = $ausenciaRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$ausencias = $this->ausenciaRepo->all('descripcion');
		return View::make('administracion/ausencias/index', compact('ausencias'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/ausencias/agregar');
	}

	public function agregar()
	{
		$manager = new AusenciaManager(new Ausencia(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó la ausencia con éxito.');
		return Redirect::route('ausencias');
	}

	public function mostrarEditar($id){
		$ausencia = $this->ausenciaRepo->find($id);
		return View::make('administracion/ausencias/editar', compact('ausencia'));
	}

	public function editar($id)
	{
		$ausencia = $this->ausenciaRepo->find($id);
		$manager = new AusenciaManager($ausencia, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó la ausencia con éxito.');
		return Redirect::route('ausencias');
	}
}
