<?php 
    date_default_timezone_set('America/Toronto');
    $date = date("F j, Y"); 
?>

@extends('layouts.main')

@section('additionalstyles')

    <link href="{{ asset('css/reservations.css')}}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-datepicker.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

@stop

@section('content')

<div class="container">

    <div class="reserve-loader"></div>

    <div class="reserve-container">
    <div class="row">
        <div class="col-sm-12">
            <h1 id="reserve-title">Make a Reservation</h1>
        </div>
    </div>

    {!! Form::open(['action' => 'ReservationController@check', 'method' => 'POST', 'class' => 'reserve']) !!}
    
        <div class="row">

            <div class="col-sm-4">
                <div class="reserve-select">
                    <a class="reserve-label"><span class="glyphicon glyphicon-chevron-down"></span></a>
                    {!! Form::text('date', $date, ['class' => 'form-control reserve-date', 'id' => 'date', 'onchange' => 'checkDate()']) !!}
                </div>
            </div>

            <div class="col-sm-4">
                <div class="reserve-select">
                    <a class="reserve-label"><span class="glyphicon glyphicon-chevron-down"></span></a>
                    {!! Form::select('time',[
                            '1200' => '12:00 PM',
                            '1230' => '12:30 PM',
                            '1300' => '1:00 PM',
                            '1330' => '1:30 PM',
                            '1400' => '2:00 PM',
                            '1430' => '2:30 PM',
                            '1500' => '3:00 PM',
                            '1530' => '3:30 PM',
                            '1600' => '4:00 PM',
                            '1630' => '4:30 PM',
                            '1700' => '5:00 PM',
                            '1730' => '5:30 PM',
                            '1800' => '6:00 PM',
                            '1830' => '6:30 PM',
                            '1900' => '7:00 PM',
                            '1930' => '7:30 PM',
                            '2000' => '8:00 PM',
                            '2030' => '8:30 PM'
                        ], '1900', array('class' => 'time reserve-select', 'id' => 'time'))
                    !!}
                </div>
            </div>

            <div class="col-sm-4">
                <div class="reserve-select">
                    <a class="reserve-label"><span class="glyphicon glyphicon-chevron-down"></span></a>
                    {!! Form::select('capacity', [
                            '1' => '1 person',
                            '2' => '2 people', 
                            '3' => '3 people', 
                            '4' => '4 people', 
                            '5' => '5 people', 
                            '6' => '6 people',
                            '7' => '7 people', 
                            '8' => '8 people', 
                            '9' => '9 people', 
                            '10' => '10 people'
                        ], '2', array('class' => 'capacity', 'id' => 'capacity'))
                    !!}
                </div>
            </div>
        </div><!-- /.row -->

        <div class="row">

            {!! Form::submit('Find a Table', array('class' => 'btn btn-primary form-control SR')) !!}

         </div><!-- /.row -->
          
        {!! Form::close() !!}

    </div>

</div>

<script>

function checkDate(){

    //alert('hi');
}

</script>

@stop
@section('additionalscripts')
    {!! HTML::script('js/jquery.validate.js') !!}
    {!! HTML::script('js/additional-methods.js') !!}
    {!! HTML::script('js/reservations.js') !!}
    {!! HTML::script('js/bootstrap-datepicker.js') !!}
    {!! HTML::script('js/datepicker-custom.js') !!}
@stop