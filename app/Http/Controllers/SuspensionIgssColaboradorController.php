<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\SuspensionIgssColaborador;
use App\App\Repositories\SuspensionIgssColaboradorRepo;
use App\App\Managers\SuspensionIgssColaboradorManager;

use App\App\Repositories\ColaboradorRepo;

class SuspensionIgssColaboradorController extends BaseController {

	protected $suspensionIgssColaboradorRepo;
	protected $colaboradorRepo;

	public function __construct(SuspensionIgssColaboradorRepo $suspensionIgssColaboradorRepo, ColaboradorRepo $colaboradorRepo)
	{
		$this->suspensionIgssColaboradorRepo = $suspensionIgssColaboradorRepo;
		$this->colaboradorRepo = $colaboradorRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($colaboradorId){
		$colaborador = $this->colaboradorRepo->find($colaboradorId);
		return View::make('administracion/suspensiones_igss_colaboradores/agregar',compact('colaborador'));
	}

	public function agregar($colaboradorId)
	{
		$data = Input::all();
		$data['colaborador_id'] = $colaboradorId;
		$manager = new SuspensionIgssColaboradorManager(new SuspensionIgssColaborador(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la suspensión del IGSS del colaborador con éxito.');
		$url = route('ver_colaborador', $colaboradorId) . '#suspensionesigss';
		return Redirect::to($url);
	}

	public function mostrarEditar($id){
		$suspension = $this->suspensionIgssColaboradorRepo->find($id);
		return View::make('administracion/suspensiones_igss_colaboradores/editar', compact('suspension'));
	}

	public function editar($id)
	{
		$suspension = $this->suspensionIgssColaboradorRepo->find($id);
		$data = Input::all();
		$data['colaborador_id'] = $suspension->colaborador_id;
		$manager = new SuspensionIgssColaboradorManager($suspension, $data);
		$manager->save();
		Session::flash('success', 'Se editó la suspensión del IGSS del colaborador con éxito.');
		$url = route('ver_colaborador', $suspension->colaborador_id) . '#suspensionesigss';
		return Redirect::to($url);
	}
}
