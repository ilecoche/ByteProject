<?php 
    date_default_timezone_set('America/Toronto');
    $date = date("F j, Y"); 
?>

@extends('app')

@section('content')

<div class="container">

    <div class="loader"></div>

    <!--<div class="result-container"></div>-->

    <div class="reserve-container">

    <div class="row">
        <div class="col-sm-12">
            <h1>Make a Resevation</h1>
        </div>
    </div>

    {!! Form::open(['action' => 'ReservationController@check', 'method' => 'POST', 'class' => 'reserve']) !!}
    
        <div class="row">

            <div class="col-sm-4">
                <div class="reserve-select">
                    <a class="reserve-label"><span class="glyphicon glyphicon-chevron-down"></span></a>
                    {!! Form::text('date', $date, array('class' => 'form-control reserve-date', 'id' => 'date')) !!}
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
                        ], '1900', array('class' => 'time', 'id' => 'time'))
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

            {!! Form::submit('Find a Table', array('class' => 'btn btn-primary form-control')) !!}

         </div><!-- /.row -->
          
        {!! Form::close() !!}

    </div>

</div>

@stop