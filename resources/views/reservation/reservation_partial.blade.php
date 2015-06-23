<table class="table">
					
	@foreach($rtables as $table)
	<tr id="{{ $table[0]->id }}">
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