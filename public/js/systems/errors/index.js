var otable = $('#dataTable').dataTable({
    "bLengthChange" : false,
    "pageLength": 10,
    "order": [[2, 'desc']]
    
});

$('#searchbox').keyup(function() {
    otable.fnFilter($(this).val());
});