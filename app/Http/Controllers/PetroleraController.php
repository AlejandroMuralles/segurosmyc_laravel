<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\Petrolera;
use App\App\Repositories\PetroleraRepo;
use App\App\Managers\PetroleraManager;

class PetroleraController extends BaseController {

	protected $petroleraRepo;

	public function __construct(PetroleraRepo $petroleraRepo)
	{
		$this->petroleraRepo = $petroleraRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$petroleras = $this->petroleraRepo->all('nombre');
		return View::make('administracion/petroleras/index', compact('petroleras'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/petroleras/agregar');
	}

	public function agregar()
	{
		$manager = new PetroleraManager(new Petrolera(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó la petrolera con éxito.');
		return Redirect::route('petroleras');
	}

	public function mostrarEditar($id){
		$petrolera = $this->petroleraRepo->find($id);
		return View::make('administracion/petroleras/editar', compact('petrolera'));
	}

	public function editar($id)
	{
		$petrolera = $this->petroleraRepo->find($id);
		$manager = new PetroleraManager($petrolera, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó la petrolera con éxito.');
		return Redirect::route('petroleras');
	}
}
