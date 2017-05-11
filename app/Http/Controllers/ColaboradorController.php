<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;


use App\App\Repositories\ColaboradorRepo;
use App\App\Repositories\AreaRepo;
use App\App\Repositories\PuestoRepo;
use App\App\Repositories\IngresoColaboradorRepo;

use App\App\Managers\ColaboradorManager;
use App\App\Entities\Colaborador;
use App\App\Repositories\PrestamoCuotaRepo;
use App\App\Repositories\VacacionColaboradorRepo;
use App\App\Repositories\SuspensionIgssColaboradorRepo;
use App\App\Repositories\AusenciaColaboradorRepo;
use App\App\Repositories\DescuentoColaboradorRepo;


class ColaboradorController extends BaseController {

	protected $colaboradorRepo;
	protected $areaRepo;
	protected $puestoRepo;
	protected $ingresoColaboradorRepo;
	protected $prestamoCuotaRepo;
	protected $vacacionColaboradorRepo;
	protected $suspensionIgssColaboradorRepo;
	protected $ausenciaColaboradorRepo;
	protected $descuentoColaboradorRepo;

	public function __construct(ColaboradorRepo $colaboradorRepo, AreaRepo $areaRepo, 
		PuestoRepo $puestoRepo, IngresoColaboradorRepo $ingresoColaboradorRepo, PrestamoCuotaRepo $prestamoCuotaRepo, VacacionColaboradorRepo $vacacionColaboradorRepo, SuspensionIgssColaboradorRepo $suspensionIgssColaboradorRepo, AusenciaColaboradorRepo $ausenciaColaboradorRepo,
			DescuentoColaboradorRepo $descuentoColaboradorRepo)
	{
		$this->colaboradorRepo = $colaboradorRepo;
		$this->areaRepo = $areaRepo;
		$this->puestoRepo = $puestoRepo;
		$this->ingresoColaboradorRepo = $ingresoColaboradorRepo;
		$this->prestamoCuotaRepo = $prestamoCuotaRepo;
		$this->vacacionColaboradorRepo = $vacacionColaboradorRepo;
		$this->suspensionIgssColaboradorRepo = $suspensionIgssColaboradorRepo;
		$this->ausenciaColaboradorRepo = $ausenciaColaboradorRepo;
		$this->descuentoColaboradorRepo = $descuentoColaboradorRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$colaboradores = $this->colaboradorRepo->all('nombres');
		return View::make('administracion/colaboradores/index', compact('colaboradores'));
	}

	public function mostrarAgregar()
	{
		$puestos = $this->puestoRepo->all('nombre')->pluck('nombre_con_area','id')->toArray();
		return View::make('administracion/colaboradores/agregar', compact('puestos'));
	}

	public function agregar()
	{
		$manager = new ColaboradorManager(new Colaborador(), Input::all());
		$manager->save();
		Session::flash('success', 'Se agregó el colaborador con éxito.');
		return Redirect::route('colaboradores');
	}

	public function mostrarEditar($id)
	{
		$colaborador = $this->colaboradorRepo->find($id);
		$puestos = $this->puestoRepo->all('nombre')->pluck('nombre_con_area','id')->toArray();
		return View::make('administracion/colaboradores/editar', compact('colaborador','puestos'));
	}

	public function editar($id)
	{
		$colaborador = $this->colaboradorRepo->find($id);
		$manager = new ColaboradorManager($colaborador, Input::all());
		$manager->save();
		Session::flash('success', 'Se actualizó el colaborador con éxito.');
		return Redirect::route('colaboradores');
	}

	public function mostrarVer($id)
	{
		$colaborador = $this->colaboradorRepo->find($id);
		$ingresos = $this->ingresoColaboradorRepo->getByColaborador($id);
		$prestamos = $this->prestamoCuotaRepo->getByColaborador($id);
		$vacaciones = $this->vacacionColaboradorRepo->getByColaborador($id);
		$suspensiones = $this->suspensionIgssColaboradorRepo->getByColaborador($id);
		$ausencias = $this->ausenciaColaboradorRepo->getByColaborador($id);
		$descuentos = $this->descuentoColaboradorRepo->getByColaborador($id);
		return View::make('administracion/colaboradores/ver', compact('colaborador','ingresos','prestamos','vacaciones','suspensiones','ausencias','descuentos'));
	}

	public function ajaxPuestosByArea($id)
	{
		$puestos = $this->puestoRepo->getByArea($id)->pluck('nombre','id')->toArray();
		return json_encode($puestos);
	}

	/* PUBLICO */
	public function mostrarAgenda()
	{
		View::composer('layouts.default', 'App\Http\Controllers\PublicMenuController');
		$colaboradores = $this->colaboradorRepo->findByContratado(true);
		return View::make('publico/rrhh/colaboradores', compact('colaboradores'));
	}
	
	public function mostrarCumplemes()
	{
		View::composer('layouts.default', 'App\Http\Controllers\PublicMenuController');
		$colaboradores = $this->colaboradorRepo->findByContratado(true);
		return View::make('publico/rrhh/cumplemes', compact('colaboradores'));
	}

}
