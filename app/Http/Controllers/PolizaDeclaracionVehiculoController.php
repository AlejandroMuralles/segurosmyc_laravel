<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\PolizaDeclaracionVehiculo;
use App\App\Repositories\PolizaDeclaracionVehiculoRepo;
use App\App\Managers\PolizaDeclaracionVehiculoManager;

use App\App\Repositories\PolizaDeclaracionRepo;

class PolizaDeclaracionVehiculoController extends BaseController {

	protected $polizaDeclaracionVehiculoRepo;
	protected $polizaDeclaracionRepo;

	public function __construct(PolizaDeclaracionVehiculoRepo $polizaDeclaracionVehiculoRepo, PolizaDeclaracionRepo $polizaDeclaracionRepo)
	{
		$this->polizaDeclaracionVehiculoRepo = $polizaDeclaracionVehiculoRepo;
		$this->polizaDeclaracionRepo = $polizaDeclaracionRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($polizaDeclaracionId)
	{
		$polizaDeclaracion = $this->polizaDeclaracionRepo->find($polizaDeclaracionId);
		$vehiculos = $this->polizaDeclaracionVehiculoRepo->getByPolizaNotInDeclaracionByEstado($polizaDeclaracion->poliza_id, $polizaDeclaracion->id,['V'])->pluck('vehiculo.placa','id')->toArray();
		return View::make('administracion/poliza_declaraciones_vehiculo/agregar', compact('polizaDeclaracion','vehiculos'));
	}

	public function agregar($polizaDeclaracionId)
	{
		$data['poliza_vehiculo_id'] = Input::get('vehiculo_id');
		$data['poliza_declaracion_id'] = $polizaDeclaracionId;
		$data['estado'] = 'S';
		$manager = new PolizaDeclaracionVehiculoManager(new PolizaDeclaracionVehiculo(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el vehiculo a la declaracion con éxito.');
		$url = route('ver_poliza_declaracion',$polizaDeclaracionId);
		return Redirect::to($url);
	}

	public function eliminar()
	{
		$id = Input::get('vehiculo_id');
		$polizaDeclaracionVehiculo = $this->polizaDeclaracionVehiculoRepo->find($id);
		$manager = new PolizaDeclaracionVehiculoManager($polizaDeclaracionVehiculo, null);
		$manager->eliminar();
		Session::flash('success', 'Se eliminó el vehiculo de la declaracion con éxito.');
		$url = route('ver_poliza_declaracion',$polizaDeclaracionVehiculo->poliza_declaracion_id);
		return Redirect::to($url);
	}

}