<div class="col-lg-12">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#insight_tab">INSIGHT</a></li>
        <li role="presentation"><a data-toggle="tab" href="#performance">Sales Persons' Performance</a></li>
       <!-- <li role="presentation"><a data-toggle="tab" href="#inventory_tab">Inventory</a></li>
        <li role="presentation"><a data-toggle="tab" href="#sales_trend_tab">Sales Trend</a></li>
        <li role="presentation"><a data-toggle="tab" href="#warranty_tab">Warranty & Service</a></li>
      -->   
   </ul>
    <div class="panel panel-default">
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body tab-content">
                <div id="insight_tab" class="tab-pane fade in active">
                </div>
                <div id="performance" class="tab-pane fade">
                    <div class="row">
					   <div class="col-lg-6" id="performance_1">
					   </div>
					   <div class="col-lg-5 col-lg-offset-1" id="performance_2">
					   </div>
					   
					</div>
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

$('#insight_tab').highcharts({
        title: {
            text: 'Actual vs Plan Sales',
            x: -20 //center
        },

        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Sales (BDT)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: 'BDT'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Sales Plan',
            data: [5000,4500,5500,4500,6000, 5000,4500,5500,4500,6000]
        }, {
            name: 'Actual Sales',
            data: [4800, 4500, 5000,5000, 5500, 6000,7500,8500,9500,10000]
        }]
    });	
	
	
	//2nd tab
	
	 $(function () {
	  
        $('#performance_1').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Salesman Wise Performance by Order Quantity'
        },
        xAxis: {
            categories: ['Salesman 1', 'Salesman 2', 'Salesman 3', 'Salesman 4', 'Salesman 5'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'No. of Order',
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
		
		
  $('#performance_2').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Salesman Wise Performance by Order Value'
        },
        xAxis: {
            categories: ['Salesman 1', 'Salesman 2', 'Salesman 3', 'Salesman 4', 'Salesman 5'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Order Value',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: 'BDT'
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
            data: [100000,8000000, 850000,80070000,6000000]
  }]
        });

   });

</script>