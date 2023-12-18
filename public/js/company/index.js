var table;
var users;
var readCSV = '/readCSVcompany';
var deleteUrl = '/deletecompany';
var importURL = '/doImportcompany';
var sync= '/synccompany';
var otable = $('#dataTable').dataTable({
    "bLengthChange" : false,
    "columnDefs": [
        { 
            "targets": [ -4 ],
            "orderable": false,
            "ordering": false
        }
    ],
    "order": [[2]]
});

$('#searchbox').keyup(function() {
otable.fnFilter($(this).val());
});

$('.customer-data').on('click', '.btn-import', function() {
    $('#import').trigger('click');
});
$('.customer-data').on('change', '#import', function() {
    if ($('#import').val() !== '')
        $('form[name="form-import"]').trigger('submit');
});
$('.customer-data').on('submit', 'form[name="form-import"]', function(e) {

    e.preventDefault();
    var fd = new FormData(this);
    // var $this = $("#import")[0].files[0];
    //  var $this = this;
    $.ajax({
        url: base_url+readCSV,
        type: "post",
        // data: {file: $("#file").val()},
        data: fd,
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            $('#import').val('');
            console.log(data);
            drawImportTable(data);
            $('#importModal').modal('show');
            users = data;
        }
    });
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

$('.customer-data').on('change', '.chkboxes', function() {
    if ($('.chkboxes:checked').length > 0 && $('.btn-delete-selected').length <= 0) {
        $('.group-action-area').prepend('<button type="button" class="btn btn-sm btn-danger btn-delete-selected"><i class="fa fa-trash m-r-5"></i> &nbsp;Delete</button>');
    } else if ($('.chkboxes:checked').length <= 0) {
        $('.btn-delete-selected').remove();
    }
});

$('.customer-data').on('click', '.btn-delete-selected', function(){
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

$('.customer-data').on('change', '.toggle-status', function(){
    var toggle = $(this);
    var field = $(this).attr('name');
    setTimeout(function(){
        $.ajax({
            url: setStatus,
            type: 'post',
            dataType: 'json',
            data: {
                id: toggle.attr('data-id'),
                check: toggle.is(':checked') ? 1 : 0,
                field: field
            },
            async:false
        }).done(function(check) {
            toggle.prop('checked', true);
            if(check){
                toggle.prop('checked',true);
            
            }else{
                toggle.prop('checked',false);
            }
        });
    }, 50)
})
$('.customer-data').on('click', '.btn-sync', function(){
    $.ajax({
        type: 'POST',
        url: base_url+sync,
        success: function(data) {
            location.reload(true);
        }, error: function(response){
            console.log(response.responseText);
        }
    });
});
function drawImportTable(data) {
    var html = '';
    data = JSON.parse(data);
    var count = 0;
    // console.log(data);
    $.each(data, function(i, v) {
        
        html += '<tr>';
        html += `<td class="text-center"><div class="custom-control custom-checkbox table-checkbox">
                <input type="checkbox" class="custom-control-input check-import" id="table-chk-${i}" value="${i}" data-name="${v.name}" checked="true">
                <label class="custom-control-label" for="table-chk-${i}">&nbsp;</label>
            </div></td>`;
        // html += '<td>'+ ++count +' </td>'
        html += '<td id="no">' + v.no + '</td>';
        html += '<td id="name">' + v.name + '</td>';
        html += '<td id="address">' + v.address + '</td>';
        html += '<td id="npwp">' + v.npwp + '</td>';
        html += '</tr>';
    });
    if (html !== '') {
        $('.body-import-result').html(html);
    } else {
        $('.body-import-result').html('<tr><td colspan="6">Data not found.</td></tr>');
    }
}



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
    window.location.reload();
    $('#modal-confirmation').modal('hide');
}
function doImport() {

    var new_u = JSON.parse(users);
    // console.log(new_u);
    var data = [];
    var no = [];
    var name = [];
    var address = [];
    var npwp = [];

    $('.check-import:checked').each(function(i, dom) {
        index = $(dom).val();
        // console.log(index);
        no = new_u[index]['no'];
        name = new_u[index]['name'];
        address = new_u[index]['address'];
        npwp = new_u[index]['npwp'];
       

        // console.log(departement)
        data.push({
            no:no,
            name: name,
            address: address,
            npwp:npwp
        });
    });
    console.log(data);
    
    $.ajax({
        url: base_url+importURL,
        type: 'POST',
        ContentType: 'application/json',
        dataType: 'JSON',
        data: {
            data: data
        },
        success: function(data) {
        
        }
    })
    location.reload(true);
    
}
