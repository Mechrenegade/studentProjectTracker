$(document).ready(function () {

    // Build the chart
    Highcharts.chart('container', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        title: {
            text: 'Most Popular Projects downloaded for the Month'
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: false
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Projects',
            colorByPoint: true,
            data: [{
                name: 'Web Tech',
                y: 56.33
            }, {
                name: 'Programming II',
                y: 24.03,
                sliced: true,
                selected: true
            }, {
                name: 'Software Eng',
                y: 10.38
            }, {
                name: 'User Interface',
                y: 4.77
            }, {
                name: 'Intro to WWW',
                y: 0.91
            }, {
                name: 'Proprietary or Undetectable',
                y: 0.2
            }]
        }]
    });
});