<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\PrestamoCuota;
use App\App\Repositories\PrestamoCuotaRepo;
use App\App\Managers\PrestamoCuotaManager;

use App\App\Repositories\PrestamoRepo;

class PrestamoCuotaController extends BaseController {

	protected $prestamoCuotaRepo;
	protected $prestamoRepo;

	public function __construct(PrestamoCuotaRepo $prestamoCuotaRepo, PrestamoRepo $prestamoRepo)
	{
		$this->prestamoCuotaRepo = $prestamoCuotaRepo;
		$this->prestamoRepo = $prestamoRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function mostrarEditar($id){
		$prestamo = $this->prestamoCuotaRepo->find($id);
		$estados = Variable::getEstadosCobros();
		return View::make('administracion/prestamos_cuotas/editar', compact('prestamo','estados'));
	}

	public function editar($id)
	{
		$prestamo = $this->prestamoCuotaRepo->find($id);
		$data = Input::all();
		$data['prestamo_id'] = $prestamo->prestamo_id;
		$data['cuota'] = $prestamo->cuota;		
		$mes = $data['mes_cobro'] . '-01';
		$data['mes_cobro'] = date('Y-m-t', strtotime($mes));
		$manager = new PrestamoCuotaManager($prestamo, $data);
		$manager->save();
		Session::flash('success', 'Se editó el prestamo con éxito.');
		$url = route('ver_colaborador', $prestamo->prestamo->colaborador_id) . '#prestamos';
		return Redirect::to($url);
	}
}
