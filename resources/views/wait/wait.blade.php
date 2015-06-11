<html>

<head>
	<meta name="csrf-token" content="{!! csrf_token() !!}">
</head>

	<body>

		<h1>Wait Time</h1>

		{!! Form::open(['add-party']) !!}
			
			<ul>

				<li>
					{!! Form::label('name', 'Name') !!}
					{!! Form::text('name', null, ['placeholder' => 'Enter Name']) !!}
				</li>
				<li>
					{!! Form::label('partynumber', 'Party Amount') !!}
					{!! Form::text('partynumber', null, ['placeholder' => 'Enter Party Amount']) !!}
				</li>
				<li>
					{!! Form::label('email', 'Email') !!}
					{!! Form::text('email', null, ['placeholder' => 'Enter Email']) !!}
				</li>
				<li>
					{!! Form::label('number', 'Phone Number') !!}
					{!! Form::text('number', null, ['placeholder' => 'Enter Phone Number']) !!}
				</li>

			</ul>

		{!! Form::submit('Add To Wait List', ['class' => 'submitBtn']) !!}
		{!! Form::close() !!}

		<div><p>Average Wait Time: <span id="waittime">{{$average}}</span> Minutes</p></div>

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
						<td><input type="button" value="+" onClick="seatCustomer('{{$entry['id']}}')" /></td>
					</tr>
			@endforeach
		</table>

	</div>

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
 	<script src="js/waitlist.js" type="text/javascript"></script>

	</body>

	
</html>

