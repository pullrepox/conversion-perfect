'use strict';

require('chart.js/dist/Chart.min.js');
require('../../common/js/vendor/chart.js/dist/Chart.extension.js');
//
// Charts
//
'use strict';
window.Charts = (function () {
    
    // Variable
    let $toggle = $('[data-toggle="chart"]');
    let mode = 'light';//(themeMode) ? themeMode : 'light';
    let fonts = {
        base: 'Open Sans'
    };
    
    // Colors
    let colors = {
        gray: {
            100: '#f6f9fc',
            200: '#e9ecef',
            300: '#dee2e6',
            400: '#ced4da',
            500: '#adb5bd',
            600: '#8898aa',
            700: '#525f7f',
            800: '#32325d',
            900: '#212529'
        },
        theme: {
            'default': '#172b4d',
            'primary': '#5e72e4',
            'secondary': '#f4f5f7',
            'info': '#11cdef',
            'success': '#2dce89',
            'danger': '#f5365c',
            'warning': '#fb6340'
        },
        black: '#12263F',
        white: '#FFFFFF',
        transparent: 'transparent',
    };
    
    
    // Methods
    
    // Chart.js global options
    function chartOptions() {
        
        // Options
        let options = {
            defaults: {
                global: {
                    responsive: true,
                    maintainAspectRatio: false,
                    defaultColor: (mode === 'dark') ? colors.gray[700] : colors.gray[600],
                    defaultFontColor: (mode === 'dark') ? colors.gray[700] : colors.gray[600],
                    defaultFontFamily: fonts.base,
                    defaultFontSize: 13,
                    layout: {
                        padding: 0
                    },
                    legend: {
                        display: false,
                        position: 'bottom',
                        labels: {
                            usePointStyle: true,
                            padding: 16
                        }
                    },
                    elements: {
                        point: {
                            radius: 0,
                            backgroundColor: colors.theme['primary']
                        },
                        line: {
                            tension: .4,
                            borderWidth: 4,
                            borderColor: colors.theme['primary'],
                            backgroundColor: colors.transparent,
                            borderCapStyle: 'rounded'
                        },
                        rectangle: {
                            backgroundColor: colors.theme['warning']
                        },
                        arc: {
                            backgroundColor: colors.theme['primary'],
                            borderColor: (mode === 'dark') ? colors.gray[800] : colors.white,
                            borderWidth: 4
                        }
                    },
                    tooltips: {
                        enabled: true,
                        mode: 'index',
                        intersect: false,
                    }
                },
                doughnut: {
                    cutoutPercentage: 83,
                    legendCallback: function (chart) {
                        let data = chart.data;
                        let content = '';
                        
                        data.labels.forEach(function (label, index) {
                            let bgColor = data.datasets[0].backgroundColor[index];
                            
                            content += '<span class="chart-legend-item">';
                            content += '<i class="chart-legend-indicator" style="background-color: ' + bgColor + '"></i>';
                            content += label;
                            content += '</span>';
                        });
                        
                        return content;
                    }
                }
            }
        };
        
        // yAxes
        Chart.scaleService.updateScaleDefaults('linear', {
            gridLines: {
                borderDash: [2],
                borderDashOffset: [2],
                color: (mode === 'dark') ? colors.gray[900] : colors.gray[300],
                drawBorder: false,
                drawTicks: false,
                drawOnChartArea: true,
                zeroLineWidth: 0,
                zeroLineColor: 'rgba(0,0,0,0)',
                zeroLineBorderDash: [2],
                zeroLineBorderDashOffset: [2]
            },
            ticks: {
                beginAtZero: true,
                padding: 10,
                callback: function (value) {
                    if (!(value % 10)) {
                        return value
                    }
                }
            }
        });
        
        // xAxes
        Chart.scaleService.updateScaleDefaults('category', {
            gridLines: {
                drawBorder: false,
                drawOnChartArea: false,
                drawTicks: false
            },
            ticks: {
                padding: 20
            },
            maxBarThickness: 10
        });
        
        return options;
        
    }
    
    // Parse global options
    function parseOptions(parent, options) {
        for (let item in options) {
            if (typeof options[item] !== 'object') {
                parent[item] = options[item];
            } else {
                parseOptions(parent[item], options[item]);
            }
        }
    }
    
    // Push options
    function pushOptions(parent, options) {
        for (let item in options) {
            if (Array.isArray(options[item])) {
                options[item].forEach(function (data) {
                    parent[item].push(data);
                });
            } else {
                pushOptions(parent[item], options[item]);
            }
        }
    }
    
    // Pop options
    function popOptions(parent, options) {
        for (let item in options) {
            if (Array.isArray(options[item])) {
                options[item].forEach(function (data) {
                    parent[item].pop();
                });
            } else {
                popOptions(parent[item], options[item]);
            }
        }
    }
    
    // Toggle options
    function toggleOptions(elem) {
        let options = elem.data('add');
        let $target = $(elem.data('target'));
        let $chart = $target.data('chart');
        
        if (elem.is(':checked')) {
            
            // Add options
            pushOptions($chart, options);
            
            // Update chart
            $chart.update();
        } else {
            
            // Remove options
            popOptions($chart, options);
            
            // Update chart
            $chart.update();
        }
    }
    
    // Update options
    function updateOptions(elem) {
        let options = elem.data('update');
        let $target = $(elem.data('target'));
        let $chart = $target.data('chart');
        
        // Parse options
        parseOptions($chart, options);
        
        // Toggle ticks
        toggleTicks(elem, $chart);
        
        // Update chart
        $chart.update();
    }
    
    // Toggle ticks
    function toggleTicks(elem, $chart) {
        
        if (elem.data('prefix') !== undefined || elem.data('prefix') !== undefined) {
            let prefix = elem.data('prefix') ? elem.data('prefix') : '';
            let suffix = elem.data('suffix') ? elem.data('suffix') : '';
            
            // Update ticks
            $chart.options.scales.yAxes[0].ticks.callback = function (value) {
                if (!(value % 10)) {
                    return prefix + value + suffix;
                }
            };
            
            // Update tooltips
            $chart.options.tooltips.callbacks.label = function (item, data) {
                let label = data.datasets[item.datasetIndex].label || '';
                let yLabel = item.yLabel;
                let content = '';
                
                if (label !== '') {
                    // content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                    content += label + ': ';
                }
                
                content += prefix + yLabel + suffix;
                
                return content;
            }
        }
    }
    
    
    // Events
    
    // Parse global options
    if (window.Chart) {
        parseOptions(Chart, chartOptions());
    }
    
    // Toggle options
    $toggle.on({
        'change': function () {
            let $this = $(this);
            
            if ($this.is('[data-add]')) {
                toggleOptions($this);
            }
        },
        'click': function () {
            let $this = $(this);
            
            if ($this.is('[data-update]')) {
                updateOptions($this);
            }
        }
    });
    
    
    // Return
    
    return {
        colors: colors,
        fonts: fonts,
        mode: mode
    };
    
})();

let SalesChart = (function() {
    
    // Variables
    
    let $chart = $('#chart-sales-dark');
    
    
    // Methods
    
    function init($this) {
        let salesChart = new Chart($this, {
            type: 'line',
            options: {
                scales: {
                    yAxes: [{
                        gridLines: {
                            color: Charts.colors.gray[700],
                            zeroLineColor: Charts.colors.gray[700]
                        },
                        ticks: {
                        
                        }
                    }]
                }
            },
            data: {
                labels: ['May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                datasets: [{
                    label: 'Performance',
                    data: [0, 20, 15, 23, 28, 36, 25, 50, 50]
                }]
            }
        });
        
        // Save to jQuery object
        
        $this.data('chart', salesChart);
        
    }
    
    
    // Events
    
    if ($chart.length) {
        init($chart);
    }
    
})();
