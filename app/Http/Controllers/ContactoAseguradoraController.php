<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\ContactoAseguradora;
use App\App\Repositories\ContactoAseguradoraRepo;
use App\App\Managers\ContactoAseguradoraManager;

use App\App\Repositories\AseguradoraRepo;
use App\App\Repositories\AreaAseguradoraRepo;

class ContactoAseguradoraController extends BaseController {

	protected $contactoAseguradoraRepo;
	protected $aseguradoraRepo;
	protected $areaAseguradoraRepo;

	public function __construct(ContactoAseguradoraRepo $contactoAseguradoraRepo, AreaAseguradoraRepo $areaAseguradoraRepo, AseguradoraRepo $aseguradoraRepo)
	{
		$this->contactoAseguradoraRepo = $contactoAseguradoraRepo;
		$this->areaAseguradoraRepo = $areaAseguradoraRepo;
		$this->aseguradoraRepo = $aseguradoraRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado($aseguradoraId)
	{
		$aseguradora = $this->aseguradoraRepo->find($aseguradoraId);
		$contactos = $this->contactoAseguradoraRepo->getByAseguradora($aseguradoraId);
		return View::make('administracion/contactos_aseguradoras/index', compact('contactos','aseguradora'));
	}

	public function mostrarAgregar($aseguradoraId){
		$empresasCelular = Variable::getEmpresasCelular();
		$aseguradora = $this->aseguradoraRepo->find($aseguradoraId);
		$areas = $this->areaAseguradoraRepo->lists('nombre','id');
		return View::make('administracion/contactos_aseguradoras/agregar', compact('aseguradora','empresasCelular','areas'));
	}

	public function agregar($aseguradoraId)
	{
		$aseguradora = $this->aseguradoraRepo->find($aseguradoraId);
		$data = Input::all();
		$data['aseguradora_id'] = $aseguradoraId;
		$manager = new ContactoAseguradoraManager(new ContactoAseguradora(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el contacto con éxito.');
		return Redirect::route('contactos_aseguradoras', $aseguradoraId);
	}

	public function mostrarEditar($id){
		$contacto = $this->contactoAseguradoraRepo->find($id);
		$empresasCelular = Variable::getEmpresasCelular();
		$areas = $this->areaAseguradoraRepo->lists('nombre','id');
		return View::make('administracion/contactos_aseguradoras/editar', compact('contacto','empresasCelular','areas'));
	}

	public function editar($id)
	{
		$contacto = $this->contactoAseguradoraRepo->find($id);
		$manager = new ContactoAseguradoraManager($contacto, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el contacto con éxito.');
		return Redirect::route('contactos_aseguradoras', $contacto->aseguradora_id);
	}
}
