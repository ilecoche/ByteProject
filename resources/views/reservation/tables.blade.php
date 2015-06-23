@extends('layouts.admin')

@section('additionalstyles')

    <link href="{{ asset('css/reservations.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

@stop

@section('content')

<div class="manage-tables">

	<div class="row">
		<div class="col-md-4 col-md-offset-1">
			<h2 style="text-align:center;">Manage Tables</h2>  
				
			<table class="table" id="all_tables">
				<tr>
					<th>Table Number</th>
					<th>Capacity</th>
					<th>Delete</th>
				</tr>
				@foreach($tables as $t)	
					<tr id="{{$t->id}}">
						<td>{{$t->table_num}}</td>
						<td>{{$t->capacity}}</td>
						<td class="delete-table">
							<button type="submit" onClick="deleteRow({{ $t->id }})" class="btn btn-default">
							<span class="glyphicon glyphicon-remove"></span>
							</button>
						</td>
					</tr>
				@endforeach	
			</table>	

			{!! Form::open(['class' => 'add_table']) !!}

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						{!! Form::text('table_num', null, array('placeholder' => 'Enter Table Number', 'class' => 'form-control', 'id' => 'table_num')) !!}
					</div>
				</div>
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						{!! Form::select('capacity', [
							'default' => 'Select Table Capacity',
							2 => '2 people',
							4 => '4 people'
						], '--', array('class' => 'form-control reserve-select ', 'id' => 'capacity')) 
						!!}
					</div>
				</div>
			</div><!-- /.row -->
			<div class="row">
				<div class="col-md-12">
					{!! Form::submit('Add Table', array('class' => 'btn btn-primary form-control SR')) !!}
				</div>
			</div>
		</div>

		{!! Form::close() !!}

		<div class="col-md-4 col-md-offset-1">
			<h2 style="text-align:center;">Today's Reservations</h2>
				
			<div id="today"></div>

		</div>

	</div><!-- /.row -->
</div><!-- /.manage-tables -->


@stop

@section('additionalscripts')
	
    <script src="{{ asset('js/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/tables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/todayreservations.js') }}" type="text/javascript"></script>

@stop