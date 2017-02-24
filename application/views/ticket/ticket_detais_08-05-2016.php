<form class="form-horizontal" role="form" method="post" id="my_form" action="<?php echo base_url();?>ticket/update_ticket/<?php echo $ticket_info->ticket_id; ?>">
     <input type="hidden" class="main_order_id" name="ticket_id" value="<?php echo $ticket_info->ticket_id; ?>">
    <div class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo $title; ?> </h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">

                            <tbody>

                                <tr>
                                    <th>Docking</th>
                                    <td><?php echo $ticket_info->docking;?></td>
                                    <th>Serial No</th>
                                    <td><?php echo $ticket_info->docking; ?></td>
                                </tr>
                                <tr>
                                    <th>Docking Date</th>
                                    <td><?php echo $ticket_info->docking_date_time;?></td>
                                    <th>Attended Date</th>
                                    <td><?php echo $ticket_info->attended_date; ?></td>
                                </tr>
                                <tr>
                                    <th>Product Category</th>
                                    <td><?php echo $ticket_info->product_category_name;?></td>
                                    <th>Product Subcategory</th>
                                    <td><?php echo $ticket_info->product_subcategory_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Product Brand</th>
                                    <td><?php echo $ticket_info->product_brand_name;?></td>
                                    <th>Product</th>
                                    <td><?php echo $ticket_info->product_name;?></td>
                                </tr>
                                <tr>
                                    <th>Service Tag </th>
                                    <td><?php echo $ticket_info->service_tag;?></td>
                                    <th>Service Type</th>
                                    <td><?php echo $ticket_info->service_type_name; ?></td>
                                </tr>
                                <tr>
                                    <th>SLA AMC Term</th>
                                    <td><?php echo $ticket_info->sla_amc_term_name;?></td>
                                    <th>Status</th>
                                    <td><?php echo $ticket_info->status_name; ?></td>
                                </tr>
                                <tr>
                                    <th>Client Info  </th>
                                    <td><?php echo $ticket_info->client_customer_company_info;?></td>
                                    <th>Problem Details </th>
                                    <td><?php echo $ticket_info->problem_details; ?></td>
                                </tr>
                            </tbody>
                        </table>  
                        <input type="submit" name="confirm"  class="btn btn-primary"value="Confirm">
                        </div>
                    
                        </div>


                
                        

                    </div>
                </div>
            </div>
        </div>

        
</form>
