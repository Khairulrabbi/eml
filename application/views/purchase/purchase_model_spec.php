<table class="table ">
    <thead>
        <tr>
            <th>Type</th>
            <th>Details</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($model_spec_list as $val){?>
        <tr>
            <td style="">
                <input type="hidden" name="specification_type_name[]" value="<?php echo @$val['specification_type_name']?$val['specification_type_name']:@$val['spec_title'];?>">
                <?php echo @$val['specification_type_name']?$val['specification_type_name']:@$val['spec_title'];?>
            </td>
            <td><input type="text" class="form-control" name="specification_details[]" value="<?php echo @$val['specification_details']?$val['specification_details']:$val['spec_details'];?>"></td>
        </tr>  
        <?php }?>

    </tbody>
</table>
<div class="row"></div>
<button class="add_field_button btn btn-info">Add Other</button>
<div class="row"></div>
<br>
<div class="input_fields_wrap">
</div>


<script>
     $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID

        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="row del">\n\
                                    <div class="col-lg-5">\n\
                                    <input class="form-control" type="text" placeholder="Specification Type" name="other_specification_type_name[]"/>\n\
                                </div>\n\
\n\                             <div class="col-lg-5">\n\
                                    <textarea class="form-control" placeholder="Specification Details" name="other_specification_details[]"/></textarea>\n\
                                </div>\n\
\n\<div class="col-lg-2">\n\
                                    <a href="#" class="remove_field">Remove</a>\n\
                                </div>\n\
</div><br>'); //add input box
            }
        });

        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').parent('div').remove(); x--;
        })
    });
</script>