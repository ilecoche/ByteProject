<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <title></title>
 
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
 
  </head>
  <body>

  	<div class="container">
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
  	</div>

    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src="js/tables.js" type="text/javascript"></script>
  </body>
</html>