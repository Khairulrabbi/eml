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
                        <td><?php echo $val['sales_supporting_doc_name'];?></td>
                        <td><?php echo $val['sales_supporting_doc_url'];?></td>
                        <td>
                            <i style=" cursor: pointer;text-align: center;" class="fa fa-times delete_doc" aria-hidden="true" sales_supporting_doc_id="<?php echo $val['sales_supporting_doc_id'];?>" ></i>
                        </td>
                    </tr>
                    
                <?php $i++;} ?>
            </tbody>
        </table>

    </div>

