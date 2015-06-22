@extends("layouts.admin")

@section("content")

	<div class="container-fluid">

		<h1>Order Stats</h1>

		<h2>Best Selling Items</h2>

		<div id="bestselling"></div>
		@barchart('BestSelling', 'bestselling')

		<h2>Best Selling Days In The Last Week</h2>


		<div id="bestsellingdays"></div>
		@combochart('BestSellingDays', 'bestsellingdays')


		<h2>Last Weeks Tip Totals</h2>
			<p>Between Sunday, <?php echo date('F', strtotime($tips['week_start'])); ?> <?php echo date('d', strtotime($tips['week_start'])); ?> and Saturday, <?php echo date('F', strtotime($tips['week_end'])); ?> <?php echo date('d', strtotime($tips['week_end'])); ?></p>

		<div id="totaltips"></div>
		@combochart('TotalTips', 'totaltips')

		<h3>Tip Total: $<?php echo $tips['totalTip'][0]->tiptotalfull; ?></h3>

		<h2>Last Weeks Total Sales</h2>
			<p>Between Sunday, <?php echo date('F', strtotime($tips['week_start'])); ?> <?php echo date('d', strtotime($tips['week_start'])); ?> and Saturday, <?php echo date('F', strtotime($tips['week_end'])); ?> <?php echo date('d', strtotime($tips['week_end'])); ?></p>

		<h3>Sales Total: $<?php echo $total[0]->totalfull; ?></h3>

	</div>
	
@stop

