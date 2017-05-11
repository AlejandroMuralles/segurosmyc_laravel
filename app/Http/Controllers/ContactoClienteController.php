<?php

namespace App\Http\Controllers;
use Controller, Redirect, Input, Auth, View, Session, Variable;

use App\App\Entities\ContactoCliente;
use App\App\Repositories\ContactoClienteRepo;
use App\App\Managers\ContactoClienteManager;

use App\App\Repositories\ClienteRepo;

class ContactoClienteController extends BaseController {

	protected $contactoClienteRepo;
	protected $clienteRepo;

	public function __construct(ContactoClienteRepo $contactoClienteRepo, ClienteRepo $clienteRepo)
	{
		$this->contactoClienteRepo = $contactoClienteRepo;
		$this->clienteRepo = $clienteRepo;

		View::composer('layouts.admin', 'App\Http\Controllers\AdminMenuController');
	}

	public function listado($clienteId)
	{
		$cliente = $this->clienteRepo->find($clienteId);
		$contactos = $this->contactoClienteRepo->getByCliente($clienteId);
		return View::make('administracion/contactos_clientes/index', compact('contactos','cliente'));
	}

	public function mostrarAgregar($clienteId){
		$empresasCelular = Variable::getEmpresasCelular();
		$cliente = $this->clienteRepo->find($clienteId);
		return View::make('administracion/contactos_clientes/agregar', compact('cliente','empresasCelular'));
	}

	public function agregar($clienteId)
	{
		$cliente = $this->clienteRepo->find($clienteId);
		$data = Input::all();
		$data['cliente_id'] = $clienteId;
		$manager = new ContactoClienteManager(new ContactoCliente(), $data);
		$manager->save();
		Session::flash('success', 'Se agregó el contacto con éxito.');
		return Redirect::route('contactos_clientes', $clienteId);
	}

	public function mostrarEditar($id){
		$contacto = $this->contactoClienteRepo->find($id);
		$empresasCelular = Variable::getEmpresasCelular();
		return View::make('administracion/contactos_clientes/editar', compact('contacto','empresasCelular'));
	}

	public function editar($id)
	{
		$contacto = $this->contactoClienteRepo->find($id);
		$manager = new ContactoClienteManager($contacto, Input::all());
		$manager->save();
		Session::flash('success', 'Se editó el contacto con éxito.');
		return Redirect::route('contactos_clientes', $contacto->cliente_id);
	}
}
