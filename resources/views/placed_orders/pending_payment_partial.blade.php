<!-- partial view for delivered orders that are unpaid -->
<h2>Order waiting for payment</h2>
<ul id="pending_payment">
<!-- logic to display orders if there are any -->
    @if(count($pendingOrder) == false)
    <p class="no_data"> There are no pending payments at this moment</p>
    @else
    @foreach($pendingOrder as $order_id => $porder)
    <li>
        <p>Table Number: {{$orders[$order_id][0]}} - Client: {{$orders[$order_id][1]}} - Total Price: {{$orders[$order_id][2]}}</p>
        @foreach($porder as $order_item)
        <span>({{$order_item->qty}}) {{$order_item->menu_item}}, </span>
        @endforeach
        <span>(@if($orders[$order_id][3] == 'completed')already paid @else waiting for payment @endif)</span>
         <!-- JORDAN JUST DELETE THIS HR IF YOU WANT -->
        <hr />
        </li>
        @endforeach
        
    
    @endif
</ul>