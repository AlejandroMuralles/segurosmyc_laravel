<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\IngresoColaborador;
use App\App\Repositories\IngresoColaboradorRepo;
use App\App\Managers\IngresoColaboradorManager;

use App\App\Repositories\ColaboradorRepo;
use App\App\Repositories\IngresoSalarioRepo;


class IngresoColaboradorController extends BaseController {

	protected $ingresoColaboradorRepo;
	protected $colaboradorRepo;
	protected $ingresoSalarioRepo;

	public function __construct(IngresoColaboradorRepo $ingresoColaboradorRepo, ColaboradorRepo $colaboradorRepo, IngresoSalarioRepo $ingresoSalarioRepo)
	{
		$this->ingresoColaboradorRepo = $ingresoColaboradorRepo;
		$this->ingresoSalarioRepo = $ingresoSalarioRepo;
		$this->colaboradorRepo = $colaboradorRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($colaboradorId){
		$colaborador = $this->colaboradorRepo->find($colaboradorId);
		$ingresos = $this->ingresoSalarioRepo->lists('descripcion','id');
		return View::make('administracion/ingresos_colaboradores/agregar',compact('colaborador','ingresos'));
	}

	public function agregar($colaboradorId)
	{
		$data = Input::all();
		$data['colaborador_id'] = $colaboradorId;
		$manager = new IngresoColaboradorManager(new IngresoColaborador(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el ingreso al colaborador con éxito.');
		return Redirect::route('ver_colaborador',$colaboradorId);
	}

	public function mostrarEditar($id){
		$ingreso = $this->ingresoColaboradorRepo->find($id);
		$colaborador = $this->colaboradorRepo->find($ingreso->colaborador_id);
		return View::make('administracion/ingresos_colaboradores/editar', compact('ingreso','colaborador'));
	}

	public function editar($id)
	{
		$data = Input::all();
		$ingreso = $this->ingresoColaboradorRepo->find($id);
		$data['ingreso_salario_id'] = $ingreso->ingreso_salario_id;
		$data['colaborador_id'] = $ingreso->colaborador_id;
		$manager = new IngresoColaboradorManager($ingreso, $data);
		$manager->save();
		Session::flash('success', 'Se editó el ingreso del colaborador con éxito.');
		return Redirect::route('ver_colaborador',$ingreso->colaborador_id);
	}
}
