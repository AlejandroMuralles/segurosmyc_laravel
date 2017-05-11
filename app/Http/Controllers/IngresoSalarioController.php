<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\IngresoSalario;
use App\App\Repositories\IngresoSalarioRepo;
use App\App\Managers\IngresoSalarioManager;

class IngresoSalarioController extends BaseController {

	protected $ingresoSalarioRepo;

	public function __construct(IngresoSalarioRepo $ingresoSalarioRepo)
	{
		$this->ingresoSalarioRepo = $ingresoSalarioRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$ingresos = $this->ingresoSalarioRepo->all('descripcion');
		return View::make('administracion/ingresos_salarios/index', compact('ingresos'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/ingresos_salarios/agregar');
	}

	public function agregar()
	{
		$data = Input::all();
		$data['estado'] = 'A';
		$manager = new IngresoSalarioManager(new IngresoSalario(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el ingreso de salario con éxito.');
		return Redirect::route('ingresos_salarios');
	}

	public function mostrarEditar($id){
		$ingresoSalario = $this->ingresoSalarioRepo->find($id);
		$estados = Variable::getEstadosGenerales();
		return View::make('administracion/ingresos_salarios/editar', compact('ingresoSalario','estados'));
	}

	public function editar($id)
	{
		$ingresoSalario = $this->ingresoSalarioRepo->find($id);
		$manager = new IngresoSalarioManager($ingresoSalario, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el ingreso de salario con éxito.');
		return Redirect::route('ingresos_salarios');
	}
}
