<form class="form-horizontal"  id="my_form" method="post" action="<?php echo base_url() ?>ticket/new_ticket/<?php echo $ticket_id; ?>">
    <input type="hidden" id="order_id" class="order_id" name="ticket_id" value="<?php echo $ticket_id; ?>">
    
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo $title; ?> </h3>
                </div>
                <div class="panel-body">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="docking" class="col-lg-3 control-label">Docking.</label>
                            <div class="col-lg-9">
                                <input required type="text" class="form-control docking" id="docking" name="docking" value="<?php echo @$ticket_info->docking; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="docking_date_time" class="col-lg-3 control-label">Docking date </label>
                            <div class="col-lg-9">
                                <input  readonly="true" required type="date" class="form-control docking_date_time " id="docking_date_time" name="docking_date_time" value="<?php echo @$ticket_info->docking_date_time; ?>">
                            </div>
                        </div>
<!--                         <div class="form-group">
                            <label for="attended_date" class="col-lg-3 control-label">Attended Date</label>
                            <div class="col-lg-9">
                                <input required type="date" class="form-control attended_date" id="attended_date" name="attended_date" value="<?php echo @$ticket_info->attended_date; ?>">
                            </div>
                        </div>-->
                        <div class="form-group">
                            <label for="category_id" class="col-lg-3 control-label">Product Category</label>
                            <div class="col-lg-9">
							<?php 
							  if(!empty($fetch_info)){?>
							 <input readonly="true" required type="text" class="form-control category_id get_product" id="category_id" name="product_category_id" value="<?php echo @$fetch_info->product_category_name; ?>">
                              <?php }
							  else
						        echo category_list(@$ticket_info->category_id, array('class' => 'category_id get_product'));
							?>
							                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="product_brand_id" class="col-lg-3 control-label">Product Brand</label>
                            <div class="col-lg-9">
							<?php if(!empty($fetch_info)){?>
		<input readonly="true" required type="text" class="form-control brand_id get_product" id="product_brand_id" name="product_brand_id" value="<?php echo @$fetch_info->product_brand_name; ?>">					
							<?php }
							else 
								echo brand_list(@$ticket_info->product_brand_id, array('class' => 'brand_id get_product'));
							?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="service_tag" class="col-lg-3 control-label">Service Tag </label>
                            <div class="col-lg-9">
                                <input   required type="text" class="form-control service_tag " id="service_tag" name="service_tag" value="<?php echo @$ticket_info->service_tag; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client_customer_company_info" class="col-lg-3 control-label">Client Info </label>
                            <div class="col-lg-9">
                                <textarea name="client_customer_company_info" class="form-control"><?php echo @$ticket_info->client_customer_company_info; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="client_customer_company_info" class="col-lg-3 control-label"></label>
                            <div class="col-lg-9">
                               <?php if($ticket_id){?>
                                   <input type="submit" name="save" class="save btn btn-primary" value="Update">
                              <?php }else{ ?>
                                <input type="submit" name="save" class="save btn btn-primary" value="Save">
                              <?php } ?>
                            </div>
                        </div>
                        
                    </div>

                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="serial_number" class="col-lg-3 control-label">Serial No. </label>
                            <div class="col-lg-9">
							<?php if(!empty($fetch_info)){?>
                                <input   readonly="true" required type="text" class="form-control serial_number " id="docking_date_time" name="serial_number" value="<?php echo @$fetch_info->serial_number; ?>">
                            <?php }
							   else ?>
								<input   required type="text" class="form-control serial_number " id="docking_date_time" name="serial_number" value="<?php echo @$ticket_info->serial_number; ?>">
							
							</div>
                        </div>
                        <div class="form-group">
                            <label for="brand_model_id" class="col-lg-3 control-label">Attended Date</label>
                            <div class="col-lg-9">
                                <input required type="date" class="form-control brand_model_id" id="brand_model_id" name="brand_model_id" value="<?php echo @$ticket_info->brand_model_id; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sub_category_list" class="col-lg-3 control-label">Product Subcategory</label>
                            <div class="col-lg-9 sub_category_list">
							
						<?php if(!empty($fetch_info)){?>
			<input readonly="true" required type="text" class="form-control sub_category_id get_product" id="product_subcategory_id" name="product_subcategory_id" value="<?php echo @$fetch_info->product_subcategory_name; ?>">								
						<?php }
						else 
							echo sub_category_list(@$ticket_info->product_subcategory_id, array('class' => 'sub_category_id get_product'));
                            ?>
							</div>
                        </div>
                        <div class="form-group">
                            <label for="product_id" class="col-lg-3 control-label">Product</label>
                            <div class="col-lg-9 product_list">
							
							<?php if(!empty($fetch_info)){?>
							<input readonly="true" required type="text" class="form-control product_id" id="product_id" name="product_subcategory_id" value="<?php echo @$fetch_info->product_name; ?>">			
							<?php }
							else
							echo product_list(@$ticket_info->product_id, array('class' => 'product_id'));	
							?>
							
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="service_type_id" class="col-lg-3 control-label">Service Type</label>
                            <div class="col-lg-9">
                                <?php echo service_type(@$ticket_info->product_brand_id, array('class' => 'brand_id get_product')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="service_type_id" class="col-lg-3 control-label">SLA AMC Term</label>
                            <div class="col-lg-9">
                                <?php echo sla_amc_term(@$ticket_info->product_brand_id, array('class' => 'brand_id get_product')); ?>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="problem_details" class="col-lg-3 control-label">Problem Details </label>
                            <div class="col-lg-9">
                                <textarea name="problem_details" class="form-control"><?php echo @$ticket_info->problem_details; ?></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-lg-6" align=""></div>
                    <div class="form-group col-lg-6" style="text-align: left;"></div>

                </div>
            </div>
        </div>

        

        
</form>
<script>
    $(".category_id").on("change", function () {
        var category_id = $(this).val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_sub_category',
            type: 'POST',
            data: {category_id: category_id},
            success: function (data) {
                //alert(data);
                $(".sub_category_list").html(data);
                $('select').select2();
            }
        });
    })


    $(document).on("change", '.get_product', function () {
        get_product_list();

    })
    function get_product_list() {
        var category_id = $(".category_id option:selected").val();
        ;
        //alert(category_id);
        var brand_id = $(".brand_id option:selected").val();
        var sub_category_id = $(".sub_category_id option:selected").val();
        $.ajax({
            url: '<?php echo base_url(); ?>common_controller/get_product_list_combo',
            type: 'POST',
            data: {category_id: category_id, brand_id: brand_id, sub_category_id: sub_category_id},
            success: function (data) {
                //alert(data);
                $(".product_list").html(data);
                $('select').select2();
            }
        });
    }


    

    
    $(document).on("click", ".add_product", function (e) {
        e.preventDefault();
        $("#my_form").attr("action", "<?php echo base_url() ?>purchase/save_order_details");
        $("#my_form").submit();
    })
</script>