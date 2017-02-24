<?php
//debug($model_list,1);
?>
<table class="table">
        <tbody>
            <?php 
            foreach ($model_list as $model){?>
            <tr>
                <td>
                    <!--<input type="hidden" name="" value="<?php //echo $model['product_model_name'];?>">-->
<!--                <input type="checkbox" <?php //echo (@$model_id?($model_id==$model['product_model_id']?'checked':''):'');?>  class="model_select" value="<?php //echo $model['product_model_id'];?>" product_id =<?php //echo $model['product_id'];?> model_name= "<?php //echo $model['product_model_name'];?>" />-->
                <input type="checkbox" <?php echo ($model['product_model_name'] == $modelOrModelId)?"checked":""; ?>  class="model_select" value="<?php echo $model['product_model_id'];?>" product_id =<?php echo $model['product_id'];?> model_name= "<?php echo $model['product_model_name'];?>" />
                </td>
                <td><?php echo $model['product_model_name']?></td>
            </tr>
            <?php }?>
        </tbody>
    </table>
