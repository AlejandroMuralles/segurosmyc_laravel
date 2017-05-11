<?php

namespace App\Http\Controllers;
use Redirect, Input, Auth, View, Session, URL;

use Illuminate\Support\Collection; 

use App\App\Repositories\PermisoRepo;

class AdminMenuController {


	public function __construct(){

	}

    public function compose($view)
    {        

    	if (env('APP_ENV') === 'production') {
			\Debugbar::disable();
		}
		else{
			\Debugbar::enable();
		}

        $menu = new Collection();

		$menu->push((object)['title' => 'Dashboard', 'url' => URL::route('dashboard'), 'icon'=>'fa fa-dashboard']);
		//$permisoRepo = new PermisoRepo();
		//$view->menu = $permisoRepo->getMenu(Auth::user()->perfil_id, 1);
		$subMenu = new Collection();
		$subMenu->push((object)['title' => 'Modulos', 'url' => URL::route('modulos')]);
		$subMenu->push((object)['title' => 'Perfiles', 'url' => URL::route('perfiles')]);
		$subMenu->push((object)['title' => 'Usuarios', 'url' => URL::route('usuarios')]);
		$subMenu->push((object)['title' => 'Vistas', 'url' => URL::route('vistas')]);
		$menu->push((object)['title' => 'Administración', 'url' => '#', 'subMenu'=> $subMenu, 'icon'=>'fa fa-gear']);

		$subMenu = new Collection();
		$subMenu->push((object)['title' => 'Frecuencias de Pago', 'url' => URL::route('frecuencias_pagos')]);
		$subMenu->push((object)['title' => 'Impuestos', 'url' => URL::route('impuestos')]);
		$subMenu->push((object)['title' => 'Marcas de Vehículos', 'url' => URL::route('marcas_vehiculos')]);
		$subMenu->push((object)['title' => 'Motivos de Anulación', 'url' => URL::route('motivos_anulacion')]);
		$subMenu->push((object)['title' => 'Países', 'url' => URL::route('paises')]);
		$subMenu->push((object)['title' => 'Porcentajes de Fraccionamiento Generales', 'url' => URL::route('porcentajes_fraccionamientos_generales')]);
		$subMenu->push((object)['title' => 'Ramos', 'url' => URL::route('ramos')]);
		$subMenu->push((object)['title' => 'Tipos de Vehículo', 'url' => URL::route('tipos_vehiculos')]);
		$subMenu->push((object)['title' => 'Vehículos', 'url' => URL::route('vehiculos')]);
		$menu->push((object)['title' => 'Catálogos', 'url' => '#', 'subMenu'=> $subMenu, 'icon'=>'fa fa-users']);

		$subMenu = new Collection();
		$subMenu->push((object)['title' => 'No Cobrado por Mes', 'url' => URL::route('requerimientos_no_cobrados_mes')]);
		$subMenu->push((object)['title' => 'Planillas', 'url' => URL::route('planillas',0)]);
		$subMenu->push((object)['title' => 'Requerimientos Pendientes', 'url' => URL::route('requerimientos_pendientes')]);
		$menu->push((object)['title' => 'Cobros', 'url' => '#', 'subMenu'=> $subMenu, 'icon'=>'fa fa-credit-card-alt']);

		$subMenu = new Collection();
		$sm2 = new Collection();
		$sm2->push((object)['title' => 'Areas', 'url' => URL::route('areas')]);
		$sm2->push((object)['title' => 'Bancos', 'url' => URL::route('bancos')]);
		$sm2->push((object)['title' => 'Puestos', 'url' => URL::route('puestos')]);
		$subMenu->push((object)['title' => 'Catálogos', 'subMenu' => $sm2]);
		$subMenu->push((object)['title' => 'Colaboradores', 'url' => URL::route('colaboradores')]);

		$menu->push((object)['title' => 'RRHH', 'url' => '#', 'subMenu'=> $subMenu, 'icon'=>'fa fa-users']);

		$subMenu = new Collection();
		$subMenu->push((object)['title' => 'Buscar Vehículo', 'url' => URL::route('buscar_poliza_vehiculo')]);

		$sm2 = new Collection();
		$sm2->push((object)['title' => 'Aseguradoras', 'url' => URL::route('aseguradoras')]);
		$sm2->push((object)['title' => 'Area de Aseguradora', 'url' => URL::route('areas_aseguradoras')]);
		$sm2->push((object)['title' => 'Clientes', 'url' => URL::route('clientes')]);
		$sm2->push((object)['title' => 'Consorcios', 'url' => URL::route('consorcios')]);
		$sm2->push((object)['title' => 'Petroleras', 'url' => URL::route('petroleras')]);
		$sm2->push((object)['title' => 'Productos', 'url' => URL::route('productos')]);
		$sm2->push((object)['title' => 'Tipos de Modificaciones de Pólizas', 'url' => URL::route('tipos_polizas_modificaciones')]);
		$subMenu->push((object)['title' => 'Catálogos', 'subMenu' => $sm2]);

		$subMenu->push((object)['title' => 'Pólizas', 'url' => URL::route('polizas')]);
		$subMenu->push((object)['title' => 'Polizas Vigentes', 'url' => URL::route('polizas_vigentes')]);
		$subMenu->push((object)['title' => 'Solicitudes de Pólizas', 'url' => URL::route('solicitudes_polizas')]);

		$sm2 = new Collection();
		$sm2->push((object)['title' => 'Pólizas Vencidas', 'url' => URL::route('polizas_vencidas')]);
		$sm2->push((object)['title' => 'Polizas Vencidas por Mes', 'url' => URL::route('polizas_vencidas_mes',[date('Y'),date('m')])]);
		$subMenu->push((object)['title' => 'Reportes', 'subMenu' => $sm2]);
		
		$menu->push((object)['title' => 'Ventas', 'url' => '#', 'subMenu'=> $subMenu, 'icon'=>'fa fa-money']);

		$view->menu = $menu;

		$html = '';
		//$view->menu2 .= $permisoRepo->getMenu2(null,1,$html);
		//dd($view->menu2);
		/* GET USUARIO */
		$view->usuario = Auth::user();
		//dd($view->notificaciones);

    }

}