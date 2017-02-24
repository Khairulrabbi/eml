

                    <div class="col-lg-5">
                        
                                <?php echo generate_search_panel($action = NULL, $data_array = array(
                                    'product_brand_id'=>array(1,1,1),
                                    'product_category_id'=>array(0,1,1),
                                    'product_subcategory_id'=>array(1,1,1),
                                    'product_id'=>array(0,1,1),
                                    'vendor_id'=>array(1,1,1),
                                    'customer_id'=>array(1,1,1),
                                    'date_from'=>array(1,1,1),
                                    'date_to'=>array(0,1,1)
                                  )
                                ); ?>

                           
                        </div>


                        
                        
                    </div>

                    

                </div>
            </div>
        </div>

<!--<script>
    $('.product_category_id').on('change', function () {
        var product_category_id = $(this).val();
        var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            $.ajax({
                url: '<?php echo base_url(); ?>ajax_controller/get_sub_category',
                type: 'POST',
                data: {product_category_id: product_category_id},
                success: function (data) {
                    //alert(data);
                    $('.sub_category_list').html(data);
                    $('select').select2();
                    get_product_list();
                }
            });
        }
    })
 

    $(document).on('change', '.product_brand_id', function () {
     var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            get_product_list();
        }

    })
    $(document).on('change', '.product_subcategory_id', function () {
         var ajax_call = $(this).attr('ajax_call');
        if(ajax_call){
            get_product_list();
        }

    })
    function get_product_list() {
        var product_category_id = $('.product_category_id option:selected').val();
        ;
        //alert(category_id);
        var product_brand_id = $('.product_brand_id option:selected').val();
        var product_subcategory_id = $('.product_subcategory_id option:selected').val();
        $.ajax({
            url: '<?php echo base_url(); ?>ajax_controller/get_product_list_combo',
            type: 'POST',
            data: {product_category_id: product_category_id, product_brand_id: product_brand_id, sub_category_id: product_subcategory_id},
            success: function (data) {
                //alert(data);
                $('.product_list').html(data);
                $('select').select2();
            }
        });
    }


    
</script>-->
<script>  
              
                $(document).on("change",'.product_id',function(){
                    alert($(this).val());
                });
            </script>