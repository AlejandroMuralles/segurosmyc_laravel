<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\BitacoraPoliza;
use App\App\Repositories\BitacoraPolizaRepo;
use App\App\Managers\BitacoraPolizaManager;

use App\App\Repositories\PolizaRepo;

class BitacoraPolizaController extends BaseController {

	protected $bitacoraPolizaRepo;
	protected $polizaRepo;

	public function __construct(BitacoraPolizaRepo $bitacoraPolizaRepo, PolizaRepo $polizaRepo)
	{
		$this->bitacoraPolizaRepo = $bitacoraPolizaRepo;
		$this->polizaRepo = $polizaRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($polizaId){
		$poliza = $this->polizaRepo->find($polizaId);
		return View::make('administracion/bitacora_polizas/agregar',compact('poliza'));
	}

	public function agregar($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$data = Input::all();
		$data['poliza_id'] = $polizaId;
		$data['estado_poliza'] = $poliza->estado;
		$manager = new BitacoraPolizaManager(new BitacoraPoliza(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la observacion a la poliza con éxito.');
		if($poliza->estado == 'S')
			$url = route($poliza->ruta_solicitud,$polizaId).'#observaciones';
		else
			$url = route($poliza->ruta,$polizaId).'#observaciones';
		return Redirect::to($url);
		
	}

	public function mostrarEditar($id){
		$bitacoraPoliza = $this->bitacoraPolizaRepo->find($id);
		return View::make('administracion/bitacora_polizas/editar', compact('bitacoraPoliza'));
	}

	public function editar($id)
	{
		$bitacoraPoliza = $this->bitacoraPolizaRepo->find($id);
		$manager = new BitacoraPolizaManager($bitacoraPoliza, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó la observación de poliza con éxito.');
		if($poliza->estado == 'S')
			$url = route($poliza->ruta_solicitud,$polizaId).'#observaciones';
		else
			$url = route($poliza->ruta,$polizaId).'#observaciones';
		return Redirect::to($url);
	}
}
