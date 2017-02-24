<div class="text-center order_block"></div>
<form action="" method="post" id="fob_setting_frm">
<div class="panel panel-default">
        <div class="panel-heading">
            <div class="title">
                <?php echo label_html(COST_COMPONENTS_SETTINGS, 'Cost Components Settings');?> 
            </div>
               
           
        </div>
    <div class="panel-body">
        
        <div class="row">
            <div class="col-lg-4" style="margin:30px 0px 30px 40px;" >
                <div class="form-group">
                    <label for="" class="col-lg-4 control-label">Product Group <span class="text-danger">*</span></label>
                    <div class="col-lg-8 dropdown">
                        <?php 
                            $extra_info['selected_value'] = $pg_id;
                            $extra_info['extra_attr'] = array('class' => 'product_group_id', '' => '');
                            echo ap_drop_down(7,NULL,$extra_info); 
                        ?>
                         <?php // echo product_group_id(($pg_id !=NULL)?$pg_id:'', array('class' => 'product_group_id', '' => '')); ?> 
                    </div>
                </div>
            </div>
        </div>

<div class="col-lg-6 " style="margin-left: 40px;">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Cost Component</h3>
    </div>
    <div class="panel-body">
                   
        <table id="dhy">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Value</th>
                    <th>Formula On</th>
                    <th class="pull-right">Row Index</th>
                </tr>
            </thead>
            <tbody id="dhy_boday">
                <?php
                    $data['fob'] = $fob;
                    $this->load->view("purchase/fob_setting_view_fob_list");
                ?>                
            </tbody>
        </table>
     </div>
     </div>

</div>


<div class="col-lg-5 " style="margin-left: 5px;">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Existing List</h3>
    </div>
    <div class="panel-body">
        <table class="table table-bordered" id="dhy_existing_list">
            <?php
                if(isset($_GET['pg_id']))
                {
                    $data['fob_existing'] = $fob_existing;
                    $data['product_group'] = $product_group;
                    $this->load->view("purchase/fob_setting_view_fob_list_existing",$data);
                }
                
            ?>
        </table>
                      
    </div>
</div>
</div>
        
    </div>
</div>
<div class="row "></div>
    <div>
        <input type="hidden" class="pro_invoice_id" value="<?php echo @$_GET['pi_id']; ?>">
        <input <?= bpa('fob_setting')?'':'disabled="disabled"'; ?> type="submit" id="fob_btn"class="btn btn-primary" value="Save" style="margin: 10px 70px 10px 10px; ">
    </div>
</form>  
<style>
    tr,td{
        padding: 5px;
        margin-left: 1px;
        text-align: left;
        
    }
    th{
        text-align: center;
        margin-left: 2px;
    }
    
    #th_name{
        padding: 2px;
    }
    
    input[type=text] {
    padding: 7px;
}
</style>

<script>
$(document).on('click','.fob_check',function(){
    var count = 0;
    $('.fob_check').each(function(i){
        if(this.checked)
        {
            $(this).parent().parent().find(".row_index").val(String.fromCharCode(65 + count));
            count++;
        }
        else
        {
            $(this).parent().parent().find(".row_index").val('');
            $(this).parent().parent().find(".value_of").val('');
            $(this).parent().parent().find(".formula_of").val('');
        }
    });
});


$(document).on("click","#fob_btn",function(e){
    e.preventDefault();
    var product_group_id = $('.product_group_id option:selected').val();
    var pro_invoice_id = $('.pro_invoice_id').val();
    if(product_group_id)
    {
        $.ajax({
            url: '<?php echo base_url(); ?>purchase/fob_setting_save',
            type: 'POST',
            data: $("#fob_setting_frm").serialize(),
            success: function (data) {
                if(data == true)
                {
                    if(pro_invoice_id != "")
                    {
                        window.location.href = "<?php echo base_url(); ?>purchase/proforma_invoice_details/"+pro_invoice_id+"/?pg_id="+product_group_id;
                    }
                    else
                    {
                        window.location.href = "<?php echo base_url(); ?>purchase/fob_setting/?pg_id="+product_group_id;
                    }                    
                }
                else
                {
                    var htm ='<div class="invalid alert alert-danger">';
                    htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
                    htm += 'Something wrong. please try again!!!';
                    htm +='</div>';
                   $('.order_block').html(htm);
                }
            }
        });
    }
    else
    {
        var htm ='<div class="invalid alert alert-danger">';
        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        htm += 'Star(*) Mark field are required.';
        htm +='</div>';
       $('.order_block').html(htm);
    }
});


    $(document).on('change','.product_group_id',function(){
        var product_group_id = $(this).val();
        if(product_group_id)
        {
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/change_fob_list_by_product_group',
                 type: 'POST',
                 data: {product_group_id:product_group_id},
                 success: function (data) {
                     $("#dhy_boday").html(data);
                 }
            }) ;
            $.ajax({
                url: '<?php echo base_url(); ?>purchase/change_existing_fob_list_by_product_group',
                 type: 'POST',
                 data: {product_group_id:product_group_id},
                 success: function (data) {
                     $("#dhy_existing_list").html(data);
                 }
            }) ;
        }
                
    });
</script>