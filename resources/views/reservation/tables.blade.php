@extends('layouts.admin')

@section('content')

<div class="row">
	<div class="col-md-4 col-md-offset-1">
		<h2 style="text-align:center;">Manage Tables</h2>  
			
	<table class="table" id="all_tables">
		<tr>
			<th>Table Number</th>
			<th>Capacity</th>
		</tr>
		@foreach($tables as $t)	
			<tr id="{{$t->id}}">
				<td>{{$t->table_num}}</td>
				<td>{{$t->capacity}}</td>
				<td>
					<button type="submit" onClick="deleteRow({{ $t->id }})">
					<span class="glyphicon glyphicon-remove"></span>
					</button>
				</td>
			</tr>
		@endforeach	
	</table>

	{!! Form::open(['id' => 'add_table']) !!}

		{!! Form::text('table_num', null, array('placeholder' => 'Enter Table Number', 'class' => 'form-control', 'id' => 'table_num')) !!}

		{!! Form::select('capacity', [
			2 => '2',
			4 => '4'
		], '1900', array('class' => 'form-control reserve-select ', 'id' => 'capacity')) 
		!!}

		{!! Form::submit('Add Table', array('name' => 'add', 'class' => 'btn btn-primary')) !!}

	{!! Form::close() !!}

	</div>
<div class="col-md-4 col-md-offset-1">
	<h2 style="text-align:center;">Today's Reservations</h2>  
	</div>
</div>

@stop

@section('additionalscripts')

    <script src="{{ asset('js/tables.js') }}" type="text/javascript"></script>

@stop