<div class="col-lg-12">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#insight_tab">INSIGHT</a></li>
        <li role="presentation"><a data-toggle="tab" href="#performance">Engineers' Performance</a></li>
   <!-- <li role="presentation"><a data-toggle="tab" href="#inventory_tab">Inventory</a></li>
        <li role="presentation"><a data-toggle="tab" href="#sales_trend_tab">Sales Trend</a></li>
        <li role="presentation"><a data-toggle="tab" href="#warranty_tab">Warranty & Service</a></li>
    -->
	</ul>
    <div class="panel panel-default">
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body tab-content">
                <div id="insight_tab" class="tab-pane fade in active">
                     <div class="row">
					    <div class="col-lg-6" id="insight_1"></div>
						<div class="col-lg-6" id="insight_2">
						
						</div>
					 </div>
                </div>
                <div id="performance" class="tab-pane fade" style="min-width: 1250px; height: 400px; margin: 0 auto">
                   
                </div>
                <div id="inventory_tab" class="tab-pane fade">
                    <h1>Coming Soon...</h1>
                </div>
                <div id="sales_trend_tab" class="tab-pane fade">
                    <h1>Coming Soon...</h1>
                </div>
                <div id="warranty_tab" class="tab-pane fade">
                    <h1>Coming Soon...</h1>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .mid_font{
        font-size: 20px;
    }
</style>

<script>

   $(function () {
        $('#insight_1').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Service Provided'
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
                name: 'Warranty Type',
                colorByPoint: true,
                data: [{
                    name: 'In Warranty',
                    y: 50
                }, {
                    name: 'Without Warranty',
                    y: 24,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Other',
                    y: 30
                }]
            }]
        });

   });
   
   
  $(function () {
	  
        $('#performance').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Engineer Wise Performance'
        },
        xAxis: {
            categories: ['Engineer 1', 'Engineer 2', 'Engineer 3', 'Engineer 4', 'Engineer 5'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'No. of Tickets',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' Quantity'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Current Year',
            data: [100,80, 85,80,60]
  }]
        });

   });
   
   
      $(function () {
        $('#insight_2').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Top 5 Product in Service'
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
                name: 'Ecopia',
                colorByPoint: true,
                data: [{
                    name: 'Potenza',
                    y: 50
                }, {
                    name: 'Turanza',
                    y: 20,
                    sliced: true,
                    selected: true
                }, {
                    name: 'Dueler',
                    y: 10
                }, {
                    name: 'Ecopia',
                    y: 10
                }, {
                    name: 'Turanza',
                    y: 10
                }]
            }]
        });

   });


</script>