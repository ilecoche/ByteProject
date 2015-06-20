@extends("layouts.admin")

@section("content")

	<div class="container-fluid">

		<h1>Order Stats</h1>

		<h2>Best Selling Items</h2>

		<ol>
			@foreach($items as $item)

					<li>{{ $item->menu_item }} | Quantity: {{ $item->totalqty }}</li>

			@endforeach
		</ol>

		<h2>Best Selling Days In The Last Week</h2>
			<p>Between Today and Last <?php echo $days['week_ago_day']; ?>, <?php echo date('F', strtotime($days['week_ago'])); ?> <?php echo date('d', strtotime($days['week_ago'])); ?></p>

		<ol>
			@foreach($days['days'] as $day)

					<li><?php echo date('l', strtotime($day->date)); ?> | Total: ${{ $day->total }}</li>

			@endforeach
		</ol>

		<h2>Last Weeks Tip Totals</h2>
			<p>Between Sunday, <?php echo date('F', strtotime($tips['week_start'])); ?> <?php echo date('d', strtotime($tips['week_start'])); ?> and Saturday, <?php echo date('F', strtotime($tips['week_end'])); ?> <?php echo date('d', strtotime($tips['week_end'])); ?></p>

		<ol>
			@foreach($tips['tips'] as $tip)

					<li><?php echo date('l', strtotime($tip->date)); ?> | Total: ${{ $tip->tiptotal }}</li>

			@endforeach
		</ol>

		Tip Total: $<?php echo $tips['totalTip'][0]->tiptotalfull; ?>

		<h2>Last Weeks Total Revenue</h2>
			<p>Between Sunday, <?php echo date('F', strtotime($tips['week_start'])); ?> <?php echo date('d', strtotime($tips['week_start'])); ?> and Saturday, <?php echo date('F', strtotime($tips['week_end'])); ?> <?php echo date('d', strtotime($tips['week_end'])); ?></p>

		Total: $<?php echo $total[0]->totalfull; ?>

	</div>
	
@stop

