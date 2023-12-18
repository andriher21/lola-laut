
var reportDetail = siteUrl('attendance/employee/printDetail/') + activeDate + '/' + id;
console.log(reportDetail);

$('.employee-attendance-data-detail').ready(function() {
    $(".btn-print-detail").click(function() {
        setTimeout(function() {
            $('#print-detail-report').attr('src', reportDetail);
        }, 50);
    });
});