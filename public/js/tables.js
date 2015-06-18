$.ajaxSetup({
  headers: {
    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
  }
});

// ---- Add table ---- //

$('#add_table').on('submit', function(e) {

	e.preventDefault();

	var form = $(this);
    var method = form.find('input[name="_method"]').val() || 'POST';
    var url = form.prop('action');

	var capacity = $('#capacity').val();
	var tableNum = $('#table_num').val();

	if(capacity || tableNum){

	   $.ajax({
            type: method,
            url: url,
            data: form.serialize(),
            success: function(data){
        
                $('#all_tables tr:last').after('<tr id="' + data.id[0].id + '"><td>' + data.table_num + '</td><td>' + data.capacity + '</td><td><button type="submit" onClick="deleteRow(' + data.id[0].id + ')"><span class="glyphicon glyphicon-remove"></span></button</td></tr>');
                
                $('#capacity').val('');
                $('#table_num').val('');
            }
        });     
	}
	else
	{
		alert("Check your fields");
	}
});

// ---- Delete table ---- //

function deleteRow(id)
{
    //$('$delete_table')
    $.post('tables/delete', {
        id: id
    }).done(
        function(data){

            $('#' + id).remove();
        });
}
