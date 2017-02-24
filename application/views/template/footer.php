<!--<div class="col-lg-12 footer">
<div class="col-lg-3">
<a href="http://www.dell.com/">
 <img src="<?php echo base_url().'images/logo/dell.png'?>" alt='Dell' height=40"></a>
</div>
<div class="col-lg-6">
<i class="fa fa-copyright"></i> BTRAC Technologies
</div>

<div class="col-lg-3">
<a href="http://www.banglatrac.com/">
 <img src="<?php echo base_url().'images/logo/bangla_trac_logo.png'?>" alt='Dell' height=20"></a>
</div>

</div>-->
</div>
<!-- /#page-wrapper -->
<!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url()?>js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?=base_url()?>js/plugins/dataTables/jquery.dataTables.js"></script>
    <script src="<?=base_url()?>js/plugins/dataTables/dataTables.bootstrap.js"></script>
    <script src="<?=base_url()?>js/plugins/dataTables/dataTables.tableTools.js"></script>
    <script src="<?=base_url()?>js/custom_dataTable.js"></script>
    <script src="<?=base_url()?>js/select2.min.js"></script>
    <script src="<?=base_url()?>js/apsis_plugin.js"></script>
    <script src="<?=base_url()?>js/jquery-ui.js"></script>
    <script src="<?=base_url()?>js/numbertoword.js"></script>

    
    <!--Only datepicker show in firefox-->
    <!-- cdn for modernizr, if you haven't included it already -->
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/extras/modernizr-custom.js"></script>
    <!-- polyfiller file to detect and load polyfills -->
    <script src="http://cdn.jsdelivr.net/webshim/1.12.4/polyfiller.js"></script>
    <script>
      webshims.setOptions('waitReady', false);
      webshims.setOptions('forms-ext', {types: 'date'});
      webshims.polyfill('forms forms-ext');
    </script>
    <script>
//    end datepicker show plugin
    
       
$(document).ready(function(){
    $('select').select2();
	/*$('input[type=date]').addClass('datepicker');*/
    /*webshims.setOptions('forms-ext', {types: 'date',"widgets": {"startView": 0}});*/
//	webshim.setOptions("forms-ext", {
//	"widgets": {
//		"startView": 2,
//		"minView": 0,
//		"inlinePicker": false,
//		"size": 1,
//		"splitInput": false,
//		"yearSelect": false,
//		"monthSelect": false,
//		"daySelect": false,
//		"noChangeDismiss": false,
//		"openOnFocus": false,
//		"buttonOnly": true,
//		"classes": "",
//		"popover": {
//			//popover options
//		},
//		"calculateWidth": true,
//		"animate": true,
//		"toFixed": 0,
//		"onlyFixFloat": false
//	}
//});
//	webshims.polyfill('forms forms-ext');
//    $("h1").colorful();
//    $('p.money').bdt();
//    //$(".amount").calculate();
//    $("select[class!='max']").select2();
//    $(".max").select2({maximumSelectionSize: 5});
    // 
    //----------------- Datetime picker --------------------- //
    $('.datetimepicker').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        forceParse: 0,
        showMeridian: 1
    });
    //Class for only date picker
    $('.datepicker').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0
    });
    //Class for only month picker
         $('.monthpicker').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 3,
        minView: 3,
        forceParse: 0
    });
    //Class for only time picker
    $('.timepicker').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 1,
        minView: 0,
        maxView: 1,
        forceParse: 0
    });
    
    
    
    // --------------- Datepicker related code ends ----------------- //
    
    $("#selectAll").click(function () {
    if(this.checked){
        $('#dataTables-checkbox tbody tr').each(function(){
            if($(this).children('td').first().children('input').length){
                $('.chkbox:visible').prop('checked',true);
                $(this).addClass('new_tr');
            }
        });  
    }else{
        $('#dataTables-checkbox tbody tr').each(function(){
            if($(this).children('td').first().children('input').length){
                $('.chkbox:visible').prop('checked',false);
                $(this).removeClass('new_tr');
            }
        });
   }
});
    $('.chkbox').click(function(){
        if(this.checked){
            $(this).parent('td').parent('tr').addClass('new_tr');  
        }else{
            $(this).parent('td').parent('tr').removeClass('new_tr');
       }
    });
 });
function stopPropagation(evt) {
    if (evt.stopPropagation !== undefined) {
            evt.stopPropagation();
    } else {
            evt.cancelBubble = true;
    }
}
 function ajax_call(func_name,val,field_name,conditional_field,id_field){
    var on_change = $('#'+id_field).data('allow_ajax');
    $.ajax({
        url:'../master/generate_combo_by_ajax_call',
        type:"post",
        data:{function_name:func_name,field_name:field_name,id:conditional_field,val:val,on_change:on_change},
        success:function(data){
            $('#'+id_field).html(data);
            $('select').select2();
        }
    });
 }
 // For check unique value in master entry
 $('input[field_type="unique"]').blur(function(){
    var elem = $(this);
    var table_name = elem.data('table_name');
    var field_name = elem.attr('name');
    var val = elem.val();
    if(val == ''){
        elem.next('.draw_msg').html('');
        return;
    }
    var entry_id = $(this).attr('entry_id');
    if (typeof entry_id === typeof undefined && entry_id === false) {
        entry_id = 0;
    }
    $.ajax({
        url:'<?php echo base_url('master/check_uniqueness'); ?>',
        type:'post',
        data:{table_name:table_name,field_name:field_name,field_value:val,entry_id:entry_id},
        success: function(data){
            var obj = $.parseJSON(data);
            elem.next('.draw_msg').html(obj.msg);
            $('button[type="submit"]').removeAttr('disabled');
            $('.label-danger').each(function(){
                $('button[type="submit"]').attr('disabled','disabled');
            });
        }
    });
 });
 
 function addCommas(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2;
}
function capitalizeEachWord(str) {
    return str.replace(/\w\S*/g, function(txt) {
        return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
    });
}
function apsis_money(nStr)
{
	nStr += '';
	x = nStr.split('.');
	x1 = x[0];
	x2 = x.length > 1 ? '.' + x[1] : '';
	var rgx = /(\d+)(\d{3})/;
	while (rgx.test(x1)) {
		x1 = x1.replace(rgx, '$1' + ',' + '$2');
	}
	return x1 + x2 + '.00';
}
</script>
<script>
   
    function get_product_list() {
        var product_category_id = $('.product_category_id option:selected').val();
        ;
        //alert(category_id);
        var product_brand_id = $('.product_brand_id option:selected').val();
        var product_subcategory_id = $('.product_subcategory_id option:selected').val();
        $.ajax({
            url: '<?php echo base_url();?>'+'ajax_controller/get_product_list_combo',
            type: 'POST',
            data: {product_category_id: product_category_id, product_brand_id: product_brand_id, sub_category_id: product_subcategory_id},
            success: function (data) {
                //alert(data);
                $('.product_list').html(data);
                $('select').select2();
            }
        });
    }

//this function commonly use add product modal open(purchase order, requisition, sales order)
$('#add_product').on("click",function(){
    var order_id = $(".order_id").val();
    var module = $(this).attr("module");
    if(order_id){
        $('.appendSearchPanel').append('<input type="hidden" name="order_id" value="'+order_id+'">');//this line only add item search panel
        $('.appendSearchPanel').append('<input type="hidden" name="module" value="'+module+'">');//this line only add item search panel
        $(this).attr("data-target", "#add_product_m");
    }else{
        var htm ='<div class="invalid alert alert-danger">';
        htm += '<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>';
        htm += 'Please Save Order First.';
        htm +='</div>';
        $('.product_block').html(htm);
    }
});
    
</script>
<?php
    $this->load->view("template/all_title_name_page");
    //$data['breadcrumb'] = $breadcrumb;
    $this->load->view("template/breadcrumb");
?>

</body>
</html>