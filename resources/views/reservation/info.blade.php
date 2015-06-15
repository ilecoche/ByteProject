<h2>Complete your reservation</h2>

 <div class="reserve-details">
    <div class="row">
        <div class="col-sm-4">
            <p>Date: {{ $date }}</p>
        </div>
        <div class="col-sm-4">
            <p>Time: {{ $time }}</p>
            <p>Time: {{ date("g:i a",strtotime($time)) }}</p>
        </div>
        <div class="col-sm-4">
            <p>Guests: {{ $capacity }} People</p>
        </div>
    </div>
</div> 
 @if($errors->any())
                                    <ul class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                        <li>
                                            {{ $error }}
                                        </li>
                                        @endforeach
                                    </ul>
                                    @endif

<!--{!! Form::open(['url' => 'reservation/reserve', 'class' => 'confirm']) !!}-->

{!! Form::open(['action' => 'ReservationController@reserve', 'method' => 'POST', 'class' => 'confirm']) !!}

    {!! Form::hidden('date', $date) !!}

    {!! Form::hidden('time', $time) !!}

    {!! Form::hidden('capacity', $capacity) !!}
   

    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('fname', null, array('placeholder' => 'First Name', 'class' => 'form-control reserve-input', 'id' => 'fname')) !!}
                <span id="fname-req" style="display: none; color: red;">*Required</span>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="form-group">
                {!! Form::text('lname', null, array('placeholder' => 'Last Name', 'class' => 'form-control reserve-input', 'id' => 'lname')) !!}
                <span id="lname-req" style="display: none; color: red;">*Required</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::text('email', null, array('placeholder' => 'Email', 'class' => 'form-control reserve-input', 'id' => 'email')) !!}
                <span id="email-req" style="display: none; color: red;">*Required</span>
                <span id="email-reg" style="display: none; color: red;">*Invalid</span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                {!! Form::text('phone', null, array('placeholder' => 'Phone Number', 'class' => 'form-control reserve-input', 'id' => 'phone')) !!}
                <span id="phone-req" style="display: none; color: red;">*Required</span>
                <span id="phone-reg" style="display: none; color: red;">*Invalid</span>
            </div>
        </div>
    </div>

    <div class="row">

        {!! Form::submit('Reserve') !!}

    </div>

    {!! Form::close() !!}

    <!--<ul>
        @foreach($list as $table)
        <li>Table: {{ $table->id }}, cap={{ $table->capacity }}</li>
        @endforeach
    </ul>-->

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