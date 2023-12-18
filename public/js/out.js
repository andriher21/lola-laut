var otable = $('#dataTable').dataTable({
    "bLengthChange" : false,
     "order": [[1, 'desc']]
});

$('#searchbox').keyup(function() {
    otable.fnFilter($(this).val());
});