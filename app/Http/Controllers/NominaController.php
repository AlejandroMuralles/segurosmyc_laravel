<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\Nomina;
use App\App\Repositories\NominaRepo;
use App\App\Managers\NominaManager;

use App\App\Repositories\TipoNominaRepo;
use App\App\Managers\NominaDetalleManager;
use App\App\Repositories\NominaDetalleRepo;

class NominaController extends BaseController {

	protected $nominaRepo;
	protected $tipoNominaRepo;
	protected $nominaDetalleRepo;

	public function __construct(NominaRepo $nominaRepo, TipoNominaRepo $tipoNominaRepo, NominaDetalleRepo $nominaDetalleRepo)
	{
		$this->nominaRepo = $nominaRepo;
		$this->tipoNominaRepo = $tipoNominaRepo;
		$this->nominaDetalleRepo = $nominaDetalleRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$nominas = $this->nominaRepo->all('fecha_inicio');
		return View::make('administracion/nominas/index', compact('nominas'));
	}

	public function mostrarAgregar(){
		$tipos = $this->tipoNominaRepo->getByEstado(['A'])->pluck('descripcion','id')->toArray();
		return View::make('administracion/nominas/agregar', compact('tipos'));
	}

	public function agregar()
	{
		$data = Input::all();
		$data['estado'] = 'P';
		$manager = new NominaManager(new Nomina(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la nomina con éxito.');
		return Redirect::route('nominas');
	}

	public function mostrarEditar($id){
		$nomina = $this->nominaRepo->find($id);
		if($nomina->estado != 'P'){
			Session::flash('error', 'La nomina no está pendiente. Estado actual: ' . $nomina->descripcion_estado);
			return Redirect::route('nominas');
		}
		$tipos = $this->tipoNominaRepo->getByEstado(['A'])->pluck('descripcion','id')->toArray();		
		return View::make('administracion/nominas/editar', compact('nomina','tipos'));
	}

	public function editar($id)
	{
		$nomina = $this->nominaRepo->find($id);
		$manager = new NominaManager($nomina, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó la nomina con éxito.');
		return Redirect::route('nominas');
	}

	public function generar($id)
	{
		$nomina = $this->nominaRepo->find($id);
		$manager = new NominaDetalleManager(null, null);
		/*ANTICIPO QUINCENAL*/
		if($nomina->tipo_nomina_id == 1)
			$manager->generarAnticipoQuincenal($nomina);
		elseif($nomina->tipo_nomina_id == 2)
			$manager->generarNominaMensual($nomina);
		
		return Redirect::route('ver_nomina',$id);
	}

	public function ver($id)
	{
		$nomina = $this->nominaRepo->find($id);
		$detalle = $this->nominaDetalleRepo->getByNomina($id);
		return View::make('administracion/nominas/ver', compact('nomina','detalle'));
	}


}
