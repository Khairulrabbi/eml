<div class="col-lg-12">
    <ul class="nav nav-tabs">
        <li role="presentation" class="active"><a data-toggle="tab" href="#insight_tab">INSIGHT</a></li>
        <li role="presentation"><a data-toggle="tab" href="#purchase_trend_tab">Purchase Trend</a></li>
        <li role="presentation"><a data-toggle="tab" href="#inventory_tab">Inventory</a></li>
        <li role="presentation"><a data-toggle="tab" href="#sales_trend_tab">Sales Trend</a></li>
		<li role="presentation"><a data-toggle="tab" href="#revenue_tab">Revenue</a></li>
        <li role="presentation"><a data-toggle="tab" href="#warranty_tab">Warranty & Service</a></li>
    </ul>
    <div class="panel panel-default">
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body tab-content">
                <?php 
                $dd_data['selected_value']= '';
                echo ap_drop_down(10,NULL,$dd_data);
                ?>                
                <div id="insight_tab" class="tab-pane fade in active">
                   
				   <div class="row">
                        <div id ="line_chart" class="col-lg-12" style="min-width: 310px; height: 265px; margin: 0 auto">
                            </div>
                    </div>
					<br>
                    <div class="row">
                    <div class="col-lg-2" role="group">
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-shopping-cart"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Purchase</span>
                        <span class="info-box-number">15,200</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 20%"></div>
                        </div>
                            <span class="progress-description">
                              20% Increase in Last year
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
                         
                    <div class="col-lg-2" role="group">
                    <div class="info-box bg-light-blue">
                      <span class="info-box-icon"><i class="fa fa-money"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Local Purchase</span>
                        <span class="info-box-number">5,200</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 10%"></div>
                        </div>
                            <span class="progress-description">
                              10% Decrease in last year
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
                        
                    <div class="col-lg-2" role="group">
                    <div class="info-box bg-orange">
                      <span class="info-box-icon"><i class="fa fa-usd"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">LC purchase</span>
                        <span class="info-box-number">10,200</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 50%"></div>
                        </div>
                            <span class="progress-description">
                              40% Increase in Last year
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
               <div class="col-lg-2" role="group">
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-credit-card"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Payable Amount</span>
                        <span class="info-box-number">5,200</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 30%"></div>
                        </div>
                            <span class="progress-description">
                              30% of total purchase
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
					
		<div class="col-lg-2" role="group">
                    <div class="info-box bg-light-blue">
                      <span class="info-box-icon"><i class="fa fa-truck"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Highest Inventory</span>
                        <span class="info-box-number">2000</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 60%"></div>
                        </div>
                            <span class="progress-description">
                              60% of total purchase
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
					
	       <div class="col-lg-2" role="group">
                    <div class="info-box bg-orange">
                      <span class="info-box-icon"><i class="fa fa-truck"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Lowest Inventory</span>
                        <span class="info-box-number">5,00</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 10%"></div>
                        </div>
                            <span class="progress-description">
                              10% of total purchase
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
                        
               </div>    
                   
				   <br>
                    <div class="row">
                    <div class="col-lg-2" role="group">
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="glyphicon glyphicon-folder-close"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Total Sales</span>
                        <span class="info-box-number">10,200</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 20%"></div>
                        </div>
                            <span class="progress-description">
                              20% Increase in Last year
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
                         
                    <div class="col-lg-2" role="group">
                    <div class="info-box bg-light-blue">
                      <span class="info-box-icon"><i class="fa fa-file"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Receivable Amount</span>
                        <span class="info-box-number">4,000</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 10%"></div>
                        </div>
                            <span class="progress-description">
                              10% of total sales
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
                        
                    <div class="col-lg-2" role="group">
                    <div class="info-box bg-orange">
                      <span class="info-box-icon"><i class="fa fa-truck"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Waiting for Delivery</span>
                        <span class="info-box-number">1,000</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 50%"></div>
                        </div>
                            <span class="progress-description">
                              40% of total sales
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>
               <div class="col-lg-2" role="group">
                    <div class="info-box bg-green">
                      <span class="info-box-icon"><i class="fa fa-truck"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Inventory</span>
                        <span class="info-box-number">5,200</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 50%"></div>
                        </div>
                            <span class="progress-description">
                              50% Increase in last year
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV>  
            
			<div class="col-lg-2" role="group">
                    <div class="info-box bg-light-blue">
                      <span class="info-box-icon"><i class="fa fa-tag"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Highest Sale</span>
                        <span class="info-box-number">4,200</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 5%"></div>
                        </div>
                            <span class="progress-description">
                              5% Increase in last year
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV> 
					
	 <div class="col-lg-2" role="group">
                    <div class="info-box bg-orange">
                      <span class="info-box-icon"><i class="fa fa-tag"></i></span>

                      <div class="info-box-content">
                        <span class="info-box-text">Lowest Sale</span>
                        <span class="info-box-number">1,000</span>

                        <div class="progress">
                          <div class="progress-bar" style="width: 3%"></div>
                        </div>
                            <span class="progress-description">
                              3% Increase in last year
                            </span>
                      </div>
                      <!-- /.info-box-content -->
                    </div>
                    </DIV> 			
					
               </div>
                </div>
                <div id="purchase_trend_tab" class="tab-pane fade">
                    <div class="row">
                        <div id="container" class="" style="min-width: 1250px; height: 400px; margin: 0 auto"></div>
                    </div>
                    
                </div>
                <div id="inventory_tab" class="tab-pane fade">
                    <div id="inventory" style="min-width: 1250px; height: 400px; margin: 0 auto"></div>
                </div>
                <div id="sales_trend_tab" class="tab-pane fade">
                    <div id="sales" style="min-width: 1250px; height: 400px; margin: 0 auto"></div>
                </div>
				
				<div id="revenue_tab" class="tab-pane fade">
				<div class="row">
				   <div class ="col-lg-12">
                    <div class="col-lg-6">
					  <div id="revenue"></div>
					</div>
					<div class="col-lg-6">
					  <div id="customer" style="min-width: 850px; height: 200px; margin: 0 auto">
					          
							<div class="col-lg-5 col-lg-offset-2">
								  <p class="text-center">
									<strong>Top 5 Customers</strong>
								  </p>

								  <div class="progress-group">
									<span class="progress-text"><b>Ryns Limited</b></span>
									<span class="progress-text pull-right">50k BDT</span>

									<div class="progress sm">
									  <div class="progress-bar progress-bar-green" style="width: 80%"></div>
									</div>
				                </div>
								
							   <div class="progress-group">
									<span class="progress-text"><b>Flora Limited</b></span>
									<span class="progress-text pull-right">40k BDT</span>

									<div class="progress sm">
									  <div class="progress-bar progress-bar-green" style="width: 70%"></div>
									</div>
				                </div>
								
								  <!-- /.progress-group -->
								  <div class="progress-group">
									<span class="progress-text"><b>Apsis Solutins</b></span>
									<span class="progress-text pull-right">30k BDT</span>

									<div class="progress sm">
									  <div class="progress-bar progress-bar-green" style="width: 60%"></div>
									</div>
								  </div>
								  <!-- /.progress-group -->
								  <div class="progress-group">
									<span class="progress-text"><b>Link3 Technologies</b></span>
									<span class="progress-text pull-right">25k BDT</span>
									

									<div class="progress sm">
									  <div class="progress-bar progress-bar-green" style="width: 55%"></div>
									</div>
								  </div>
								  <!-- /.progress-group -->
								  <div class="progress-group">
									<span class="progress-text"><b>Unique</b></span>
									<span class="progress-text pull-right">20k BDT</span>
									

									<div class="progress sm">
									  <div class="progress-bar progress-bar-green" style="width: 45%"></div>
									</div>
								  </div>
                  <!-- /.progress-group -->
                </div>
								  <!-- /.info-box-content -->
						     </div>
					
					  </div>
                    </div>
				</div>	
				  </div>
				
                <div id="warranty_tab" class="tab-pane fade">
                    <div id="warranty" style="min-width: 1250px; height: 400px; margin: 0 auto"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .mid_font{
        font-size: 20px;
    }
    
    //ADDED BY CHARLIE
	
.progress-group .progress-text {
  font-weight: 600;
}
.progress-group .progress-number {
  float: right;
}

.progress.sm,
.progress-sm {
  height: 8px;
}
.progress.sm,
.progress-sm,
.progress.sm .progress-bar,
.progress-sm .progress-bar {
  border-radius: 1px;
}

.info-box {
  display: block;
  min-height: 90px;
  background: #fff;
  width: 100%;
  box-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  border-radius: 1px;
  margin-bottom: 5px;
}
.info-box small {
  font-size: 14px;
}
.info-box .progress {
  background: rgba(0, 0, 0, 0.2);
  margin: 5px -10px 5px -10px;
  height: 2px;
}

.progress-bar-green {
  background-color: #057A30;
}



.info-box .progress,
.info-box .progress .progress-bar {
  border-radius: 0;
}
.info-box .progress .progress-bar {
  background: #fff;
}
.info-box-icon {
  border-top-left-radius: 0;
  border-top-right-radius: 0;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
  display: block;
  float: left;
  width: 30px;
  text-align: center;
  font-size: 20px;
  line-height: 90px;
  background: rgba(0, 0, 0, 0.2);
}
.info-box-icon > img {
  max-width: 20%;
}
.info-box-content {
  padding: 5px 10px;
  margin-left:30px;
}
.info-box-number {
  display: block;
  font-weight: bold;
  font-size: 18px;
}
.progress-description,
.info-box-text {
  display: block;
  font-size: 11px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.info-box-text {
  text-transform: uppercase;
}
.info-box-more {
  display: block;
}
.progress-description {
  margin: 0;
}

.bg-red,
.bg-yellow,
.bg-aqua,
.bg-blue,
.bg-light-blue,
.bg-green,
.bg-navy,
.bg-teal,
.bg-olive,
.bg-lime,
.bg-orange,
.bg-fuchsia,
.bg-purple,
.bg-maroon,
.bg-black,
.bg-red-active,
.bg-yellow-active,
.bg-aqua-active,
.bg-blue-active,
.bg-light-blue-active,
.bg-green-active,
.bg-navy-active,
.bg-teal-active,
.bg-olive-active,
.bg-lime-active,
.bg-orange-active,
.bg-fuchsia-active,
.bg-purple-active,
.bg-maroon-active,
.bg-black-active,
.callout.callout-danger,
.callout.callout-warning,
.callout.callout-info,
.callout.callout-success,
.alert-success,
.alert-danger,
.alert-error,
.alert-warning,
.alert-info,
.label-danger,
.label-info,
.label-warning,
.label-primary,
.label-success,
.modal-primary .modal-body,
.modal-primary .modal-header,
.modal-primary .modal-footer,
.modal-warning .modal-body,
.modal-warning .modal-header,
.modal-warning .modal-footer,
.modal-info .modal-body,
.modal-info .modal-header,
.modal-info .modal-footer,
.modal-success .modal-body,
.modal-success .modal-header,
.modal-success .modal-footer,
.modal-danger .modal-body,
.modal-danger .modal-header,
.modal-danger .modal-footer {
  color: #fff !important;
}
.bg-gray {
  color: #000;
  background-color: #d2d6de !important;
}
.bg-gray-light {
  background-color: #f7f7f7;
}
.bg-black {
  background-color: #111111 !important;
}
.bg-red,
.callout.callout-danger,
.alert-danger,
.alert-error,
.label-danger,
.modal-danger .modal-body {
  background-color: #dd4b39 !important;
}
.bg-yellow,
.callout.callout-warning,
.alert-warning,
.label-warning,
.modal-warning .modal-body {
  background-color: #f39c12 !important;
}
.bg-aqua,
.callout.callout-info,
.alert-info,
.label-info,
.modal-info .modal-body {
  background-color: #00c0ef !important;
}
.bg-blue {
  background-color: #0073b7 !important;
}
.bg-light-blue,
.label-primary,
.modal-primary .modal-body {
  background-color: #3c8dbc !important;
}
.bg-green,
.callout.callout-success,
.alert-success,
.label-success,
.modal-success .modal-body {
  background-color: #00a65a !important;
}
.bg-navy {
  background-color: #001f3f !important;
}
.bg-teal {
  background-color: #39cccc !important;
}
.bg-olive {
  background-color: #3d9970 !important;
}
.bg-lime {
  background-color: #01ff70 !important;
}
.bg-orange {
  background-color: #ff851b !important;
}
.bg-fuchsia {
  background-color: #f012be !important;
}
.bg-purple {
  background-color: #605ca8 !important;
}
.bg-maroon {
  background-color: #d81b60 !important;
}
.bg-gray-active {
  color: #000;
  background-color: #b5bbc8 !important;
}
.bg-black-active {
  background-color: #000000 !important;
}
.bg-red-active,
.modal-danger .modal-header,
.modal-danger .modal-footer {
  background-color: #d33724 !important;
}
.bg-yellow-active,
.modal-warning .modal-header,
.modal-warning .modal-footer {
  background-color: #db8b0b !important;
}
.bg-aqua-active,
.modal-info .modal-header,
.modal-info .modal-footer {
  background-color: #00a7d0 !important;
}
.bg-blue-active {
  background-color: #005384 !important;
}
.bg-light-blue-active,
.modal-primary .modal-header,
.modal-primary .modal-footer {
  background-color: #357ca5 !important;
}
.bg-green-active,
.modal-success .modal-header,
.modal-success .modal-footer {
  background-color: #008d4c !important;
}
.bg-navy-active {
  background-color: #001a35 !important;
}
.bg-teal-active {
  background-color: #30bbbb !important;
}
.bg-olive-active {
  background-color: #368763 !important;
}
.bg-lime-active {
  background-color: #00e765 !important;
}
.bg-orange-active {
  background-color: #ff7701 !important;
}
.bg-fuchsia-active {
  background-color: #db0ead !important;
}
.bg-purple-active {
  background-color: #555299 !important;
}
.bg-maroon-active {
  background-color: #ca195a !important;
}
[class^="bg-"].disabled {
  opacity: 0.65;
  filter: alpha(opacity=65);
}
.text-red {
  color: #dd4b39 !important;
}
.text-yellow {
  color: #f39c12 !important;
}
.text-aqua {
  color: #00c0ef !important;
}
.text-blue {
  color: #0073b7 !important;
}
.text-black {
  color: #111111 !important;
}
.text-light-blue {
  color: #3c8dbc !important;
}
.text-green {
  color: #00a65a !important;
}
.text-gray {
  color: #d2d6de !important;
}
.text-navy {
  color: #001f3f !important;
}
.text-teal {
  color: #39cccc !important;
}
.text-olive {
  color: #3d9970 !important;
}
.text-lime {
  color: #01ff70 !important;
}
.text-orange {
  color: #ff851b !important;
}
.text-fuchsia {
  color: #f012be !important;
}
.text-purple {
  color: #605ca8 !important;
}
.text-maroon {
  color: #d81b60 !important;
}
.link-muted {
  color: #7a869d;
}
.link-muted:hover,
.link-muted:focus {
  color: #606c84;
}
.link-black {
  color: #666;
}
.link-black:hover,
.link-black:focus {
  color: #999;
}
</style>

<script>
    $(function () {
	
		
	   /* create line graph chart
		*by charlie
		* 28 May 2016
		*/
		
	$('#line_chart').highcharts({
        title: {
            text: 'Monthly Average Sales',
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
		
	 plotOptions: {
            series: {
                cursor: 'pointer',
                point: {
                    events: {
                        click: function () {
                            //alert('Category: ' + this.category + ', value: ' + this.y);
							location.href ='<?php echo base_url();?>sales/sales_order_history';
                        }
                    }
                }
            }
        },
		
        series: [{
            name: 'Current Year',
            data: [5000,4500,5500,4500,6000]
        }, {
            name: 'Last Year',
            data: [4800, 4500, 5000,5000, 5500,6500,5400,5500,5000,6000,6200,6500]
        }]
    });	
		
    // Create the chart
    $('#container').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Product Wise Purchase'
        },
        xAxis: {
            categories: [
                'Laptop',
                'Monitor',
                'Server',
                'Router',
                'Mouse',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Purchase(BDT)'
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
            name: 'Current Year',
            data: [5500,4000,6000,5600,8000]

        }, {
            name: 'Last Year',
            data: [5000,4500,6600,5600,8700]

        }]
    });
});

   $(function () {
        $('#revenue').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: 'pie'
            },
            title: {
                text: 'Customer Wise Revenue'
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
                name: 'Brands',
                colorByPoint: true,
                data: [{
                    name: 'Reseller',
                    y: 50
                }, {
                    name: 'Corporate',
                    y: 24,
                    sliced: true,
                    selected: true
                }, {
                    name: 'End User',
                    y: 30
                }, {
                    name: 'Govt.',
                    y: 10
                }]
            }]
        });

   });
   
   
$(function () {

    $(document).ready(function () {

        // Build the chart
  $('#inventory').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Product Wise Available Stock'
        },
        xAxis: {
            categories: ['Laptop', 'Router', 'Monitor', 'Server', 'Mouse'],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Stock (BDT)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' BDT'
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
            data: [70000,60000, 65000,45000,30000]
        }]
    });
    });
});

$(function () {
    // Create the chart
       $('#sales').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Product Wise Sales'
        },
        xAxis: {
            categories: [
                'Laptop',
                'Monitor',
                'Server',
                'Router',
                'Mouse',
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Sales(BDT)'
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
            name: 'Current Year',
            data: [6000,5500,6500,7000,8000]

        }, {
            name: 'Last Year',
            data: [5000,4500,6600,5600,8700]

        }]
    });
});

$(function () {
    $('#warranty').highcharts({
        chart: {
            type: 'column'
        },
        title: {
            text: 'Product Wise Warranty OR Support'
        },
//        subtitle: {
//            text: 'Source: WorldClimate.com'
//        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'No. of Tickets'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
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
            name: 'PC',
            data: [49, 71, 106, 129, 144]

        }, {
            name: 'Laptop',
            data: [83, 78, 98, 93, 106]

        }, {
            name: 'Mouce',
            data: [48, 38, 39, 41, 47]

        }, {
            name: 'Keyboard',
            data: [42, 33, 34, 39, 52]

        }]
    });
});
</script>