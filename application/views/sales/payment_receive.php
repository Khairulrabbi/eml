<div class="panel panel-default">
           <div class="panel-heading"><?php echo label_html(PAYMENT_DETAILS, 'PAYMENT_DETAILS'); ?></div>
		  <div class="panel-body">
                      
                    <table class="table">
                        <tbody>
                            <tr> 
                                <th><?php echo label_html(NAME, 'NAME')?></th><td><input class="form-control" type="text"></td>
                                <th><?php echo label_html(ENTERED_BY, 'ENTERED_BY')?></th><td>Mr.Rakib</td>
                                <th><?php echo label_html(INVOICE_NO, 'INVOICE_NO')?></th><td>2016-AB-0802123</td>
                            </tr>
                            <tr> 
                                <th><?php echo label_html(REF, 'REF'); ?></th><td><input class="form-control" type="text"></td>
                                <th><?php echo label_html(ENTERED_DATE, 'ENTERED_DATE'); ?></th><td>2016-05-30</td>
                                <th><?php echo label_html(STATUS, 'STATUS'); ?></th><td>Partial Paid</td>
                            </tr>
                            
                            <tr> 
                                <th><?php echo label_html(NOTE, 'NOTE'); ?></th><td><input class="form-control" type="textarea"></td>
                                <th><?php echo label_html(CONFIRMED_DATE, 'CONFIRMED_DATE'); ?></th><td>2016-04-20</td>
								<th><td></td></th>
                            </tr>
                            
                            <tr> 
                                <th><?php echo label_html(RECEIPT_CURRENCY, 'RECEIPT_CURRENCY'); ?></th>
                                <td>
                                    <?php echo ap_drop_down(5,NULL,array("selected_value"=>'')); ?>
                                    <?php //echo curency_list();?>
                                </td>
                                <th><?php echo label_html(CURRENCY_RATE, 'CURRENCY_RATE'); ?></th><td><input class="form-control" type="number"></td>
                                <th><?php echo label_html(RECEIVED_AMOUNT, 'RECEIVED_AMOUNT'); ?></th><td><input class="form-control" type="number"></td>
                            </tr>
                        </tbody>
						
                    </table>
					<button id="distribute" class="btn btn-primary btn btn-sm pull-right">Distribute</button>
                      <br><br> 
					  <div id="payment_list" style="display:none;">
                       <table class="table" >
			 <thead>
			    <tr>
                                <th><?php echo label_html(SL_NO, 'SL_NO'); ?></th><th><?php echo label_html(SALES_ORDER_NO, 'SALES_ORDER_NO'); ?></th><th><?php echo label_html(TOTAL_VALUE, 'TOTAL_VALUE'); ?></th>
                                <th><?php echo label_html(PAID_AMOUNT, 'PAID_AMOUNT'); ?></th><th><?php echo label_html(REMAINING_AMOUNT, 'REMAINING_AMOUNT'); ?></th> 
                                <th><?php echo label_html(AMOUNT, 'AMOUNT'); ?></th>
			    </tr>
			 </thead>
			 <tbody>
                            <tr>
                                <td>1</td>
                                <td>SO-2016-02</td>
                                <td>100000</td>
                                <td>50000</td>
                                <td>50000</td>
                                <td><input class="form-control amount" type="number" value='0'></td>
                            </tr>
                            
                            <tr>
                                <td>2</td>
                                <td>SO-2016-02</td>
                                <td>50000</td>
                                <td>20000</td>
                                <td>30000</td>
                                <td><input class="form-control amount" type="number" value='0'></td>
                            </tr>
                            
                            <tr>
                                <td>3</td>
                                <td>SO-2016-04</td>
                                <td>30000</td>
                                <td>0</td>
                                <td>30000</td>
                                <td><input class="form-control amount" type="number" value='0'></td>
                            </tr>
                            
                         </tbody>
		       </table>
			   
			<div class="col-lg-4 pull-right"><strong>Total:</strong><span class="total" value='0'></span>
			<button id="receive" class="btn btn-primary btn btn-sm pull-right">Receive</button>
			</div>
	    
        <div>
		</div> <!--Panel body close -->
</div> <!--Panel div close -->
<script>

$(document).ready(function(){
    
    $("#receive").on("click",function(){
        location.href = '<?php echo base_url(); ?>sales/payment_receipt';
    });
    
	
	
    function calculation() {
        var sum = 0;
        $(".amount").each(function () {
            var subtotal_text = $(this).val();
            var subtotal_string = subtotal_text.replace(",", "");
            var sub_total = parseFloat(subtotal_string).toFixed(2);
            sum = parseFloat(parseFloat(sum) + parseFloat(sub_total)).toFixed(2);
			

        });
        $(".total").text(sum+ ' TK');
    }
	
   $(document).on("input",".amount", function () {
        calculation();
    });
	
	
     $("#distribute").on("click",function(){
		 $("#payment_list").toggle();
	 });
});

</script>


