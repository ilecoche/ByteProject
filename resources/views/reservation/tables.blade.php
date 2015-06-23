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
							'default' => '--',
							2 => '2',
							4 => '4'
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
				<table class="table">
					
					@foreach($rtables as $table)
					<tr>
						<td>
							<p>
								<strong>@ {{ date("g:i a",strtotime($table[0]->time)) }}</strong> /

								<?php $cap = $table[0]->capacity ?>
								@if($cap == 1)
									<strong><?php echo $cap ?> person</strong> /
								@else
									<strong><?php echo $cap ?> people</strong> /
								@endif

								<strong>Tables</strong>
									@foreach($table as $t)
										( <strong>{{ $t->table_num }}</strong> )
									@endforeach
							</p>

							<div>{{ $table[0]->first_name }} {{ $table[0]->last_name }}</div>
							<div>{{ $table[0]->phone }}</div>
							<div>{{ $table[0]->email }}</div>

							<button type="submit" onClick="cancelReservation({{ $table[0]->id }})" class="btn btn-default">Cancel</button>

						</td>
					</tr>
					@endforeach

				</table>

		</div>

	</div><!-- /.row -->
</div><!-- /.manage-tables -->


@stop

@section('additionalscripts')
	
    <script src="{{ asset('js/jquery.validate.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/tables.js') }}" type="text/javascript"></script>

@stop