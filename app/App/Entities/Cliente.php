<?php

namespace App\App\Entities;

use Variable;

class Cliente extends \Eloquent {
	protected $fillable = ['nombre','nit','pais_fiscal_id','departamento_fiscal_id','municipio_fiscal_id','direccion_fiscal','zona_fiscal','nombre_facturacion','pais_facturacion_id','departamento_facturacion_id','municipio_facturacion_id','direccion_facturacion','zona_facturacion','pais_correspondencia_id','departamento_correspondencia_id','municipio_correspondencia_id','direccion_correspondencia','zona_correspondencia','representante_legal','dpi','telefonos','correo','fecha_nacimiento','consorcio_id','tipo_cliente','profesion','tipo_actividad','genero','oficio','nit_facturacion','estado'];

	protected $table = 'cliente';

	public function getDescripcionGeneroAttribute()
	{
		return Variable::getGenero($this->genero);
	}

	public function paisFacturacion()
	{
		return $this->belongsTo('App\App\Entities\Pais','pais_facturacion_id');
	}

	public function departamentoFacturacion()
	{
		return $this->belongsTo('App\App\Entities\Departamento','departamento_facturacion_id');
	}

	public function municipioFacturacion()
	{
		return $this->belongsTo('App\App\Entities\Municipio','municipio_facturacion_id');
	}

	public function paisFiscal()
	{
		return $this->belongsTo('App\App\Entities\Pais','pais_fiscal_id');
	}

	public function departamentoFiscal()
	{
		return $this->belongsTo('App\App\Entities\Departamento','departamento_fiscal_id');
	}

	public function municipioFiscal()
	{
		return $this->belongsTo('App\App\Entities\Municipio','municipio_fiscal_id');
	}

	public function consorcio()
	{
		return $this->belongsTo('App\App\Entities\Consorcio');
	}

}