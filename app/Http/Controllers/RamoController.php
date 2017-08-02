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
		$data = Input::all();
		$data['estado'] = 'A';
		$manager = new RamoManager(new Ramo(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el ramo '.$data['nombre'].' con éxito.');
		return Redirect::route('ramos');
	}

	public function mostrarEditar($id){
		$ramo = $this->ramoRepo->find($id);
		return View::make('administracion/ramos/editar', compact('ramo'));
	}

	public function editar($id)
	{
		$data = Input::all();
		$ramo = $this->ramoRepo->find($id);
		$data['estado'] = $ramo->estado;
		$manager = new RamoManager($ramo, $data);
		$manager->save();
		Session::flash('success', 'Se editó el ramo '.$ramo->nombre.' con éxito.');
		return Redirect::route('ramos');
	}
}
