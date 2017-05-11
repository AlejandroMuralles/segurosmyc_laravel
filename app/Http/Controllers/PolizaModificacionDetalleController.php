<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable, PDF;

use App\App\Entities\PolizaModificacionDetalle;
use App\App\Repositories\PolizaModificacionDetalleRepo;
use App\App\Managers\PolizaModificacionDetalleManager;

use App\App\Repositories\PolizaModificacionRepo;
use App\App\Repositories\TipoPolizaModificacionRepo;

class PolizaModificacionDetalleController extends BaseController {

	protected $polizaModificacionRepo;
	protected $polizaModificacionDetalleRepo;
	protected $tipoPolizaModificacionRepo;

	public function __construct(PolizaModificacionRepo $polizaModificacionRepo, PolizaModificacionDetalleRepo $polizaModificacionDetalleRepo, TipoPolizaModificacionRepo $tipoPolizaModificacionRepo)
	{
		$this->polizaModificacionRepo = $polizaModificacionRepo;
		$this->polizaModificacionDetalleRepo = $polizaModificacionDetalleRepo;
		$this->tipoPolizaModificacionRepo = $tipoPolizaModificacionRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($polizaModificacionId)
	{
		$polizaModificacion = $this->polizaModificacionRepo->find($polizaModificacionId);
		$tipos = $this->tipoPolizaModificacionRepo->lists('descripcion','id');
		$solicitantes = Variable::getSolicitantesPolizaModificaciones();
		return View::make('administracion/poliza_modificaciones_detalle/agregar', compact('polizaModificacion','tipos','solicitantes'));
	}

	public function agregar($polizaModificacionId)
	{
		$polizaModificacion = $this->polizaModificacionRepo->find($polizaModificacionId);
		$data = Input::all();
		$data['poliza_modificacion_id'] = $polizaModificacionId;
		$manager = new PolizaModificacionDetalleManager(new PolizaModificacionDetalle(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el cambio a solicitud de modificación con éxito.');
		$url = route($polizaModificacion->poliza->ruta,$polizaModificacion->poliza_id) . '#modificaciones';
		return Redirect::to($url);
	}

	public function mostrarEditar($polizaModificacionDetalleId)
	{
		$cambio = $this->polizaModificacionDetalleRepo->find($polizaModificacionDetalleId);
		$tipos = $this->tipoPolizaModificacionRepo->lists('descripcion','id');
		$solicitantes = Variable::getSolicitantesPolizaModificaciones();
		return View::make('administracion/poliza_modificaciones_detalle/editar', compact('cambio','tipos','solicitantes'));
	}

	public function editar($polizaModificacionDetalleId)
	{
		$cambio = $this->polizaModificacionDetalleRepo->find($polizaModificacionDetalleId);
		$data = Input::all();
		$data['poliza_modificacion_id'] = $cambio->poliza_modificacion_id;
		$manager = new PolizaModificacionDetalleManager($cambio, $data);
		$manager->save();
		Session::flash('success', 'Se editó el cambio de solicitud de modificación con éxito.');
		$url = route('ver_poliza_modificacion',$cambio->poliza_modificacion_id);
		return Redirect::to($url);
	}

	

}

