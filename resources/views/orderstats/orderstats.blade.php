<h2>Best Selling Items</h2>

@foreach($items as $item)

	<ul>
		<li>{{ $item->menu_item }}</li>
		<li>{{ $item->totalqty }}</li>
	</ul>

@endforeach