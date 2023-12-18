// var origin = window.location.origin;
// var base = "user-management";
// var url = origin + '/' + base;
var pageUrl = siteUrl('attendance/employee/exportCsv')
console.log(pageUrl);
var time = ['1s', '2s', '3s', '4s', '5s', '6s','7s','8s','9s','10s','11s','12s','13s','14s','15s'];
var data = [0, 0, 0, 0, 20, 55, 70, 80, 90, 84, 50, 10, 0 , 0, 0];
const ctx = document.getElementById('myChart');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: time,
        datasets: [{
            label: '# of Votes',
            data: data,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Stress-Strain(LS D13-3)',
                padding: {
                    top: 10,
                    bottom: 30
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }}
});
