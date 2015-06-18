<h2>Placed Orders</h2>
<ul id="pending_orders">

    @if(count($pendingOrder) == false)
    <p class="no_data"> There are no pending orders at this moment</p>
    @else
    @foreach($pendingOrder as $order_id => $porder)
    <li>
        <p>Table Number: {{$orders[$order_id][0]}} - Client: {{$orders[$order_id][1]}} - Total Price: {{$orders[$order_id][2]}}</p>
        @foreach($porder as $order_item)
        <span>({{$order_item->qty}}), {{$order_item->menu_item}}, </span>
        @endforeach
        <span>(@if($orders[$order_id][3] == 'completed')already paid @else not paid yet @endif)</span>
        <hr />
        </li>
        @endforeach
        
    
    @endif
</ul>

