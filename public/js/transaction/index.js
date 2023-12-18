
var url = 'http://localhost/user-management'

// var current = 'transaction/detail/' + activeDate;
var report = '/printReport/' + activeDate;
var exp = '/exportCsv/' + activeDate;
var id;
var deleteUrl = '/deletetransaksi';

// var otable = $('#dataTable').dataTable({
//     retrieve: true,
//     "bLengthChange" : false,
//     "columnDefs": [
//         { 
//             "targets": [ -13 ],
//             "orderable": false,
//             "ordering": false
//         }
//     ],
//     "order": [[2]]
// });
$('.employee-attendance-data').ready(function() {
    
    var otable = $('#dataTable').dataTable({
        "bLengthChange" : false,
        // "paging": false
    });
    
    $('#searchbox').keyup(function() {
    otable.fnFilter($(this).val());
    });
    
    $('.shift-filter').change(function(){
        otable.fnFilter($(this).val(), -3);
        id = $('#shift_filter').val();
        if (id == ''){
            id = 'undefined';
        }
        console.log(id);
    })

    $(".current").attr('href', function(_, oldHref) {
        return current + '/' + oldHref;
    });

    $(".btn-print-report").click(function() {
        var reportUrl = report ;
        setTimeout(function() {
            $('#print-employee-report').attr('src', base_url+reportUrl);
        }, 100);
    });

    $(".btn-export").click(function() {
        var exportUrl = exp ;
        console.log(exportUrl);
        setTimeout(function() {
            $('#print-employee-report').attr('src', base_url+exportUrl);
        }, 50);
    }); 

    $('.data-datepicker').datepicker().on('changeDate', function(e){
        var d = e.date;
        var day = d.getDate();
        var month = d.getMonth() + 1;
        var year = d.getFullYear();
        if (day < 10) {
            day = "0" + day;
        }
        if (month < 10) {
            month = "0" + month;
        }
        var date = year + "-" + month + "-" + day;

        $(this).datepicker('hide');
        window.location.replace(date);
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
   
});


$('.employee-attendance-data').on('change', '.chkboxes', function() {
    if ($('.chkboxes:checked').length > 0 && $('.btn-delete-selected').length <= 0) {
        $('.group-action-area').prepend('<button type="button" class="btn btn-sm btn-danger btn-delete-selected"><i class="fa fa-trash m-r-5"></i> &nbsp;Delete</button>');
    } else if ($('.chkboxes:checked').length <= 0) {
        $('.btn-delete-selected').remove();
    }
});

$('.employee-attendance-data').on('click', '.btn-delete-selected', function(){
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
        url: base_url+url,
        type: 'post',
        dataType: 'json',
        data: {id: idToDelete},
        async:false,
        success: function(){
            
        }
    })
    location.reload(true);
    $('#modal-confirmation').modal('hide');
}
