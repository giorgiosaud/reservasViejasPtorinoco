<div class="panel panel-info Cupos">
	<div class="panel-heading ">
		<h3 class="panel-title">
			<span class="glyphicon glyphicon-tasks"></span>Cupos
		</h3>
	</div>
	<div class="panel-body">
		<div class="input-group">
			<div class="input-group-addon">
				{{ Form::label('cuposAdultos','Adultos') }}
			</div>

			{{  Form::input('number', 'adults', $Reservacion->adults,array('class'=>'form-control')) }}
			{{ Form::hidden('precioCuposAdultos',$precioAdulto=$datos[$Reservacion->boat->name]['precio'][$Reservacion->tour_id]['adulto'],array('id'=>'precioCuposAdultos')) }}
		</div>
		<div class="input-group">
			<div class="input-group-addon">
				{{ Form::label('cuposMayores','Adultos Mayores') }}
			</div>

			{{  Form::input('number', 'olders', $Reservacion->olders,array('class'=>'form-control')) }}
			{{ Form::hidden('precioCuposAdultos',$precioMayor=$datos[$Reservacion->boat->name]['precio'][$Reservacion->tour_id]['mayor'],array('id'=>'precioCuposAdultos')) }}
		</div>
		<div class="input-group">
			<div class="input-group-addon">
				{{ Form::label('cuposNinos','Niños') }}
			</div>

			{{  Form::input('number', 'childs', $Reservacion->childs,array('class'=>'form-control')) }}
			{{ Form::hidden('precioCuposAdultos',$precioNino=$datos[$Reservacion->boat->name]['precio'][$Reservacion->tour_id]['nino'],array('id'=>'precioCuposAdultos')) }}
		</div>
		<div class="input-group">
			<div class="input-group-addon">
				{{ Form::label('status','Status de Reserva') }}
			</div>
			<div class="btn-group col-xs-12" data-toggle="buttons">


<?php
if(!$Reservacion->trashed()){
	$activo = true;
	$seleccionado ='active';
	$inactivoseleccionado='';
}
else{
	$activo = false;	
	$seleccionado ='';
	$inactivoseleccionado='active';
}?>
<label class="boat col-xs-{{ $width }} btn btn-primary {{ $seleccionado }}">

					{{ Form::radio('status', 'Activo', $activo) }}
					Activo

				</label>
				<label class="boat col-xs-{{ $width }} btn btn-primary {{ $inactivoseleccionado }}">
					{{ Form::radio('status', 'Inactivo', !$activo) }}
					Inactivo
				</label>

			</div>
		</div>
	</div>
</div>
