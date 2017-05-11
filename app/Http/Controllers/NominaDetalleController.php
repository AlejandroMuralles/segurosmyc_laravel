<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session;

use App\App\Entities\NominaDetalle;
use App\App\Repositories\NominaDetalleRepo;
use App\App\Managers\NominaDetalleManager;

use App\App\Repositories\NominaRepo;

class NominaController extends BaseController {

	protected $nominaDetalleRepo;
	protected $nominaRepo;

	public function __construct(NominaDetalleRepo $nominaDetalleRepo, NominaRepo $nominaRepo)
	{
		$this->nominaDetalleRepo = $nominaDetalleRepo;
		$this->nominaRepo = $nominaRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado()
	{
		$detalle = $this->nominaDetalleRepo->all('id');
		return View::make('administracion/nominas_detalle/index', compact('detalle'));
	}
}
