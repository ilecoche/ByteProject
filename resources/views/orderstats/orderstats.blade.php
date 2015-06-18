<h2>Best Selling Items</h2>

@foreach($items as $item)

	<ul>
		<li>{{ $item->menu_item }}</li>
		<li>Quantity: {{ $item->totalqty }}</li>
	</ul>

@endforeach

<h2>Best Selling Day This Week</h2>