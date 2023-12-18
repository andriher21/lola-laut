var otable = $('#dataTable').dataTable({
    "bLengthChange" : false,
});

$('#searchbox').keyup(function() {
    otable.fnFilter($(this).val());
});