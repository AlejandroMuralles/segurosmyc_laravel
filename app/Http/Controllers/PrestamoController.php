<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\Prestamo;
use App\App\Repositories\PrestamoRepo;
use App\App\Managers\PrestamoManager;

use App\App\Repositories\ColaboradorRepo;

class PrestamoController extends BaseController {

	protected $prestamoRepo;
	protected $colaboradorRepo;

	public function __construct(PrestamoRepo $prestamoRepo, ColaboradorRepo $colaboradorRepo)
	{
		$this->prestamoRepo = $prestamoRepo;
		$this->colaboradorRepo = $colaboradorRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($colaboradorId){
		$colaborador = $this->colaboradorRepo->find($colaboradorId);
		return View::make('administracion/prestamos/agregar',compact('colaborador'));
	}

	public function agregar($colaboradorId)
	{
		$data = Input::all();
		$data['colaborador_id'] = $colaboradorId;
		$data['estado'] = 'N';
		$manager = new PrestamoManager(new Prestamo(), $data);
		$manager->agregar();
		Session::flash('success', 'Se agregó el prestamo con éxito.');
		$url = route('ver_colaborador', $colaboradorId) . '#prestamos';
		return Redirect::to($url);
	}

	public function mostrarEditar($id){
		$prestamo = $this->prestamoRepo->find($id);
		return View::make('administracion/prestamos/editar', compact('prestamo'));
	}

	public function editar($id)
	{
		$prestamo = $this->prestamoRepo->find($id);
		$manager = new PrestamoManager($prestamo, Input::all());
		$manager->editar();
		Session::flash('success', 'Se editó el prestamo con éxito.');
		$url = route('ver_colaborador', $prestamo->colaborador_id) . '#prestamos';
		return Redirect::to($url);
	}
}
