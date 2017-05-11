<?php

namespace App\App\Repositories;

use App\App\Entities\Permiso;
use App\App\Entities\Modulo;
use App\App\ExtraEntities\Menu;

class PermisoRepo extends BaseRepo {

	public function getModel()
	{
		return new Permiso;
	}

	public function tienePermiso($perfilId, $ruta)
	{
		$sql = '
			SELECT *
			FROM permiso p, vista v 
			WHERE p.vista_id = v.id
				AND p.perfil_id = '. $perfilId .'
				AND v.ruta = \''. $ruta .'\'
		';
		$result = \DB::select(\DB::raw($sql));
		return count($result)  != 0 ? true : false ;
	}

	public function getMenu($perfilId)
	{
		$sql = '
			SELECT m.id as modulo_id, m.nombre nombre_modulo, m.icono icono_modulo, v.id vista_id, v.nombre nombre, v.icono icono, v.ruta ruta, v.parametros
			FROM permiso p, vista v, modulo m
			WHERE p.perfil_id = ' .$perfilId . '
				AND p.vista_id = v.id 
				AND v.modulo_id = m.id 
				AND v.menu != 0
			ORDER BY m.nombre, v.nombre
		';
		$menuPublico = array();
		$vistas = \DB::select(\DB::raw($sql));

		$menu = array();
		$modulo = new Modulo();
		$modulo->id = $vistas[0]->modulo_id;
		$modulo->nombre = $vistas[0]->nombre_modulo;
		$modulo->icono = $vistas[0]->icono_modulo;
		$menuItem = new Menu($modulo);
		foreach($vistas as $vista)
		{
			if($modulo->id == $vista->modulo_id)
			{
				$menuItem->vistas[] = $vista;
			}
			else{
				$menu[] = $menuItem;
				$modulo = new Modulo();
				$modulo->id = $vista->modulo_id;
				$modulo->nombre = $vista->nombre_modulo;
				$modulo->icono = $vista->icono_modulo;
				$menuItem = new Menu($modulo);
				$menuItem->vistas[] = $vista;
			}
		}
		$menu[] = $menuItem;
		
		return $menu;
	}

	public function getMenu2($menuPadreId, $level, $html)
	{
		if ( is_null( $menuPadreId ) ) {
			$sql = '
				SELECT *
				FROM menu m LEFT OUTER JOIN (
						SELECT menu_id, COUNT(1) AS total
						FROM menu 
						GROUP BY menu_id
					) padre ON m.id = padre.menu_id
				WHERE m.menu_id IS NULL';
		}
		else{
			$sql = '
				SELECT *
				FROM menu m LEFT OUTER JOIN (
						SELECT menu_id, COUNT(1) AS total
						FROM menu 
						GROUP BY menu_id
					) padre ON m.id = padre.menu_id
				WHERE m.menu_id = '.$menuPadreId;
		}

		$menu = \DB::select(\DB::raw($sql));

		foreach($menu as $m){
			if($m->total > 0){
        		$html .= '<li class="has-submenu">';
        		$html .= '<a href="#"> <i class="'. $m->icono .'"></i>'. $m->nombre .'</a>';
            	$html .= '<ul class="submenu">';
            	$html2 = '';
            	$html .= $this->getMenu2($m->id, $level+1, $html2);
            	$html .= '</ul>';
            	$html .= '</li>';
            }
            else{
            	$html .= '<li><a href="#"> <i class="'. $m->icono. '"></i>'. $m->nombre .'</a></li>';
            }
        }        
        
        return $html;
	}



	public function getPermisos($perfilId)
	{
		$sql = '
			SELECT *
			FROM vista v, modulo m
			WHERE v.modulo_id = m.id 
			GROUP BY m.id
		';
		$modulosVistas = array();
		$modulos = \DB::select(\DB::raw($sql));

		foreach($modulos as $modulo)
		{
			$moduloVista = new Menu($modulo);
			$sql = '
				SELECT v.nombre, v.id, \'checked\' as checked
				FROM vista v 
				WHERE v.modulo_id = '.$modulo->id.'
					AND v.id IN ( 
						SELECT vista_id FROM permiso WHERE perfil_id = '.$perfilId.' 
					)
				UNION
				SELECT v.nombre, v.id, \'\' as checked
				FROM vista v 
				WHERE v.modulo_id = '.$modulo->id.'
					AND v.id NOT IN ( 
						SELECT vista_id FROM permiso WHERE perfil_id = '.$perfilId.' 
					)
				ORDER BY nombre
			';
			$moduloVista->vistas = \DB::select(\DB::raw($sql));
			$modulosVistas[] = $moduloVista;
		}
		
		return $modulosVistas;
	}

}