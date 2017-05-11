<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\VacacionColaborador;
use App\App\Repositories\VacacionColaboradorRepo;
use App\App\Managers\VacacionColaboradorManager;

use App\App\Repositories\ColaboradorRepo;

class VacacionColaboradorController extends BaseController {

	protected $vacacionColaboradorRepo;
	protected $colaboradorRepo;

	public function __construct(VacacionColaboradorRepo $vacacionColaboradorRepo, ColaboradorRepo $colaboradorRepo)
	{
		$this->vacacionColaboradorRepo = $vacacionColaboradorRepo;
		$this->colaboradorRepo = $colaboradorRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($colaboradorId){
		$colaborador = $this->colaboradorRepo->find($colaboradorId);
		return View::make('administracion/vacaciones_colaboradores/agregar',compact('colaborador'));
	}

	public function agregar($colaboradorId)
	{
		$data = Input::all();
		$data['colaborador_id'] = $colaboradorId;
		$data['periodo'] = $data['periodo'].'-01-01';
		$manager = new VacacionColaboradorManager(new VacacionColaborador(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la salida de vacación con éxito.');
		$url = route('ver_colaborador', $colaboradorId) . '#vacaciones';
		return Redirect::to($url);
	}

	public function mostrarEditar($id){
		$vacacion = $this->vacacionColaboradorRepo->find($id);
		return View::make('administracion/vacaciones_colaboradores/editar', compact('vacacion'));
	}

	public function editar($id)
	{
		$vacacion = $this->vacacionColaboradorRepo->find($id);
		$data = Input::all();
		$data['colaborador_id'] = $vacacion->colaborador_id;
		$data['periodo'] = $data['periodo'].'-01-01';
		$manager = new VacacionColaboradorManager($vacacion, $data);
		$manager->save();
		Session::flash('success', 'Se editó la salida de vacación con éxito.');
		$url = route('ver_colaborador', $vacacion->colaborador_id) . '#vacaciones';
		return Redirect::to($url);
	}
}
