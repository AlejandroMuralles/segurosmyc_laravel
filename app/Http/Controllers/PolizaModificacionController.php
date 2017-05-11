<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable, PDF;

use App\App\Entities\PolizaModificacion;
use App\App\Repositories\PolizaModificacionRepo;
use App\App\Managers\PolizaModificacionManager;

use App\App\Repositories\PolizaRepo;
use App\App\Repositories\PolizaModificacionDetalleRepo;

class PolizaModificacionController extends BaseController {

	protected $polizaModificacionRepo;
	protected $polizaRepo;
	protected $polizaModificacionDetalleRepo;

	public function __construct(PolizaModificacionRepo $polizaModificacionRepo, PolizaRepo $polizaRepo, PolizaModificacionDetalleRepo $polizaModificacionDetalleRepo)
	{
		$this->polizaModificacionRepo = $polizaModificacionRepo;
		$this->polizaRepo = $polizaRepo;
		$this->polizaModificacionDetalleRepo = $polizaModificacionDetalleRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function agregar($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$data = Input::all();
		$data['poliza_id'] = $polizaId;
		$data['estado'] = 'S';
		$data['fecha_solicitud'] = date('Y-m-d H:i:s');
		$manager = new PolizaModificacionManager(new PolizaModificacion(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la solicitud de modificación con éxito.');
		$url = route($poliza->ruta,$polizaId) . '#modificaciones';
		return Redirect::to($url);
	}

	public function mostrarVer($polizaModificacionId){
		$polizaModificacion = $this->polizaModificacionRepo->find($polizaModificacionId);
		$cambios = $this->polizaModificacionDetalleRepo->getByPolizaModificacion($polizaModificacion->id);
		return View::make('administracion/poliza_modificaciones/ver', compact('polizaModificacion','cambios'));
	}

	public function mostrarAprobarSolicitud($modificacionId)
	{
		$modificacion = $this->polizaModificacionRepo->find($modificacionId);

		if($modificacion->estado != 'S')
		{
			Session::flash('error', 'La solicitud de modificacion ya fue procesada. Estado actual: ' . $modificacion->descripcion_estado);
			return Redirect::route('ver_poliza',$modificacion->poliza_id);
		}
		return View::make('administracion/poliza_modificaciones/aprobar_solicitud', compact('modificacion'));
	}

	public function aprobarSolicitud($modificacionId)
	{
		$modificacion = $this->polizaModificacionRepo->find($modificacionId);

		if($modificacion->estado != 'S')
		{
			Session::flash('error', 'La solicitud de modificacion ya fue procesada. Estado actual: ' . $modificacion->descripcion_estado);
			return Redirect::route('ver_poliza',$modificacion->poliza_id);
		}
		$modificacion->estado = 'V';
		$modificacion->fecha_aprobada = date('Y-m-d H:i:s');
		$manager = new PolizaModificacionManager($modificacion, Input::all());
		$manager->aprobarSolicitud();
		Session::flash('success', 'Se aprobó la modificacion con éxito.');
		$url = route($modificacion->poliza->ruta,$modificacion->poliza_id) . '#modificaciones';
		return Redirect::to($url);
	}

	public function reporteSolicitud($polizaModificacionId)
	{
		$modificacion = $this->polizaModificacionRepo->find($polizaModificacionId);
		$poliza = $modificacion->poliza;
		$cambios = $this->polizaModificacionDetalleRepo->getByPolizaModificacion($polizaModificacionId);
		
		$pdf = PDF::loadView('reportes/polizas/solicitud_modificacion', compact('modificacion','poliza','cambios'));
		return $pdf->download('Solicitud de Modificación - '.$modificacion->numero_solicitud.'.pdf');
	}

}

