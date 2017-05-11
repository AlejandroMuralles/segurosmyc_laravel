<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\Ramo;
use App\App\Repositories\RamoRepo;
use App\App\Managers\RamoManager;

class RamoController extends BaseController {

	protected $ramoRepo;

	public function __construct(RamoRepo $ramoRepo)
	{
		$this->ramoRepo = $ramoRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$ramos = $this->ramoRepo->all('nombre');
		return View::make('administracion/ramos/index', compact('ramos'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/ramos/agregar');
	}

	public function agregar()
	{
		$manager = new RamoManager(new Ramo(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó el ramo con éxito.');
		return Redirect::route('ramos');
	}

	public function mostrarEditar($id){
		$ramo = $this->ramoRepo->find($id);
		return View::make('administracion/ramos/editar', compact('ramo'));
	}

	public function editar($id)
	{
		$ramo = $this->ramoRepo->find($id);
		$manager = new RamoManager($ramo, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el ramo con éxito.');
		return Redirect::route('ramos');
	}
}
