<!-- Partial View for pending orders -->
<h2>Placed Orders</h2>
<ul id="pending_orders">
    <!-- logic to display orders if there are any -->
    
    @if(count($pendingOrder) == false)
    <p class="no_data"> There are no pending orders at this moment</p>
    @else
    @foreach($pendingOrder as $order_id => $porder)
    <li>

        <p>Table Number: {{$orders[$order_id][0]}} - Client: {{$orders[$order_id][1]}} - Total Price: {{$orders[$order_id][2]}}</p>
        @foreach($porder as $order_item)
        <span>({{$order_item->qty}}) {{$order_item->menu_item}}, </span>
        @endforeach
        <span>(@if($orders[$order_id][3] == 'completed')already paid @else not paid yet @endif)</span>
        
        <!-- Form that hold id of each order and update button -->
        {!! Form::open(['url' => 'placed_orders'])!!}
        <p>
            {!! Form::hidden('order_id', $order_id) !!}
            {!! Form::submit('Order Ready',['class' => 'btn btn-primary form-control'] )!!}
        </p>
        {!! Form::close()!!}
        </li>
        <!-- JORDAN JUST DELETE THIS HR IF YOU WANT -->
        <hr />
        @endforeach
        
    
    @endif
</ul>

