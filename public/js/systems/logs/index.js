
var startDate      = moment().startOf('month').format('YYYY-MM-DD');
var endDate 	   = moment().endOf('month').format('YYYY-MM-DD');
var dateRange = {};
var startdate;
var enddate;
var exp = siteUrl('systems/logs/exportCsv/');
// var start_date = '<?= $start_date ?>';
// var end_date = '<?= $end_date ?>';
var exportUrl = siteUrl('systems/logs/exportCsv/') + startDate + '/' + startDate;;

$('.scan-log-data').ready(function() {
    var otable = $('#dataTable').dataTable({
        "bLengthChange" : false,
        "pageLength": 10,
        "order": [[1, 'desc']]
    });
    
    $('#searchbox').keyup(function() {
        otable.fnFilter($(this).val());
    });    
    
    $('.data-daterangepicker').daterangepicker({
        ranges: {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        },
        startDate: moment().startOf('month'),
        endDate  : moment().endOf('month'),
    }, function (start, end, label) {
        var labels = $('.data-daterangepicker').html('&nbsp; <i class="fas fa-calendar-alt mr-2"></i> '+label+ '&nbsp;');
        startdate = start.format("YYYY-MM-DD");
        enddate = end.format("YYYY-MM-DD");
    
        // console.log('Start :' + startdate);
        // console.log('End :' + enddate);
    });
    
    $('.data-daterangepicker').on('apply.daterangepicker', function(ev, picker) {
        startdate = picker.startDate.format('YYYY-MM-DD');
        enddate = picker.endDate.format('YYYY-MM-DD');
        
        $.fn.dataTableExt.afnFiltering.push(
            function( oSettings, aData, iDataIndex ) {
                if(startdate!=undefined){
                    
                    var coldate = aData[1];
                    var date;
                    date = coldate;
    
                    dateMin = startdate;
                    dateMax = enddate;
    
                    if ( dateMin == "" && date <= dateMax){
                        return true;
                    }
                    else if ( dateMin =="" && date <= dateMax ){
                        return true;
                    }
                    else if ( dateMin <= date && "" == dateMax ){
                        return true;
                    }
                    else if ( dateMin <= date && date <= dateMax ){
                        return true;
                    }
                    
                    return false;
                }
            }
        );
        otable.fnDraw();
    
        console.log('Start :' + startdate);
        console.log('End :' + enddate);
        
        var exp = siteUrl('systems/logs/exportCsv/') + startdate + '/' + enddate;
        
        exportUrl = exp;
        
        // sumPrint = summary + '/' + startdate + '/' + enddate;
        // summaryUrl = sumPrint;
    });
    
    
    $(".btn-export").click(function() {
        // var exportUrl = exp + '/' + start_date + '/' + end_date;
        // console.log(exportUrl)
        
        
        console.log(exportUrl);
        setTimeout(function() {
            $('#print-employee-report').attr('src', exportUrl);
        }, 50);
    }); 

});


