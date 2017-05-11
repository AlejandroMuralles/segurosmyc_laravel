<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\Rubro;
use App\App\Repositories\RubroRepo;
use App\App\Managers\RubroManager;

class RubroController extends BaseController {

	protected $rubroRepo;

	public function __construct(RubroRepo $rubroRepo)
	{
		$this->rubroRepo = $rubroRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$rubros = $this->rubroRepo->all('descripcion');
		return View::make('administracion/rubros/index', compact('rubros'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/rubros/agregar');
	}

	public function agregar()
	{
		$data = Input::all();
		$data['estado'] = 'A';
		$manager = new RubroManager(new Rubro(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el rubro '. $data['descripcion'] .' con éxito.');
		return Redirect::route('rubros');
	}

	public function mostrarEditar($id){
		$rubro = $this->rubroRepo->find($id);
		$estados = Variable::getEstadosGenerales();
		return View::make('administracion/rubros/editar', compact('rubro','estados'));
	}

	public function editar($id)
	{
		$rubro = $this->rubroRepo->find($id);
		$manager = new RubroManager($rubro, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el rubro '.$rubro->descripcion.' con éxito.');
		return Redirect::route('rubros');
	}
}
