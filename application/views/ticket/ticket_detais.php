
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Product Details</h3>
                    </div>
                    <div class="panel-body">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Order No.</th>
                                    <td><?php echo $ticket_info->sales_code;?></td>
                                    <th>Warranty Start</th>
                                    <td><?php echo $ticket_info->warranty_start; ?></td> 
                                    <th>Customer Warrnaty Start</th>
                                    <td><?php echo $ticket_info->customer_warranty_start;?></td>      
                                       
                                </tr>
                                <tr>
                                    <th>Product Name</th>
                                    <td><?php echo $ticket_info->product_name;?></td>
                                    <th>Warranty End</th>
                                    <td><?php echo $ticket_info->warranty_end;?></td>
                                    <th>Customer Warranty End</th>
                                    <td><?php echo $ticket_info->customer_warranty_end;?></td>
                                    
                                    
                                </tr>
                                <tr>
                                    <th>Product Code</th>
                                    <td><?php echo $ticket_info->product_code; ?></td>
                                    <th>Warranty Left</th>
                                    <td><?php echo $ticket_info->warranty_left; ?></td>
                                                              
                                    
                                    <th>Customer Warranty Left </th>
                                    <td><?php echo $ticket_info->customer_warranty_left;?></td>
                                </tr>
                                
                            </tbody>
                        </table>  
                        
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ticket Details </h3>
                    </div>
                    <div class="panel-body">                        
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>Ticket Code</th>
                                    <td><?php echo $ticket_info->ticket_code;?></td>
                                    <th>Customer Name</th>
                                    <td><?php echo $ticket_info->customer_name;?></td>
                                    <th>Service Status</th>
                                    <td style="color: green;"><?php echo $ticket_info->status_name;?></td>
                                </tr>
                                <tr>
                                    <th>Serial Number</th>
                                    <td><?php echo $ticket_info->serial_number; ?></td>
                                    <th>Customer Mobile</th>
                                    <td><?php echo $ticket_info->customer_mobile;?></td>
                                    <th>Problem Details</th>
                                    <td><?php echo $ticket_info->problem_details;?></td>
                                   
                                </tr>
                                <tr>
                                    <th>Service Tag</th>
                                    <td><?php echo $ticket_info->service_tag; ?></td>
                                    <th>Customer Address</th>
                                    <td><?php echo $ticket_info->customer_address; ?></td>
                                    <th>Assigned</th>
                                    <td><?php echo $ticket_info->username; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                    $data['ticket_id'] = $ticket_info->ticket_id;
                    $data['primary_observation_info'] = $primary_observation_info;
                    $data['userid'] = $ticket_info->assign;
                    $this->load->view('ticket/primary_observation',$data); 
                ?>
            </div>
        </div>
