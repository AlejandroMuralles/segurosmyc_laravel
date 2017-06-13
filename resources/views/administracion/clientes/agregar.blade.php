@extends('layouts.admin')

@section('title') Agregar Cliente @stop

@section('header') Agregar Cliente @stop

@section('css')
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_cliente',$tipoCliente), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
			
			<div class="row">
				<div class="col-lg-12">
					{!! Field::text('nombre', null, ['data-required'=>'true']) !!}
				</div>
				<div class="col-lg-3">{!! Field::text('nit', null, ['data-required'=>'true']) !!}</div>
				<div class="col-lg-3">{!! Field::text('telefonos') !!}</div>
				<div class="col-lg-3">{!! Field::text('correo') !!}</div>
				<div class="col-lg-3">{!! Field::select('genero',$generos) !!}</div>
			</div>

			<div class="row">
			@if($tipoCliente == 'E')
				<div class="col-lg-12">{!! Field::text('representante_legal', null, ['data-required'=>'true']) !!}</div>
			@endif
				<div class="col-lg-4">{!! Field::number('dpi', null, ['data-required'=>'true']) !!}</div>
				<div class="col-lg-4">{!! Field::text('fecha_nacimiento', null, ['data-required'=>'true','class'=>'fecha']) !!}</div>
			</div>

			<div class="row">
				<div class="col-lg-4">{!! Field::text('tipo_actividad') !!}</div>
				<div class="col-lg-4">{!! Field::text('profesion') !!}</div>
				<div class="col-lg-4">{!! Field::text('oficio') !!}</div>
			</div>

			<div class="row">
				<h3>Datos de Facturación</h3>
				<div class="col-lg-9">{!! Field::text('nombre_facturacion', null, ['data-required'=>'true']) !!}</div>
				<div class="col-lg-3">{!! Field::text('nit_facturacion', null, ['data-required'=>'true']) !!}</div>
				<div class="col-lg-4">{!! Field::select('pais_facturacion_id', $paises, null, ['id'=>'pais_facturacion_id', 'data-required'=>'true']) !!}</div>
				<div class="col-lg-4">{!! Field::select('departamento_facturacion_id', [], null, ['id'=>'departamento_facturacion_id', 'data-required'=>'true']) !!}</div>
				<div class="col-lg-4">{!! Field::select('municipio_facturacion_id', [], null, ['id'=>'municipio_facturacion_id', 'data-required'=>'true']) !!}</div>
				<div class="col-lg-12">
					{!! Field::text('direccion_facturacion',null, ['data-required'=>'true']) !!}
				</div>
				<div class="col-lg-4">
					{!! Field::text('zona_facturacion',null, ['data-required'=>'true']) !!}
				</div>

			</div>

			<div class="row">
				<h3>Dirección Fiscal</h3>
				<div class="col-lg-4">{!! Field::select('pais_fiscal_id', $paises, null, ['id'=>'pais_fiscal_id', 'data-required'=>'true']) !!}</div>
				<div class="col-lg-4">{!! Field::select('departamento_fiscal_id', [], null, ['id'=>'departamento_fiscal_id', 'data-required'=>'true']) !!}</div>
				<div class="col-lg-4">{!! Field::select('municipio_fiscal_id', [], null, ['id'=>'municipio_fiscal_id', 'data-required'=>'true']) !!}</div>
				<div class="col-lg-12">
					{!! Field::text('direccion_fiscal',null, ['data-required'=>'true']) !!}
				</div>
				<div class="col-lg-4">
					{!! Field::text('zona_fiscal',null, ['data-required'=>'true']) !!}
				</div>

			</div>

			<div class="row">
				<div class="col-lg-12">
					{!! Field::select('consorcio_id', $consorcios) !!}
				</div>
			</div>
				

				<br/>

	            <p>
	                <input type="submit" value="Agregar" class="btn btn-primary">
	                <a href="{{ route('clientes') }}" class="btn btn-danger">Cancelar</a>
	            </p>

            {!! Form::close() !!}
		</div>
	</div>
</div>
@stop
@section('js')
<script>

	function updateDepartamentos(select, paisId)
	{
		$.ajax({
			url: "{{ route('inicio') }}/ajax/departamentos-pais/" + paisId,
		  	dataType: "json",
		  	success: function(data) {
			    var name, option;
			    // Clear the old options
			    select.options.length = 0;
			    select.options.add(new Option('Seleccione', ''));
			    // Load the new options
			    for (name in data) {
			      if (data.hasOwnProperty(name)) {
			        select.options.add(new Option(data[name], name));
			      }
			    }
			}
		});
	}

	function updateMunicipios(select, departamentoId)
	{
		$.ajax({
			url: "{{ route('inicio') }}/ajax/municipios-departamento/" + departamentoId,
		  	dataType: "json",
		  	success: function(data) {
			    var name, option;

			    // Clear the old options
			    select.options.length = 0;
			    select.options.add(new Option('Seleccione', ''));
			    // Load the new options
			    for (name in data) {
			      if (data.hasOwnProperty(name)) {
			        select.options.add(new Option(data[name], name));
			      }
			    }
			}
		});
	}

    $(function(){

    	$('#pais_facturacion_id').on('change', function()
    	{
    		select = document.getElementById('departamento_facturacion_id');
    		updateDepartamentos(select  , $('#pais_facturacion_id').val());
    	});

    	$('#departamento_facturacion_id').on('change', function()
    	{
    		select = document.getElementById('municipio_facturacion_id');
    		updateMunicipios(select  , $('#departamento_facturacion_id').val());
    	});

    	/*FISCAL*/
    	$('#pais_fiscal_id').on('change', function()
    	{
    		select = document.getElementById('departamento_fiscal_id');
    		updateDepartamentos(select  , $('#pais_fiscal_id').val());
    	});

    	$('#departamento_fiscal_id').on('change', function()
    	{
    		select = document.getElementById('municipio_fiscal_id');
    		updateMunicipios(select  , $('#departamento_fiscal_id').val());
    	});

    });
</script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script>
    $(function(){
    	$('.fecha').datepicker({
    		format: 'yyyy-mm-dd',
		    autoclose: true,
		    todayHighlight: true
		});

    });
</script>
@stop