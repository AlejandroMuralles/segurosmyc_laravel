<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\DescuentoColaborador;
use App\App\Repositories\DescuentoColaboradorRepo;
use App\App\Managers\DescuentoColaboradorManager;

use App\App\Repositories\TipoDescuentoRepo;
use App\App\Repositories\ColaboradorRepo;

class DescuentoColaboradorController extends BaseController {

	protected $descuentoColaboradorRepo;
	protected $tipoDescuentoRepo;
	protected $colaboradorRepo;

	public function __construct(DescuentoColaboradorRepo $descuentoColaboradorRepo, TipoDescuentoRepo $tipoDescuentoRepo, ColaboradorRepo $colaboradorRepo)
	{
		$this->descuentoColaboradorRepo = $descuentoColaboradorRepo;
		$this->tipoDescuentoRepo = $tipoDescuentoRepo;
		$this->colaboradorRepo = $colaboradorRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarAgregar($colaboradorId){
		$colaborador = $this->colaboradorRepo->find($colaboradorId);
		$tipos = $this->tipoDescuentoRepo->lists('descripcion','id');
		$estados = Variable::getEstadosDescuentos();
		return View::make('administracion/descuentos_colaboradores/agregar',compact('colaborador','descuentos','tipos','estados'));
	}

	public function agregar($colaboradorId)
	{
		$data = Input::all();
		$data['colaborador_id'] = $colaboradorId;
		$manager = new DescuentoColaboradorManager(new DescuentoColaborador(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó la descuento con éxito.');
		$url = route('ver_colaborador', $colaboradorId) . '#descuentos';
		return Redirect::to($url);
	}

	public function mostrarEditar($id){
		$tipos = $this->tipoDescuentoRepo->lists('descripcion','id');
		$estados = Variable::getEstadosDescuentos();
		$descuento = $this->descuentoColaboradorRepo->find($id);
		return View::make('administracion/descuentos_colaboradores/editar', compact('descuento','tipos','estados'));
	}

	public function editar($id)
	{
		$descuento = $this->descuentoColaboradorRepo->find($id);
		$data = Input::all();
		$data['colaborador_id'] = $descuento->colaborador_id;
		$data['tipo_descuento_id'] = $descuento->tipo_descuento_id;
		$manager = new DescuentoColaboradorManager($descuento, $data);
		$manager->save();
		Session::flash('success', 'Se editó la descuento con éxito.');
		$url = route('ver_colaborador', $descuento->colaborador_id) . '#descuentos';
		return Redirect::to($url);
	}
}
