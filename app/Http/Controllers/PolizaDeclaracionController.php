<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\PolizaDeclaracion;
use App\App\Repositories\PolizaDeclaracionRepo;
use App\App\Managers\PolizaDeclaracionManager;

use App\App\Repositories\PolizaRepo;
use App\App\Repositories\PolizaVehiculoRepo;
use App\App\Repositories\PolizaCoberturaRepo;
use App\App\Repositories\PolizaCoberturaVehiculoRepo;
use App\App\Repositories\PolizaDeclaracionVehiculoRepo;
use App\App\Repositories\PetroleraRepo;

class PolizaDeclaracionController extends BaseController {

	protected $polizaDeclaracionRepo;
	protected $polizaVehiculoRepo;
	protected $polizaCoberturaRepo;
	protected $polizaCoberturaVehiculoRepo;
	protected $polizaRepo;
	protected $impuestoRepo;
	protected $petroleraRepo;

	public function __construct(PolizaDeclaracionRepo $polizaDeclaracionRepo, PolizaRepo $polizaRepo, PolizaVehiculoRepo $polizaVehiculoRepo, PolizaCoberturaRepo $polizaCoberturaRepo, PolizaCoberturaVehiculoRepo $polizaCoberturaVehiculoRepo, PolizaDeclaracionVehiculoRepo $polizaDeclaracionVehiculoRepo, PetroleraRepo $petroleraRepo)
	{
		$this->polizaDeclaracionRepo = $polizaDeclaracionRepo;
		$this->polizaVehiculoRepo = $polizaVehiculoRepo;
		$this->polizaCoberturaRepo = $polizaCoberturaRepo;
		$this->polizaCoberturaVehiculoRepo = $polizaCoberturaVehiculoRepo;
		$this->polizaDeclaracionVehiculoRepo = $polizaDeclaracionVehiculoRepo;
		$this->polizaRepo = $polizaRepo;
		$this->petroleraRepo = $petroleraRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function generar($polizaId)
	{
		$data = Input::all();
		$data['poliza_id'] = $polizaId;
		$data['estado'] = 'S';
		$data['fecha_solicitud'] = date('Y-m-d H:i:s');
		$vehiculos = $this->polizaVehiculoRepo->getByPolizaByEstadoDeclaracion($polizaId,['S']);
		$manager = new PolizaDeclaracionManager(new PolizaDeclaracion(), $data);
		$manager->agregar($vehiculos);
		Session::flash('success', 'Se agregó la solicitud de declaracion con éxito.');
		$url = route('ver_poliza_declarativa',$polizaId) . '#declaraciones';
		return Redirect::to($url);
	}

	public function mostrarAgregarHidrocarburo($polizaId)
	{
		$poliza = $this->polizaRepo->find($polizaId);
		$petroleras = $this->petroleraRepo->lists('nombre','id');
		return View::make('administracion/poliza_declaraciones/agregar_hidrocarburo', compact('poliza','petroleras'));
	}

	public function agregarHidrocarburo($polizaId)
	{
		$data = Input::all();
		$data['poliza_id'] = $polizaId;
		$data['fecha_solicitud'] = date('Y-m-d H:i:s');
		$data['estado'] = 'S';
		$manager = new PolizaDeclaracionManager(new PolizaDeclaracion(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la declaración a la póliza con éxito.');
		$url = route('ver_poliza_hidrocarburos',$polizaId).'#declaraciones';
		return Redirect::to($url);
	}

	public function mostrarEditarHidrocarburo($id)
	{
		$declaracion = $this->polizaDeclaracionRepo->find($id);
		$petroleras = $this->petroleraRepo->lists('nombre','id');
		return View::make('administracion/poliza_declaraciones/agregar_hidrocarburo', compact('declaracion','petroleras'));
	}

	public function editarHidrocarburo($polizaId)
	{
		$data = Input::all();
		$data['poliza_id'] = $polizaId;
		$data['estado'] = 'S';
		$manager = new PolizaDeclaracionHidrocarburoManager(new PolizaDeclaracion(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la declaración a la póliza con éxito.');
		$url = route('ver_poliza_hidrocarburos',$polizaId).'#declaraciones';
		return Redirect::to($url);
	}

	public function mostrarAprobarSolicitud($declaracionId)
	{
		$declaracion = $this->polizaDeclaracionRepo->find($declaracionId);

		if($declaracion->estado != 'S')
		{
			Session::flash('error', 'La solicitud de declaración ya fue procesada. Estado actual: ' . $declaracion->descripcion_estado);
			if($declaracion->poliza->ramo_id == 1 || $declaracion->poliza->ramo_id == 5)
				$url = route('ver_poliza_declarativa',$declaracion->poliza_id) . '#declaraciones';
			elseif($declaracion->poliza->ramo_id == 6)
				$url = route('ver_poliza_hidrocarburos',$declaracion->poliza_id) . '#declaraciones';
			
			return Redirect::to($url);
		}
		return View::make('administracion/poliza_declaraciones/aprobar_solicitud', compact('declaracion'));
	}

	public function aprobarSolicitud($declaracionId)
	{
		$declaracion = $this->polizaDeclaracionRepo->find($declaracionId);

		if($declaracion->estado != 'S')
		{
			Session::flash('error', 'La solicitud de declaración ya fue procesada. Estado actual: ' . $declaracion->descripcion_estado);
			return Redirect::route('ver_poliza_declarativa',$declaracion->poliza_id);
		}
		$declaracion->estado = 'V';
		$declaracion->fecha_aprobada = date('Y-m-d H:i:s');
		$vehiculos = $this->polizaDeclaracionVehiculoRepo->getByDeclaracion($declaracionId);
		$manager = new PolizaDeclaracionManager($declaracion, Input::all());
		$manager->aprobarSolicitud($vehiculos);
		Session::flash('success', 'Se aprobó la declaracion con éxito.');
		if($declaracion->poliza->ramo_id == 1 || $declaracion->poliza->ramo_id == 5)
			$url = route('ver_poliza_declarativa',$declaracion->poliza_id) . '#declaraciones';
		elseif($declaracion->poliza->ramo_id == 6)
			$url = route('ver_poliza_hidrocarburos',$declaracion->poliza_id) . '#declaraciones';
		return Redirect::to($url);
	}

	public function mostrarVer($polizaDeclaracionId){
		$polizaDeclaracion = $this->polizaDeclaracionRepo->find($polizaDeclaracionId);
		$vehiculos = $this->polizaDeclaracionVehiculoRepo->getByDeclaracion($polizaDeclaracion->id);
		$coberturas = $this->polizaCoberturaRepo->getByPoliza($polizaDeclaracion->id);
		$coberturasParticulares = [] ;// $this->polizaCoberturaVehiculoRepo->getByDeclaracion($polizaDeclaracion->id);
		return View::make('administracion/poliza_declaraciones/ver', compact('polizaDeclaracion','vehiculos','coberturas','coberturasParticulares'));
	}

}
