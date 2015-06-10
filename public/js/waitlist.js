$(document).ready(function(){

  $.ajaxSetup({
    headers: {
        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    }
  });

  //line counter

  var rowCount = $('#waitListTable tr').length - 1;

  var classes = document.getElementsByClassName('counter');

  counter = 0;

  for (i = 0; i < rowCount; i++) {
    if(i === 0){
      classes[i].innerHTML = 'Next';
      counter++
    }else{
    classes[i].innerHTML = counter++;
    }
  }

  //add customer party to list

  $('form[add-party]').on('submit', function(e){
    var form = $(this);
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');

    var name = $('#name').val();
    var partynumber = $('#partynumber').val();
    var email = $('#email').val();
    var number = $('#number').val();

    if (name || partynumber || email || number ){

      $.ajax({
        type: method,
        url: url,
        data: form.serialize(),
        success: function(data){
            $('#waitListTable tr:last').after('<tr id="' + data[0].id + '">'+ '<td>' + counter++ + '</td>'
                                                    + '<td>' + data[0].name + '</td>'
                                                    + '<td>' + data[0].partynumber + '</td>'
                                                    + '<td>' + data[0].email + '</td>'
                                                    + '<td>' + data[0].number + '</td>'
                                                    + '<td>' + '<input type="button" value="+" onClick="seatCustomer(' + data[0].id + ')" />' + '</td>'
                                                    + '</tr>');
            alert(data[0].id);
          },
          error: function(e){
            alert(e.message);
          }
        });

    }else{
      alert('check fields');
    }

    e.preventDefault();
    
  });

});

//Seat Customer

function seatCustomer(id){

  $.post("wait/seat", {id: id}).done(function(data) {
      
    $('#waittime').html(data);
    $('#row_' + id).remove();

    alert(id);

    counter--;
      
  });

}