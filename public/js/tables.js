$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  }
});

// ---- Add table ---- //

$('form.add_table').validate({

    // Validation rules
    rules: {
        table_num: {
            required: true,
            number: true
        },
        capacity: {
            required: true,
            number: true
        }
    },
    
    // Validation error messages
    messages: {
        table_num: {
            required: "Please enter the table number",
            number: "Please enter a number"
        },
        capacity: {
            required: "Please enter the table capacity",
            number: "Please select a table capacity"
        }
    },

    submitHandler: function(form) {

        var method = $(form).find('input[name="_method"]').val() || 'POST';
        var url = $(form).prop('action');

	    $.ajax({
            type: method,
            url: url,
            data: $(form).serialize(),
            success: function(data){
        
                $('#all_tables tr:last').after('<tr id="' + data.id[0].id + '"><td>' + data.table_num + '</td><td>' + data.capacity + '</td><td class="delete-table"><button type="submit" onClick="deleteRow(' + data.id[0].id + ')" class="btn btn-default"><span class="glyphicon glyphicon-remove"></span></button</td></tr>');
              
                $('#table_num').val('');
                $('#capacity').val('');
            },
            error: function(e){
                alert(e.message);
            }
        });     
    	
    }
});

// ---- Delete table ---- //

function deleteRow(id)
{

    $.post('tables/delete', {id: id}).done(
        function(data){
            $('#' + id).remove();
        });
}

function cancelReservation(id)
{
    $.post('tables/cancel', {id: id}).done(
        function(data){
            $('#' + id).remove();
        });
}