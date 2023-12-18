var table;
var users;

var readCSV = siteUrl('users/employee/readCSV');
var importURL = siteUrl('users/employee/doImport');
var deleteUrl = siteUrl('users/employee/delete');
var setStatus = siteUrl('users/employee/setStatus');

var otable = $('#dataTable').dataTable({
    "bLengthChange" : false,
    "columnDefs": [
        { 
            "targets": [ -6 ],
            "orderable": false,
            "ordering": false
        }
    ],
    "order": [[2]]
});

$('#searchbox').keyup(function() {
otable.fnFilter($(this).val());
});

$('.employee-data').on('click', '.btn-import', function() {
    $('#import').trigger('click');
});
$('.employee-data').on('change', '#import', function() {
    if ($('#import').val() !== '')
        $('form[name="form-import"]').trigger('submit');
});
$('.employee-data').on('submit', 'form[name="form-import"]', function(e) {

    e.preventDefault();
    // var formData = new FormData();
    var $this = this;
    $.ajax({
        url: readCSV,
        type: "post",
        // data: formData,
        data: new FormData($this),
        processData: false,
        contentType: false,
        cache: false,
        async: false,
        success: function(data) {
            $('#import').val('');
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

$('.employee-data').on('change', '.chkboxes', function() {
    if ($('.chkboxes:checked').length > 0 && $('.btn-delete-selected').length <= 0) {
        $('.group-action-area').prepend('<button type="button" class="btn btn-sm btn-danger btn-delete-selected"><i class="fa fa-trash m-r-5"></i> &nbsp;Delete</button>');
    } else if ($('.chkboxes:checked').length <= 0) {
        $('.btn-delete-selected').remove();
    }
});

$('.employee-data').on('click', '.btn-delete-selected', function(){
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

$('.employee-data').on('change', '.toggle-status', function(){
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

function drawImportTable(data) {
    var html = '';
    data = JSON.parse(data);
    var count = 0;
    $.each(data, function(i, v) {
        html += '<tr>';
        html += `<td class="text-center"><div class="custom-control custom-checkbox table-checkbox">
                <input type="checkbox" class="custom-control-input check-import" id="table-chk-${i}" value="${i}" data-name="${v.nama}" checked="true">
                <label class="custom-control-label" for="table-chk-${i}">&nbsp;</label>
            </div></td>`;
        // html += '<td>'+ ++count +' </td>'
        html += '<td id="nik">' + v.nik + '</td>';
        html += '<td id="nama">' + v.nama + '</td>';
        html += '<td id="tanggal">' + v.departement + '</td>';
        html += '</tr>';
    });
    if (html !== '') {
        $('.body-import-result').html(html);
    } else {
        $('.body-import-result').html('<tr><td colspan="6">Data not found.</td></tr>');
    }
}

function doImport() {

    var new_u = JSON.parse(users);
    // console.log(new_u);
    var data = [];
    var nik = [];
    var nama = [];
    var departement = [];

    $('.check-import:checked').each(function(i, dom) {
        index = $(dom).val();
        // console.log(index);
        nik = new_u[index]['nik'];
        nama = new_u[index]['nama'];
        // departement = new_u[index]['departement'];
        if(new_u[index]['departement'] == 'Produksi Minyak'){
            departement = new_u[index]['departement'] = '1';
        }
        else if(new_u[index]['departement'] == 'Teknik'){
            departement = new_u[index]['departement'] = '2';
        }
        else if(new_u[index]['departement'] == 'Quality Control'){
            departement = new_u[index]['departement'] = '3';

        }
        else if(new_u[index]['departement'] == 'Manufacturing'){
            departement = new_u[index]['departement'] = '4';

        }
        else if(new_u[index]['departement'] == 'Human Resources'){
            departement = new_u[index]['departement'] = '5';

        }
        else if(new_u[index]['departement'] == 'IT'){
            departement = new_u[index]['departement'] = '6';
            
        }
        else if(new_u[index]['departement'] == 'PPIC'){
            departement = new_u[index]['departement'] = '7';
        }
        else if(new_u[index]['departement'] == 'Produksi Bumbu'){
            departement = new_u[index]['departement'] = '8';
        }

        // console.log(departement)
        data.push({
            nik: nik,
            nama: nama,
            departement: departement,
        });
    });
    console.log(data);
    
    $.ajax({
        url: importURL,
        type: 'POST',
        ContentType: 'application/json',
        dataType: 'JSON',
        data: {
            data: data
        },
        success: function(data) {
            if (data.success == true) {
                location.reload(true);
            }
        }
    })
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