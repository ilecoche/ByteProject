<div class="reserve-container">
<h2>Step 2: Complete your reservation</h2>
<div class="row">
    <div class="col-sm-4">
        <div class="panel">
            <div class="panel-heading SR">DATE</div>
            <div class="panel-body">
                <p class="res-detail-title">{{ $date }}</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel">
            <div class="panel-heading SR">TIME</div>
            <div class="panel-body">
                <p class="res-detail-title">{{ date("g:i a",strtotime($time)) }}</p>
            </div>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="panel">
            <div class="panel-heading SR">GUESTS</div>
            <div class="panel-body">
                <p class="res-detail-title">{{ $capacity }} people</p>
            </div>
        </div>
    </div>
</div>

<h3>Personal Information</h3>
        
{!! Form::open(['action' => 'ReservationController@reserve', 'method' => 'POST', 'class' => 'confirm']) !!}

    {!! Form::hidden('date', $date, array('id' => 'date')) !!}

    {!! Form::hidden('time', $time, array('id' => 'time')) !!}

    {!! Form::hidden('capacity', $capacity, array('id' => 'capacity')) !!}

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('fname', null, array('placeholder' => 'First Name', 'class' => 'form-control reserve-input required', 'id' => 'fname')) !!}
                <span class="error" style="display: none; color: red;">*Required</span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('lname', null, array('placeholder' => 'Last Name', 'class' => 'form-control reserve-input required', 'id' => 'lname')) !!}
                <span class="error" style="display: none; color: red;">*Required</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::text('email', null, array('placeholder' => 'Email', 'class' => 'form-control reserve-input required', 'id' => 'email')) !!}
                <span class="error" style="display: none; color: red;">*Required</span>
                <span id="email-reg" style="display: none; color: red;"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::text('phone', null, array('placeholder' => 'Phone Number', 'class' => 'form-control reserve-input required', 'id' => 'phone')) !!}
                <span class="error" style="display: none; color: red;">*Required</span>
                <span id="phone-reg" style="display: none; color: red;"></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="res-confirm-btn">
                {!! Form::submit('Reserve', ['name' => 'reserve', 'id' => 'reserve-btn', 'class' => 'btn btn-primary SR']) !!}

            {!! Form::close() !!}
        </div>

        <div class="res-confirm-btn">
            {!! Form::open(['action' => 'ReservationController@back', 'method' => 'POST', 'class' => 'back']) !!}

                {!! Form::hidden('date', $date, array('id' => 'date')) !!}

                {!! Form::hidden('time', $time, array('id' => 'time')) !!}

                {!! Form::hidden('capacity', $capacity, array('id' => 'capacity')) !!}

                {!! Form::submit('Back to Step 1', ['name' => 'back', 'id' => 'back-btn', 'class' => 'btn btn-default']) !!}

            {!! Form::close() !!}
        </div>
    </div>

<!--<script>
    function validate(){
        var tracker = true; 
        
        var fname = document.getElementById('fname');
        var lname = document.getElementById('lname');
        var email = document.getElementById('email');
        var phone = document.getElementById('phone');
        if(fname.value === '' || fname.value === null){
            document.getElementById('fname-req').style.display = "block";
            tracker = false;
        }
        else{
            document.getElementById('fname-req').style.display = "none";
        }
        
        if(lname.value === '' || lname.value === null){            
            document.getElementById('lname-req').style.display = "block";
            tracker = false;
        }
        else{
            document.getElementById('lname-req').style.display = "none";
        }
        
        if(email.value === '' || email.value === null){
            document.getElementById('email-req').style.display = "block";
            tracker = false;
        }
        else{
            document.getElementById('email-req').style.display = "none";
        }
        
        if(phone.value === '' || phone.value === null){
            document.getElementById('phone-req').style.display = "block";
            tracker = false;
        }
        else{
            document.getElementById('phone-req').style.display = "none";
        }
        
        var emailPattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
        if(!emailPattern.test(email.value) && !(email.value === '' || email.value === null)){
            document.getElementById('email-reg').style.display = "block";
            tracker = false;
        }
        else{
            document.getElementById('email-reg').style.display = "none";
        }
        
        var phonePattern = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
        if(!phonePattern.test(phone.value) && !(phone.value === '' || phone.value === null)){
            document.getElementById('phone-reg').style.display = "block";
            tracker = false;
        }
        else{
            document.getElementById('phone-reg').style.display = "none";
        }
        
        if(tracker === false){
            tracker = true;
            return false;
        }
        else{
            return true;
        }
    }
</script>-->
{!! HTML::script('js/reservations.js') !!}