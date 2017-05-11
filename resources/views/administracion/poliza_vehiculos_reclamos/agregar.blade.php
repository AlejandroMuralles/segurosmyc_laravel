@extends('layouts.admin')

@section('title') Agregar Solicitud de Reclamo - Certificado {{$polizaVehiculo->numero_certificado}} @stop

@section('css')
<link rel="stylesheet" href="{{asset('assets/plugins/select2/select2.css')}}">
<style>
    .select2-container { max-width: 500px }
</style>
<link href="{{asset('assets/plugins/bootstrap-datepicker/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            {!! Form::open(['route' => array('agregar_poliza_vehiculo_reclamo', $polizaVehiculo->id), 'method' => 'POST', 'id' => 'form', 'class' => 'validate-form']) !!}
             <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6">{!! Field::text('numero_aviso', null, ['data-required'=>'true']) !!}</div>            
                        <div class="col-lg-6">{!! Field::text('numero', null, ['data-required'=>'true']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            {!! Field::text('fecha', null, ['data-required'=>'true', 'class'=>'fecha']) !!}
                        </div>
                        <div class="col-lg-3">
                            <label>Hora</label>
                            <div class="input-append bootstrap-timepicker input-group">
                                <input id="timepicker1" class="form-control" type="text" name="hora" />
                                <span class="input-group-btn">
                                    <button class="btn btn-default add-on" type="button"><i class="fa fa-clock-o"></i>
                                    </button>
                                </span>
                            </div>
                        </div>
                        <div class="col-lg-6">{!! Field::text('ajustador', null, ['data-required'=>'true']) !!}</div>
                    </div>
                    <div class="row">                        
                        <div class="col-lg-6">{!! Field::text('reportante', null, ['data-required'=>'true']) !!}</div>
                        <div class="col-lg-6">{!! Field::text('piloto', null, ['data-required'=>'true']) !!}</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">{!! Field::textarea('observaciones', null, ['data-required'=>'true']) !!}</div>
                    </div>
                </div>
            
                <div class="col-lg-6">
                
                    <a onclick="agregarFila();" class="btn btn-primary btn-sm fa fa-plus"></a>
                    <br/><br/>
                    <div class="alert alert-danger alert-dismissable" id="errorCoberturas" style="display: none" >
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <span id="txtErrorCoberturas"></span>
                    </div>

                    
                        <div class="table-responsive">
                            <table class="table table-responsive" id="tablaReclamos">
                                <thead>
                                    <tr>
                                        <th>COBERTURA</th>
                                        <th width="135px">VALOR</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <p>
                <input type="submit" value="Agregar" class="btn btn-primary">
                <a href="{{ route($polizaVehiculo->poliza->ruta,$polizaVehiculo->poliza->id) }}#reclamos" class="btn btn-danger">Cancelar</a>
            </p>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@stop
@section('js')
<script src="{{ asset('assets/plugins/select2/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/bootstrap-timepicker/bootstrap-timepicker.min.js') }}"></script>
<script src="{{asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.js')}}"></script>
<script>

    var opcionesCoberturas = '';
    var filasActuales = 0;

    $(function(){

        $('.fecha').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            todayHighlight: true
        });

        $('#timepicker1').timepicker({
            showMeridian: false,
            minuteStep: 30,
            defaultTime: '07:00'
        });

        $('#errorCoberturas').hide();

        opcionesCoberturas += '<option value="">Seleccione una cobertura</option>';
        @foreach($coberturas as $cobertura)

            opcionesCoberturas += '<option value="{{$cobertura->id}}">{{$cobertura->nombre}}</option>';

        @endforeach

        $('#form').on('submit', submit);

    });

    function agregarFila()
    {
        filasActuales++;
        var html = '<tr>';
        html += '<td><select name=detalle['+filasActuales+'][cobertura] class="form-control buscar-select" data-required="true" >' + opcionesCoberturas + '</select></td>';
        html += '<td><input type="number" step="any" value="0" name=detalle['+filasActuales+'][valor]  data-required="true" class="form-control valor"></td><td><a class="btn btn-sm btn-danger fa fa-times remove"></a>';
        html += '</tr>';
        $('#tablaReclamos tr:last').after(html);
        $("select.buscar-select").select2();
        $('.remove').on('click', function(){
            $(this).closest ('tr').remove ();
        });
    }

    function submit()
    {
        $('#errorCoberturas').hide();
        if($('.valor').length <= 0){

            $('#txtErrorCoberturas').text('Ingrese alguna cobertura.');
            $('#errorCoberturas').show();
            return false;
        }

    }



</script>
@stop