<div class="scrolltable">
        <table class="table">
            <thead>
                <tr>
                    <th>#Sl</th>
                    <th>Name</th>
                    <th>URL</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; 
                foreach ($supporting_doc_list as $val){
                    ?>
                    <tr>
                        <td><?php echo $i;?></td>
                        <td><?php echo $val['purchase_supporting_doc_name'];?></td>
                        <td><a target="_blank" href='<?php echo base_url().$val['purchase_supporting_doc_url'];?>' > <?php echo $val['purchase_supporting_doc_url'];?> </a></td>
                        <td>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_doc" aria-hidden="true" puchase_supporting_doc_id="<?php echo $val['puchase_supporting_doc_id'];?>" ></i>
                        </td>
                    </tr>
                    
                <?php $i++;} ?>
            </tbody>
        </table>

    </div>

