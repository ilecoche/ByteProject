<h2>Best Selling Items</h2>

<ol>
@foreach($items as $item)

		<li>{{ $item->menu_item }} | Quantity: {{ $item->totalqty }}</li>

@endforeach
</ol>

<h2>Best Selling Days In The Last Week</h2>

<ol>
@foreach($days as $day)

		<li><?php echo date('l', strtotime($day->date)); ?> | Total: ${{ $day->total }}</li>

@endforeach
</ol>