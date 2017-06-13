<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\Banco;
use App\App\Repositories\BancoRepo;
use App\App\Managers\BancoManager;

use App\App\Repositories\AreaRepo;

class BancoController extends BaseController {

	protected $bancoRepo;
	protected $areaRepo;

	public function __construct(BancoRepo $bancoRepo, AreaRepo $areaRepo)
	{
		$this->bancoRepo = $bancoRepo;
		$this->areaRepo = $areaRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$bancos = $this->bancoRepo->all('nombre');
		return View::make('administracion/bancos/index', compact('bancos'));
	}

	public function mostrarAgregar(){
		return View::make('administracion/bancos/agregar');
	}

	public function agregar()
	{
		$data = Input::all();
		$data['estado'] = 'A';
		$manager = new BancoManager(new Banco(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el banco '.Input::get('nombre').' con éxito.');
		return Redirect::route('bancos');
	}

	public function mostrarEditar($id){
		$banco = $this->bancoRepo->find($id);
		return View::make('administracion/bancos/editar', compact('banco'));
	}

	public function editar($id)
	{
		$banco = $this->bancoRepo->find($id);
		$data = Input::all();
		$data['estado'] = $banco->estado;
		$manager = new BancoManager($banco, $data);
		$manager->save();
		Session::flash('success', 'Se editó el banco '.$banco->nombre.' con éxito.');
		return Redirect::route('bancos');
	}
}
