<div class="col-lg-12">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#insight_tab">INSIGHT</a></li>
     <!--   <li role="presentation"><a data-toggle="tab" href="#purchase_trend_tab">Purchase Trend</a></li>
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
				     <div class="col-lg-12" id="insight_1" style="min-width: 310px; height: 265px; margin: 0 auto"></div>
					 <div class="col-lg-12" id="insight_2" style="min-width: 310px; height: 245px; margin: 0 auto"></div>
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

$(function () {
    $('#insight_1').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Purchase Details-2016(Quantity)'
        },
        xAxis: {
            categories: [
                'Ecopia',
                'Potenza',
                'Turanza',
                'Dueler',
                'Ecopia'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Quanity'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Purchase',
            data: [455,500,300,1000]

        }, {
            name: 'Inventory',
            data: [600,670,460,1500]

        }]
    });
	
	
	    $('#insight_2').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Purchase Details-2016(Value)'
        },
        xAxis: {
            categories: [
                'Ecopia',
                'Potenza',
                'Turanza',
                'Dueler',
                'Ecopia'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Value'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Purchase',
            data: [10000,70000,130000,30000]

        }, {
            name: 'Inventory',
            data: [20000,78000,230000,45000]

        }]
    });
});

</script>


