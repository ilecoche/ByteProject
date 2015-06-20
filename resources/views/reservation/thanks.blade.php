<div class="row thanks-container">
	<div class="md-col-6">
		<h1>Thank you! <i class="fa fa-check-circle"></i></h1>
		<p>A reservation has been booked under the name, <strong>{{ $data['fname'] }} {{ $data['lname'] }}</strong>. Please review the details below and <a href="#">contact us</a> if you need further assistance.</p>

		<div class="thanks-details">
			<p>Reservation Date and Time: <strong>{{ $data['date'] }}</strong> @ <strong>{{ date("g:i a",strtotime($data['time'])) }}</strong></p>
			<p>Number of Guests: <strong>{{ $data['capacity'] }} people</strong></p>
			<p>A confirmation email has been sent to: <strong>{{ $data['email'] }}</strong></p>
		</div>
	</div>
</div>