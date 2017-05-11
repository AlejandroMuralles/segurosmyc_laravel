<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\Aseguradora;
use App\App\Repositories\AseguradoraRepo;
use App\App\Managers\AseguradoraManager;

use App\App\Repositories\ContactoAseguradoraRepo;

class AseguradoraController extends BaseController {

	protected $aseguradoraRepo;
	protected $contactoAseguradoraRepo;

	public function __construct(AseguradoraRepo $aseguradoraRepo, ContactoAseguradoraRepo $contactoAseguradoraRepo)
	{
		$this->aseguradoraRepo = $aseguradoraRepo;
		$this->contactoAseguradoraRepo = $contactoAseguradoraRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$aseguradoras = $this->aseguradoraRepo->all('nombre');
		return View::make('administracion/aseguradoras/index', compact('aseguradoras'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/aseguradoras/agregar');
	}

	public function agregar()
	{
		$manager = new AseguradoraManager(new Aseguradora(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó la aseguradora con éxito.');
		return Redirect::route('aseguradoras');
	}

	public function mostrarEditar($id){
		$aseguradora = $this->aseguradoraRepo->find($id);
		return View::make('administracion/aseguradoras/editar', compact('aseguradora'));
	}

	public function editar($id)
	{
		$aseguradora = $this->aseguradoraRepo->find($id);
		$manager = new AseguradoraManager($aseguradora, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó la aseguradora con éxito.');
		return Redirect::route('aseguradoras');
	}

	public function mostrarVer($id){
		$aseguradora = $this->aseguradoraRepo->find($id);
		$contactos = $this->contactoAseguradoraRepo->getByAseguradora($id);
		return View::make('administracion/aseguradoras/ver', compact('aseguradora','contactos'));
	}
}
