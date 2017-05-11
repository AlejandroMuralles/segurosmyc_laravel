<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\AusenciaColaborador;
use App\App\Repositories\AusenciaColaboradorRepo;
use App\App\Managers\AusenciaColaboradorManager;

use App\App\Repositories\AusenciaRepo;
use App\App\Repositories\ColaboradorRepo;

class AusenciaColaboradorController extends BaseController {

	protected $ausenciaColaboradorRepo;
	protected $ausenciaRepo;
	protected $colaboradorRepo;

	public function __construct(AusenciaColaboradorRepo $ausenciaColaboradorRepo, AusenciaRepo $ausenciaRepo, ColaboradorRepo $colaboradorRepo)
	{
		$this->ausenciaColaboradorRepo = $ausenciaColaboradorRepo;
		$this->ausenciaRepo = $ausenciaRepo;
		$this->colaboradorRepo = $colaboradorRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($colaboradorId){
		$colaborador = $this->colaboradorRepo->find($colaboradorId);
		$ausencias = $this->ausenciaRepo->lists('descripcion','id');
		return View::make('administracion/ausencias_colaboradores/agregar',compact('colaborador','ausencias'));
	}

	public function agregar($colaboradorId)
	{
		$data = Input::all();
		$data['colaborador_id'] = $colaboradorId;
		$manager = new AusenciaColaboradorManager(new AusenciaColaborador(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la ausencia con éxito.');
		$url = route('ver_colaborador', $colaboradorId) . '#ausencias';
		return Redirect::to($url);
	}

	public function mostrarEditar($id){
		$ausencias = $this->ausenciaRepo->lists('descripcion','id');
		$ausencia = $this->ausenciaColaboradorRepo->find($id);
		return View::make('administracion/ausencias_colaboradores/editar', compact('ausencia','ausencias'));
	}

	public function editar($id)
	{
		$ausencia = $this->ausenciaColaboradorRepo->find($id);
		$data = Input::all();
		$data['colaborador_id'] = $ausencia->colaborador_id;
		$manager = new AusenciaColaboradorManager($ausencia, $data);
		$manager->save();
		Session::flash('success', 'Se editó la ausencia con éxito.');
		$url = route('ver_colaborador', $ausencia->colaborador_id) . '#ausencias';
		return Redirect::to($url);
	}
}
