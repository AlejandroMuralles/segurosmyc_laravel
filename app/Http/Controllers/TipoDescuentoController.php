<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\TipoDescuento;
use App\App\Repositories\TipoDescuentoRepo;
use App\App\Managers\TipoDescuentoManager;

class TipoDescuentoController extends BaseController {

	protected $tipoDescuentoRepo;

	public function __construct(TipoDescuentoRepo $tipoDescuentoRepo)
	{
		$this->tipoDescuentoRepo = $tipoDescuentoRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$tipos = $this->tipoDescuentoRepo->all('nombre');
		return View::make('administracion/tipos_descuentos/index', compact('tipos'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/tipos_descuentos/agregar');
	}

	public function agregar()
	{
		$manager = new TipoDescuentoManager(new TipoDescuento(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó el tipo de vehículo con éxito.');
		return Redirect::route('tipos_descuentos');
	}

	public function mostrarEditar($id){
		$tipoDescuento = $this->tipoDescuentoRepo->find($id);
		return View::make('administracion/tipos_descuentos/editar', compact('tipoDescuento'));
	}

	public function editar($id)
	{
		$tipoDescuento = $this->tipoDescuentoRepo->find($id);
		$manager = new TipoDescuentoManager($tipoDescuento, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el tipo de descuento con éxito.');
		return Redirect::route('tipos_descuentos');
	}
}
