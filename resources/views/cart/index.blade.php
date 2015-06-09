@extends('layouts.main')
@section('title', 'Your cart')
@section('additionalstyles')
    <!--<link href="{{ asset('/css/custom.css') }}" rel="stylesheet">-->
@stop
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Your cart</div>
                                <ul>
                                    <li class="row list-inline headers">
                                        <span class="qty">QTY</span>
                                        <span class="name">NAME</span>
                                        <span class="subtotal">SUBTOTAL</span>
                                        <span class="actions">ACTIONS</span>
                                    </li>
                                    @foreach($cart as $row)
                                    <li class="row list-inline">
                                        <span class="qty">
                                            @if($row['qty'] > 1)
                                            <a href="{{ url('cart/update', [$row['rowid'],($row['qty'] - 1)] ) }}"><i class="glyphicon glyphicon-minus-sign btn-lg"></i></a>
                                            @else
                                            <i class="glyphicon glyphicon-minus-sign btn-lg inactve"></i>
                                            @endif
                                            {{ $row['qty'] }}
                                            
                                            <a href="{{ url('cart/update', [$row['rowid'],($row['qty'] + 1)] ) }}"><i class="glyphicon glyphicon-plus-sign btn-lg"></i></a>
                                        </span>
                                        <span class="name">{{ $row['name'] }}</span>
                                        <span class="subtotal">{{ $row['subtotal'] }}</span>
                                        <span class="actions">
                                            <a href="{{ url('cart/remove', $row['rowid']) }}"><i class="glyphicon glyphicon-remove-sign btn-lg"></i></a>
                                        </span>
                                    </li>
                                    @endforeach
                                     <li class="row list-inline footer">
                                        <span class="qty"></span>
                                        <span class="name"></span>
                                        <span class="subtotal">SUBTOTAL</span>
                                        <span class="actions">{{ $subtotal }}</span>
                                    </li>
                                    <li class="row list-inline footer">
                                        <span class="qty"></span>
                                        <span class="name"></span>
                                        <span class="subtotal">HST</span>
                                        <span class="actions">{{ $tax }}</span>
                                    </li>
                                    <li class="row list-inline footer">
                                        <span class="qty"></span>
                                        <span class="name"></span>
                                        <span class="subtotal">TOTAL</span>
                                        <span class="actions">{{ $total }}</span>
                                    </li>
                                </ul>  
                                </div>
			</div>
		</div>
	</div>
</div>
@stop
@section('additionalscripts')
<!---------function to submit delete form and process it through ajax call -------------->  
<script type="text/javascript" >  
    function deleteRow(id) {
        var row_id = id;
        var geturl = 'cart/remove/'+row_id;
        console.log(row_id);
        console.log(geturl);
        $.get(geturl, function(data, status){
            alert("Data: " + data + "\nStatus: " + status);
        });

    return false;
    }
    
    function updateForm(thisForm){
         var formData = {
                name     : $('input[name=name]').val(),
                email    : $('input[name=email]').val(),
                homepage : $('input[name=homepage]').val(),
                message  : $('textarea[name=message]').val()
            }

            $.ajax({
                type     : "POST",
                // url      : $(this).attr('action') + '/store',
                url      : $(thisForm).attr('action'),
                data     : formData,
                cache    : false,

                success  : function(data) {
                    console.log(data);
                }
            })

            // console.log(formData);

            return false;

            // alert($(this).attr('action'));

            // alert('form is submited');
        }
</script>
@stop