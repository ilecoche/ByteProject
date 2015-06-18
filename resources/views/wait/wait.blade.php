@extends("layouts.admin")

@section("content")

<head>
	<meta name="csrf-token" content="{!! csrf_token() !!}">

	<style>
		table tr td:empty {
			width: 50px;
		}

		table tr td {
			padding-top: 10px;
			padding-bottom: 10px;
			padding-right: 20px;
			padding-left: 20px;
		}

		table tr th {
			padding-top: 10px;
			padding-bottom: 10px;
			padding-right: 20px;
			padding-left: 20px;
		}

		.textfield{
			padding: 5px;
			margin: 5px;
		}

		.labelstyle{
			display: inline-block;
		    width: 100px;
		    text-align: right;
		}

		.ulstyle{
			list-style: none;
		}
	</style>

</head>

	<div class="container-fluid">

		<h1>Wait Time</h1>

		<div><p style="font-size: 20px"><strong>Average Wait Time: <span id="waittime">{{$average}}</span> Minutes</strong></p></div>

		<span id="error"></span>

		</br>

		{!! Form::open(['add-party']) !!}
			
			<ul class="ulstyle">

				<li>
					{!! Form::label('name', 'Name', ['class' => 'labelstyle']) !!}
					{!! Form::text('name', null, ['placeholder' => 'Enter Name', 'class' => 'textfield']) !!}
					<span id="nameerror"></span>
				</li>
				<li>
					{!! Form::label('partynumber', 'Party Amount', ['class' => 'labelstyle']) !!}
					{!! Form::text('partynumber', null, ['placeholder' => 'Enter Party Amount', 'class' => 'textfield']) !!}
					<span id="partyerror"></span>
				</li>
				<li>
					{!! Form::label('email', 'Email', ['class' => 'labelstyle']) !!}
					{!! Form::text('email', null, ['placeholder' => 'Enter Email', 'class' => 'textfield']) !!}
					<span id="emailerror"></span>
				</li>
				<li>
					{!! Form::label('number', 'Phone Number', ['class' => 'labelstyle']) !!}
					{!! Form::text('number', null, ['placeholder' => 'Enter Phone Number', 'class' => 'textfield']) !!}
					<span id="phoneerror"></span>
				</li>

			</ul>

		{!! Form::submit('Add To Wait List', ['class' => 'btn SR']) !!}
		{!! Form::close() !!}

		<br />
		
		<div class="loader">
			<div class="flipper">
				<div class="front"></div>
				<div class="back"></div>
			</div>
		</div>

		<div id="tablediv">
		
		<table id="waitListTable">
			<tr>
				<th>Line #</th>
				<th>Customer Name</th>
				<th>Party Amount</th>
				<th>Email</th>
				<th>Phone Number</th>
				<th>Accept</th>
			</tr>
			@foreach($entries as $entry)
					<tr id="row_{{$entry['id']}}">
						<td class="counter"></td>
						<td>{{ $entry['name'] }}</td>
						<td>{{ $entry['partynumber'] }}</td>
						<td>{{ $entry['email'] }}</td>
						<td>{{ $entry['number'] }}</td>
						<td><input type="button" value="+" onClick="seatCustomer('{{$entry['id']}}')" class="btn SR"/></td>
					</tr>
			@endforeach
		</table>

	</div>

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
 	<script src="js/waitlist.js" type="text/javascript"></script>
 	
	</div>

@stop

