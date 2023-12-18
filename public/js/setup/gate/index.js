var url = 'http://localhost/user-management';
var deleteUrl = siteUrl('setup/gate/deleteGate');
var id = "";
var otable = $('#dataTable').dataTable({
    "bLengthChange" : false,
    "columnDefs": [
        { 
            "targets": [ -6],
            "orderable": false,
            "ordering": false
        }
    ],
    "order": [[2, 'asc']]
});
var all = otable.fnGetNodes();

$('table').on('change', '.check-all', function(event) {
    var $checked = $(this).is(':checked');
    if ($checked) {
        $('.check-data', all).prop('checked', true);
        
    } else {
        $('.check-data', all).prop('checked', false);
    }
});

$('.gate-data').on('change', '.check', function() {
    if ($('.check-data:checked').length > 0 && $('.btn-delete-selected').length <= 0) {
        $('.group-action-area').prepend('<button type="button" class="btn btn-sm btn-danger btn-delete-selected"><i class="fa fa-trash m-r-5"></i>&nbsp;Delete</button>');
    } else if ($('.check-data:checked').length <= 0) {
        $('.btn-delete-selected').remove();
    }
});

$('.gate-data').on('click', '.btn-delete-selected', function(){
    var idToDelete   = [];
    var nameToDelete = '<b>Are you sure to delete this data?</b><ol class="m-t-8 p-l-20">';
    var no = 1;
    $.each($('.check-data:checked'), function(index, item) {
        var item = $(item);
        if(item.val() != ''){
            idToDelete.push(item.val());
            nameToDelete += '<li>'+item.data('name')+'</li>';
        }

    });
    nameToDelete += '</ol>';
    confirmation(nameToDelete, 'doDelete("'+deleteUrl+'")');
});

function doDelete(url){
    var idToDelete = [];
    $.each($('.check-data:checked'), function(index, item) {
		var item = $(item);
		if(item.val() != ''){
			idToDelete.push(item.val());
		}
	});
	$.ajax({
		url: url,
		type: 'post',
		dataType: 'json',
		data: {id: idToDelete},
		async:false,
        success: function(){
            location.reload(true);
        }
	})
	
	$('#modal-confirmation').modal('hide');
}