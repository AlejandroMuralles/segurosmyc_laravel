<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\Puesto;
use App\App\Repositories\PuestoRepo;
use App\App\Managers\PuestoManager;

use App\App\Repositories\AreaRepo;

class PuestoController extends BaseController {

	protected $puestoRepo;
	protected $areaRepo;

	public function __construct(PuestoRepo $puestoRepo, AreaRepo $areaRepo)
	{
		$this->puestoRepo = $puestoRepo;
		$this->areaRepo = $areaRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$puestos = $this->puestoRepo->all('nombre');
		return View::make('administracion/puestos/index', compact('puestos'));
	}

	public function mostrarAgregar(){
		$areas = $this->areaRepo->lists('nombre','id');
		$estados = Variable::getEstadosGenerales();
		return View::make('administracion/puestos/agregar', compact('areas','estados'));
	}

	public function agregar()
	{
		$manager = new PuestoManager(new Puesto(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó el puesto con éxito.');
		return Redirect::route('puestos');
	}

	public function mostrarEditar($id){
		$areas = $this->areaRepo->lists('nombre','id');
		$puesto = $this->puestoRepo->find($id);
		$estados = Variable::getEstadosGenerales();
		return View::make('administracion/puestos/editar', compact('puesto', 'areas','estados'));
	}

	public function editar($id)
	{
		$puesto = $this->puestoRepo->find($id);
		$manager = new PuestoManager($puesto, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el puesto con éxito.');
		return Redirect::route('puestos');
	}
}
