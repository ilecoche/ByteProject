//necessary for AJAX call

$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  }
});

//global counter variable

var counter;

  //line counter

  numberCount();

  function numberCount(){

    var rowCount = $('#waitListTable tr').length - 1;

    var classes = document.getElementsByClassName('counter');

    counter = 0;

    for (i = 0; i < rowCount; i++) {
      if(i === 0){
        classes[i].innerHTML = 'Next';
        counter++;
      }else{
        classes[i].innerHTML = counter++;
      }
    }
  }

  //validation functions for valid expressions

  function validateEmail(email) {
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
  }

  function validateParty(partynumber) {
    var re = /^[0-9]{1,2}$/;
    return re.test(partynumber);
  }

  function validateName(name) {
    var re = /^[a-zA-Z ]{2,30}$/;
    return re.test(name);
  }

  function validatePhone(phonenumber) {
    var re = /^[(]{0,1}[0-9]{3}[)]{0,1}[-\s\.]{0,1}[0-9]{3}[-\s\.]{0,1}[0-9]{4}$/;
    return re.test(phonenumber);
  }

//add customer party to list

$('form[add-party]').on('submit', function(e){

  //get form input information

  var form = $(this);
  var method = form.find('input[name="_method"]').val() || 'POST';
  var url = form.prop('action');

  var name = $('#name').val();
  var partynumber = $('#partynumber').val();
  var email = $('#email').val();
  var number = $('#number').val();

  //check regular expressions

  var nameVal = validateName(name);
  var partyVal = validateParty(partynumber);
  var emailVal = validateEmail(email);
  var phoneVal = validatePhone(number);

  //do AJAX call or deal with errors

  if (nameVal === true && partyVal === true && emailVal === true && phoneVal === true){

    //clear any present errors

    $('#nameerror').html('');
    $('#partyerror').html('');
    $('#emailerror').html('');
    $('#phoneerror').html('');
    $('#error').html('');

    //show load animation

    $('.loader').show();

    $.ajax({
      type: method,
      url: url,
      data: form.serialize(),
      success: function(data){
        $('#waitListTable tr:last').after('<tr id="row_' + data.data[0].id + '">'+ '<td class="counter">' + counter + '</td>'
          + '<td>' + data.data[0].name + '</td>'
          + '<td>' + data.data[0].partynumber + '</td>'
          + '<td>' + data.data[0].email + '</td>'
          + '<td>' + data.data[0].number + '</td>'
          + '<td>' + '<input type="button" value="+" onClick="seatCustomer(' + data.data[0].id + ')" class="btn SR"/>' + '</td>'
          + '</tr>');

        //display new average, hide animation, change counter value

        $('#waittime').html(data.average);
        $('.loader').hide();
        numberCount();
      },
      error: function(e){
        alert(e.message);
      }
    });

  }else{

    //check expressions

    if(nameVal !== true){
      $('#nameerror').html('Invalid name');
    }else{
      $('#nameerror').html('');
    }

    if(partyVal !== true){
      $('#partyerror').html('Invalid number');
    }else{
      $('#partyerror').html('');
    }

    if(emailVal !== true){
      $('#emailerror').html('Invalid email');
    }else{
      $('#emailerror').html('');
    }

    if(phoneVal !== true){
      $('#phoneerror').html('Invalid phone number');
    }else{
      $('#phoneerror').html('');
    }

    //static message

    $('#error').html('Please Fill In Fields Properly');

  }

  e.preventDefault();
  
});

//Seat Customer

function seatCustomer(id){

  //show load animation

  $('.loader').show();

  $.post("wait/seat", {id: id}).done(function(data) {

    //change average, remove selected row, hide load animation, change counter value
    
    $('#waittime').html(data);
    $('#row_' + id).remove();
    $('.loader').hide();

    numberCount();
    
  });
}