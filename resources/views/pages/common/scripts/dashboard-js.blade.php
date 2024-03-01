<script>
    (function($) {
        'use strict';
        $(function() {

            if ($("#audience-chart").length) {
                var AudienceChartCanvas = $("#audience-chart").get(0).getContext("2d");
                var AudienceChart = new Chart(AudienceChartCanvas, {
                    type: 'bar',
                    data: {
                       
                        datasets: [
                            {
                                label: 'Total Redeemed',
                                data: {{52}},
                                backgroundColor: '#031d3f'
                            },
                            {
                                label: 'Airtime Disbursed',
                                data: {{100}},
                                backgroundColor: '#15a94f'
                            },
                            {
                                label: 'Donations Made (GHS)',
                                data: {{52}},
                                backgroundColor: '#d78e07'
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        layout: {
                            padding: {
                                left: 0,
                                right: 0,
                                top: 20,
                                bottom: 0
                            }
                        },
                        scales: {
                            yAxes: [{
                                display: true,
                                gridLines: {
                                    display: true,
                                    drawBorder: false,
                                    color: "#f8f8f8",
                                    zeroLineColor: "#f8f8f8"
                                },
                                ticks: {
                                    display: true,
                                    min: 0,
                                    max: 400,
                                    stepSize: 100,
                                    fontColor: "#b1b0b0",
                                    fontSize: 10,
                                    padding: 10
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                ticks: {
                                    beginAtZero: true,
                                    fontColor: "#b1b0b0",
                                    fontSize: 10
                                },
                                gridLines: {
                                    color: "rgba(0, 0, 0, 0)",
                                    display: false
                                },
                                barPercentage: .9,
                                categoryPercentage: .7,
                            }]
                        },
                        legend: {
                            display: false
                        },
                        elements: {
                            point: {
                                radius: 3,
                                backgroundColor: '#ff4c5b'
                            }
                        }
                    },
                });
            }
        });
    })(jQuery);
</script>
