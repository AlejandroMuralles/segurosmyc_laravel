<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable, PDF;

use App\App\Entities\PolizaVehiculoReclamo;
use App\App\Repositories\PolizaVehiculoReclamoRepo;
use App\App\Managers\PolizaVehiculoReclamoManager;

use App\App\Repositories\PolizaVehiculoRepo;
use App\App\Repositories\CoberturaRepo;
use App\App\Repositories\PolizaReclamoDetalleRepo;

class PolizaVehiculoReclamoController extends BaseController {

	protected $polizaVehiculoReclamoRepo;
	protected $polizaVehiculoRepo;
	protected $coberturaRepo;
	protected $polizaReclamoDetalleRepo;

	public function __construct(PolizaVehiculoReclamoRepo $polizaVehiculoReclamoRepo, PolizaReclamoDetalleRepo $polizaReclamoDetalleRepo, PolizaVehiculoRepo $polizaVehiculoRepo, CoberturaRepo $coberturaRepo)
	{
		$this->polizaVehiculoReclamoRepo = $polizaVehiculoReclamoRepo;
		$this->polizaVehiculoRepo = $polizaVehiculoRepo;
		$this->coberturaRepo = $coberturaRepo;
		$this->polizaReclamoDetalleRepo = $polizaReclamoDetalleRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($polizaVehiculoId)
	{
		$polizaVehiculo = $this->polizaVehiculoRepo->find($polizaVehiculoId);
		$coberturas = $this->coberturaRepo->all('nombre');
		return View::make('administracion/poliza_vehiculos_reclamos/agregar', compact('polizaVehiculo','coberturas'));
	}

	public function agregar($polizaVehiculoId)
	{
		$polizaVehiculo = $this->polizaVehiculoRepo->find($polizaVehiculoId);
		$data = Input::all();
		$data['poliza_vehiculo_id'] = $polizaVehiculoId;
		$data['estado'] = 'V';
		$data['fecha_solicitud'] = $data['fecha'] . ' ' . $data['hora'];
		$manager = new PolizaVehiculoReclamoManager(new PolizaVehiculoReclamo(), $data);
		$manager->agregar();
		Session::flash('success', 'Se agregó el reclamo al vehículo placa '.$polizaVehiculo->vehiculo->placa.' con éxito.');
		$url = route($polizaVehiculo->poliza->ruta,$polizaVehiculo->poliza_id) . '#reclamos';
		return Redirect::to($url);
	}

	public function mostrarEditar($id)
	{
		$polizaVehiculoReclamo = $this->polizaVehiculoReclamoRepo->find($id);
		$detalle = $this->polizaReclamoDetalleRepo->getByPolizaVehiculoReclamo($id);
		return View::make('administracion/poliza_vehiculos_reclamos/editar', compact('polizaVehiculoReclamo','detalle'));
	}

	public function editar($id)
	{
		$polizaVehiculoReclamo = $this->polizaVehiculoReclamoRepo->find($id);
		$data = Input::all();
		$data['poliza_vehiculo_id'] = $polizaVehiculoReclamo->poliza_vehiculo_id;
		$data['estado'] = 'V';
		$data['fecha_solicitud'] = $data['fecha'] . ' ' . $data['hora'];
		$manager = new PolizaVehiculoReclamoManager($polizaVehiculoReclamo, $data);
		$manager->save();
		Session::flash('success', 'Se editó el reclamo '.$polizaVehiculoReclamo->numero.' con éxito.');
		$url = route($polizaVehiculoReclamo->poliza_vehiculo->poliza->ruta,$polizaVehiculoReclamo->poliza_vehiculo->poliza_id) . '#reclamos';
		return Redirect::to($url);
	}

	public function ver($id)
	{
		$polizaVehiculoReclamo = $this->polizaVehiculoReclamoRepo->find($id);
		$detalle = $this->polizaReclamoDetalleRepo->getByPolizaVehiculoReclamo($id);
		return View::make('administracion/poliza_vehiculos_reclamos/ver', compact('polizaVehiculoReclamo','detalle'));
	}

}

