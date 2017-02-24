<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Product List</h3>
            </div>
            <div class="panel-body">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Search</h3>
                    </div>
                    <div class="panel-body">
                        <form id="search_form" class="" action="">
                            <?php echo generate_search_panel('',4,array(
                                'product_category_id' =>array(0,1,0),
                                'product_subcategory_id' =>array(0,1,0),
                                'product_brand_id' =>array(0,1,0),
                                'product_id' =>array(0,1,0),
                            ));?>
                        </form>
                        
                    </div>
                </div>
                <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">List</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover dataTable" id="model_list">
                        <thead>
                            <tr>
                                <th>#SL</th>
                                <th>Product Name</th>
                                <th>Brand</th>
                                <th>Category Name</th>
                                <th>Sub Category Name</th>
                                <th>Unit Price(USD)</th>
                                <th>Unit Price(BTD)</th>
                                <th>Created By</th>
                                <th>Created Date</th>
                                <th>Status</th>
                                <th >Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //$i = 1; foreach($model_list as $val){?>
<!--                                <tr>
                                    <td><?php echo $i;?></td>
                                    <td><?php echo $val['product_category_name']; ?></td>
                                    <td><?php echo $val['product_subcategory_name']; ?></td>
                                    <td><?php echo $val['product_brand_name']; ?></td>
                                    <td><?php echo $val['product_name']; ?></td>
                                    <td><?php echo $val['product_model_name']; ?></td>
                                    <td>
                                        <a class="" href="<?php echo base_url().'purchase/product_specification/'.$val['product_category_id'].'/'.$val['product_id'].'/'.$val['product_model_id'];?>">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </a>&nbsp;&nbsp;
                                        <a  href="<?php echo base_url().'purchase/view_specification/'.$val['product_category_id'].'/'.$val['product_id'].'/'.$val['product_model_id'];?>">
                                            <i class="glyphicon glyphicon-eye-open" id="view_spac"></i>
                                        </a> &nbsp;&nbsp;
                                        <a href="<?php echo base_url().'purchase/delete_model/'.$val['product_model_id'];?>"><i class="glyphicon glyphicon-remove"></i></a> 
                                        
                                    </td>
                                </tr>  -->
                            <?php //$i++;}?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
    </div>
    
</div>

<script>

//$(document).ready(function(){
//    $('#model_list').DataTable();
//});
//
//$(document).on('click','#view_spac',function(){
//    $("#spac_view_form").submit();
//});


</script>
