<div class="reserve-container">
<div class="thanks-container">
    <h2>Complete your reservation</h2>

    <div class="row">
        <div class="col-sm-4">
            <div class="panel">
                <div class="panel-heading SR">DATE</div>
                <div class="panel-body">
                    <p class="res-detail-title">{{ $date }}</p>
                </div>
            </div><!-- /.panel -->
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
            <div class="panel">
                <div class="panel-heading SR">TIME</div>
                <div class="panel-body">
                    <p class="res-detail-title">{{ date("g:i a",strtotime($time)) }}</p>
                </div>
            </div><!-- /.panel -->
        </div><!-- /.col-sm-4 -->
        <div class="col-sm-4">
            <div class="panel">
                <div class="panel-heading SR">GUESTS</div>
                <div class="panel-body">
                    <p class="res-detail-title">{{ $capacity }} people</p>
                </div>
            </div><!-- /.panel -->
        </div><!-- /.col-sm-4 -->
    </div><!-- /.row -->

    <h3>Personal Information</h3>
            
    {!! Form::open(['action' => 'ReservationController@reserve', 'method' => 'POST', 'class' => 'confirm']) !!}

        {!! Form::hidden('date', $date, array('id' => 'date')) !!}

        {!! Form::hidden('time', $time, array('id' => 'time')) !!}

        {!! Form::hidden('capacity', $capacity, array('id' => 'capacity')) !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('fname', null, array('placeholder' => 'First Name', 'class' => 'form-control reserve-input required', 'id' => 'fname')) !!}
            </div><!-- /.form-group -->
        </div><!-- /.col-sm-6 -->

        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('lname', null, array('placeholder' => 'Last Name', 'class' => 'form-control reserve-input required', 'id' => 'lname')) !!}
            </div><!-- /.form-group -->
        </div><!-- /.col-sm-6 -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::text('email', null, array('placeholder' => 'Email', 'class' => 'form-control reserve-input required', 'id' => 'email')) !!}
            </div><!-- /.form-group -->
        </div><!-- /.col-sm-12 -->
    </div><!-- /.row -->

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::text('phone', null, array('placeholder' => 'Phone (e.g. 212-999-0983)', 'class' => 'form-control reserve-input required', 'id' => 'phone')) !!}
            </div><!-- /.form-group -->
        </div><!-- /.col-sm-12 -->
    </div><!-- /.row -->

    <div class="row">

        <div class="res-confirm-btn">
                {!! Form::submit('Reserve', ['id' => 'reserve-btn', 'class' => 'btn btn-primary SR']) !!}

            {!! Form::close() !!}
        </div><!-- /.res-confirm-btn -->

        <div class="res-confirm-btn">
            {!! Form::open(['action' => 'ReservationController@back', 'method' => 'POST', 'class' => 'goback']) !!}

                {!! Form::hidden('date', $date, array('id' => 'date')) !!}

                {!! Form::hidden('time', $time, array('id' => 'time')) !!}

                {!! Form::hidden('capacity', $capacity, array('id' => 'capacity')) !!}

                {!! Form::submit('Previous', ['name' => 'back', 'id' => 'back-btn', 'class' => 'btn btn-default']) !!}

            {!! Form::close() !!}

        </div><!-- /.res-confirm-btn -->
    </div><!-- /.row -->
    </div>
</div><!-- /.reserve-container -->

<!-- Scripts -->
{!! HTML::script('js/jquery.validate.js') !!}
{!! HTML::script('js/additional-methods.js') !!}
{!! HTML::script('js/reservations.js') !!}