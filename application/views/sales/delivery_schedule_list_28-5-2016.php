<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <i class="fa fa-search"></i>
                    Search Criteria
                </h4>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url('sales/delivery_schedule')?>" method="post">
                    <div class="col-lg-5">
                        <div class="form-group">
                            <div class="col-lg-6 ">
                                <label for="" class="control-label"> From Date</label>
                                <input name="search_from_date" class="form-control left" type="date" value="" placeholder="From">
                            </div>
                            <div class="col-lg-6 ">
                                <label for="" class="control-label">To Date</label>
                                <input name="search_to_date" class="form-control col-lg-6 right" type="date" value="" placeholder="To">
                            </div>
                            
                            
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label for="" class="control-label">Location</label>
                            <select class="form-control" name="loction">
                                <option value="">Select</option>
                                <option value="1">Dhanmodi</option>
                                <option value="2">Bonani</option>
                                <option value="3">Gulshan</option>
                                <option value="4">Uttra</option>
                                <option value="5">Gazipur</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2" style="margin-top: 20px;">
                        <label for="" class="control-label"></label>
                        <input type="submit" name="submit" class="btn btn-primary pull-right" value="Search">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    Delivery Schedule List &nbsp;&nbsp;&nbsp;  <span style="font-size: 15px">(Drag and drop to rearrange the schedule)</span>
                </h4>
            </div>
            <div class="panel-body">
                <table class="table" id="sort">
                    <thead>
                        <tr>
                            <th class="index">Sl#</th>
                            <th>Sales Order No</th>
                            <th>Order Date</th>
                            <th>Delivery Date</th>
                            <th>Customer Name</th>
                            <th>Contact No</th>
                            <th>Order Value</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $sl=1; foreach ($delivery_list as $valu){?>
                        <tr style="cursor: move">
                            <td class="index"><?php echo $sl;?></td>
                            <th><?php echo $valu['order_no'];?></th>
                            <th><?php echo $valu['order_date'];?></th>
                            <th><?php echo $valu['delivery_date'];?></th>
                            <th><?php echo $valu['name'];?></th>
                            <th><?php echo $valu['contact_no'];?></th>
                            <th><?php echo $valu['order_val'];?></th>
                            <th><?php echo $valu['location'];?></th>
                            
                        </tr>
                        <?php $sl++;} ?>
<!--                        <tr style="cursor: move">
                            <td class="index">1</td>
                            <th>1012</th>
                            <th>ABC</th>
                            <th>0198</th>
                            <th>12500</th>
                            <th>Gulshan</th>
                        </tr>
                        <tr style="cursor: move">
                            <td class="index">2</td>
                            <th>1013</th>
                            <th>ADV</th>
                            <th>0155</th>
                            <th>1000</th>
                            <th>Banani</th>
                        </tr>-->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    var fixHelperModified = function(e, tr) {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index) {
            $(this).width($originals.eq(index).width())
        });
        return $helper;
    },
    updateIndex = function(e, ui) {
        $('td.index', ui.item.parent()).each(function (i) {
            $(this).html(i + 1);
        });
    };

    $("#sort tbody").sortable({
        helper: fixHelperModified,
        stop: updateIndex
    }).disableSelection();
</script>
