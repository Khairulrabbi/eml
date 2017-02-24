<div class="col-lg-12">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#insight_tab">INSIGHT</a></li>
       <!-- <li role="presentation"><a data-toggle="tab" href="#purchase_trend_tab">Purchase Trend</a></li>
        <li role="presentation"><a data-toggle="tab" href="#inventory_tab">Inventory</a></li>
        <li role="presentation"><a data-toggle="tab" href="#sales_trend_tab">Sales Trend</a></li>
        <li role="presentation"><a data-toggle="tab" href="#warranty_tab">Warranty & Service</a></li>
    -->
	</ul>
    <div class="panel panel-default">
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body tab-content">
                <div id="insight_tab" class="tab-pane fade in active">
				  <div class="row">
				     <div class="col-lg-6" id="insight-1"></div>
					 <div class="col-lg-6" id="insight-2"></div>
				  </div>
                </div>
                <div id="purchase_trend_tab" class="tab-pane fade">
                    <h1>Coming Soon...</h1>
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
    $(document).ready(function () {

        // Build the chart
  $('#insight-1').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Product Wise Available Stock(Quanity)'
        },
        xAxis: {
            categories: ['Ecopia', 'Potenza', 'Turanza', 'Dueler', 'Ecopia'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Quanity',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' piece'
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
            data: [700,600, 650,45,3000]
        }]
    });
	
	
	  $('#insight-2').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Product Wise Available Stock(Value)'
        },
        xAxis: {
            categories: ['Ecopia', 'Potenza', 'Turanza', 'Dueler', 'Ecopia'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'BDT',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' piece'
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
            data: [3500000,8000, 1300000,45000000,30000]
        }]
    });
	
});
</script>

