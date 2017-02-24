<link href="<?=base_url()?>js/zTree/css/metroStyle/metroStyle.css" rel="stylesheet" type="text/css"  />
<link href="<?=base_url()?>js/zTree/css/zTreeStyle/zTreeStyle.css" rel="stylesheet" type="text/css"  />
<link href="<?=base_url()?>js/zTree/css/demo.css" rel="stylesheet" type="text/css"  />
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Create Accounts
            </div>
            <div class="panel-body">
                <div class="col-lg-3">
                    <label><strong>Chart of Account</strong></label>
                    <div class="form-group">
                        <label>Search</label>
                        <input class="form-control" id="search_acc" placeholder="Search Account Name" />
                    </div>
                    <div class="zTreeDemoBackground left">
                        <ul id="treeDemo" class="ztree"><li>Loading...</li></ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <?php
                    if(isset($msg)){
                        echo '<div class="alert alert-info msg">'.$msg.'</div>';?>
                    <script>$('.msg').delay(2000).fadeOut(500);</script>
                    <?php
                    }
                    ?>
                    <form action="" method="post" id="acc_head_form">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="parent_prefix">Account Code <span class="text-small">(After parent code)</span><sup>*</sup></label>
                                <input oninput="this.setCustomValidity('')" oninvalid="this.setCustomValidity('Please input Chart Of Accounts number')" name="AccountCode" class="form-control" type="text" id="parent_prefix" value="" pattern=".{4,100}" required />
                            </div>
                            <div class="form-group">
                                <label for="AccountDescription">Account Description</label>
                                <textarea name="AccountDescription" id="AccountDescription" class="form-control" rows="2"><?php echo @$edit_acc_head->AccountDescription; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Default Currency</label>
                                <select name="DefaultCurrency">
                                    <option value="BDT">BDT</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="TrackEmployee">Track Employee</label><br/>
                                <input type="hidden" name="TrackEmployee" value="0" />
                                <input id="TrackEmployee" type="checkbox" name="TrackEmployee" value="1" /> 
                            </div>
<!--                            <div class="form-group">
                                <label for="track_lc">Track LC</label><br/>
                                <input type="hidden" name="track_lc" value="0" />
                                <input id="track_lc" type="checkbox" name="track_lc" value="1" /> 
                            </div>-->
                            <div class="form-group">
                                <label for="TrackAssetItem">Track Asset</label><br/>
                                <input type="hidden" name="TrackAssetItem" value="0" />
                                <input id="TrackAssetItem" type="checkbox" name="TrackAssetItem" value="1" /> 
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label for="AccountName">Account Name<sup>*</sup></label>
                                <input type="text" name="AccountName" id="AccountName" class="form-control" value="<?php echo @$edit_acc_head->AccountName ?>" required/>
                            </div>
<!--                            <div class="form-group">
                                <?php // if(@$edit_acc_head->is_group == 1){$is_group = 'checked';}else{$is_group = '';}?>
                                <label>Is Group?</label><br/>
                                <input type="checkbox" name="is_group" value="1" <?php // echo $is_group; ?>/>
                            </div>-->
                            <div class="form-group">
                                <label for="IsGroup">Is Group?</label><br/>
                                <input type="hidden" name="IsGroup" value="0" />
                                <input id="IsGroup" type="checkbox" name="IsGroup" value="1" /> 
                            </div>
                            <div class="form-group">
                                <label for="TrackAgreement">Track Agreement</label><br/>
                                <input type="hidden" name="TrackAgreement" value="0" />
                                <input id="TrackAgreement" type="checkbox" name="TrackAgreement" value="1" /> 
                            </div>
                            <div class="form-group">
                                <label for="TrackBill">Track Bill</label><br/>
                                <input type="hidden" name="TrackBill" value="0" />
                                <input id="TrackBill" type="checkbox" name="TrackBill" value="1" />
                            </div>
                            <div class="form-group">
                                <label for="TrackParty">Track Party</label><br/>
                                <input type="hidden" name="TrackParty" value="0" />
                                <input id="TrackParty" type="checkbox" name="TrackParty" value="1" />
                            </div>
                            <div class="form-group">
                                <label for="TrackTeller">Track Teller</label><br/>
                                <input type="hidden" name="TrackTeller" value="0" />
                                <input id="TrackTeller" type="checkbox" name="TrackTeller" value="1" />
                            </div>
                            
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label>Parent Account<sup>*</sup></label>
                                <input type="hidden" id="parent_prefix_temp" value="<?php echo @$parent_code; ?>">   
                                <input type="text" name="ParentID" id="ParentID" class="form-control" value="<?php echo @$parent_name_code; ?>" readonly required/>
                            </div>
                            <div class="form-group">
                                <label>Account Type</label>
                                <?php echo account_type(NULL,array('id'=>'acc_type')); ?>
                            </div>
                            <div class="form-group">
                                <label for="TrackCustomer">Track Customer</label><br/>
                                <input type="hidden" name="TrackCustomer" value="0" />
                                <input id="TrackCustomer" type="checkbox" name="TrackCustomer" value="1" />
                            </div>
                            <div class="form-group">
                                <label for="TrackCostCenter">Track Cost Center</label><br/>
                                <input type="hidden" name="TrackCostCenter" value="0" />
                                <input id="TrackCostCenter" type="checkbox" name="TrackCostCenter" value="1" /> 
                            </div>
                            <div class="form-group">
                                <label for="TrackBank">Track Bank</label><br/>
                                <input type="hidden" name="TrackBank" value="0" />
                                <input id="TrackBank" type="checkbox" name="TrackBank" value="1" /> 
                            </div>
                            <div class="form-group">
                                <label for="TrackInventoryItem">Track Inventory Item</label><br/>
                                <input type="hidden" name="TrackInventoryItem" value="0" />
                                <input id="TrackInventoryItem" type="checkbox" name="TrackInventoryItem" value="1" /> 
                            </div>
<!--                            <div class="form-group">
                                <label for="track_transaction">Track Transaction</label><br/>
                                <input type="hidden" name="track_transaction" value="0" />
                                <input id="track_transaction" type="checkbox" name="track_transaction" value="1" /> 
                            </div>-->
                        </div>
                        <div class="col-lg-12">
                            <button id="acc_save" type="submit" class="btn btn-primary">Save</button>
                            <button id="acc_edit" type="button" class="btn btn-info">Edit</button>
                            <button id="acc_new" type="button" class="btn btn-success">New</button>
                            <button id="acc_cancel" type="button" class="btn btn-warning">Cancel</button>
                            <button id="acc_del" type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="acc_pr_type hidden"></div>
</div>
<!--------------------------- ZTree ------------------------------->
<script src="<?=base_url()?>js/zTree/js/jquery.ztree.all-3.5.min.js" type="text/javascript"></script>
<script src="<?=base_url()?>js/zTree/js/jquery.ztree.core-3.5.min.js" type="text/javascript"></script>
<SCRIPT type="text/javascript">
    $(document).ready(function(){
        $(':checkbox').checkboxpicker();
        $("#acc_head_form :input").prop("disabled", true);
        $('#acc_new').prop("disabled", false);
        
        // Edit Button Click Action
        $('#acc_edit').click(function(){
            $("#acc_head_form :input").prop("disabled", false);
            $('#parent_prefix').prop('readonly',true);
            $("#acc_head_form").append('<input id="edit_acc_head" type="hidden" name="edit_acc_head" value="1">');
        });
        
        // New Button Click Action
        $('#acc_new').click(function(){
            if($('#ParentID').val() == '' && $('.acc_pr_type').html() != 'parent' ) return alert('Please select a account first');
            $("#acc_head_form :input").prop("disabled", false);
            //$('#acc_new').prop("disabled", false);
            $("#edit_acc_head").remove();
            $('#acc_edit').prop("disabled", true);
            $('#acc_del').prop("disabled", true);
            $('#parent_prefix').prop('readonly',false);
            $('#acc_head_form')[0].reset();
            $('#AccountDescription').text('');
            $('#parent_prefix').val($('#parent_prefix_temp').val());
            var treeObject = $.fn.zTree.getZTreeObj("treeDemo");
            var treeNode = treeObject.getSelectedNodes();
            $('#ParentID').val(treeNode[0].id);
            $('#acc_type').val(treeNode[0].AccountType);
            //console.log(treeNode);
            $('select').select2();
        });
        
        // Delete button click action
        $('#acc_del').click(function(){
            var r = confirm("Do you want to delete this account? This action can't be undone.");
            if(r){
                var treeObject = $.fn.zTree.getZTreeObj("treeDemo");
                var treeNode = treeObject.getSelectedNodes();
                var AccountCode = treeNode[0].id;
                $.ajax({
                    url:'<?php echo base_url();?>accounts_configuration/delete_acc_head',
                    type: 'POST',
                    data:{AccountCode:AccountCode},
                    success:function(){
                        location.reload();
                    }
                });
            }
        });
        
        // Cancel button click action
        $('#acc_cancel').click(function(){
            $("#acc_head_form :input").prop("disabled", true);
            $("#edit_acc_head").remove();
            $('#acc_new').prop("disabled", false);
            $('#acc_edit').prop("disabled", false);
            $('#acc_del').prop("disabled", false);
        });
        
        $('#parent_prefix').val(<?php echo @$edit_acc_head->acc_head_number; ?>);
    });
    $('#acc_title').on('change', function(){
        if($(this).val()){
            $('#acc_save').removeAttr('disabled');
        }
    });
    $('input#parent_prefix').keyup(function(){
        var parent_code_temp = $('#parent_prefix_temp').val();
        if(!(this.value.match('^' + parent_code_temp))){
             this.value = parent_code_temp;}        
    });
    $('input#parent_prefix').blur(function(){
        var parent_code_temp = $('#parent_prefix_temp').val();
        if(!(this.value.match('^' + parent_code_temp))){
             this.value = parent_code_temp;}        
    });

    var setting = {
        view: {showIcon: false},
        data: {
            key: {title:"name"},
            simpleData: {enable: true}
        },
        callback: {
            onClick: onClick
        }
    };
    var log, className = "dark";
    function beforeClick(treeId, treeNode, clickFlag) {
        className = (className === "dark" ? "":"dark");
        showLog("[ "+getTime()+" beforeClick ]&nbsp;&nbsp;" + treeNode.id );
        return (treeNode.click != false);
    }
    function onClick(event, treeId, treeNode, clickFlag) {
        $('#acc_edit').prop("disabled", false);
        $('#acc_del').prop("disabled", false);
        $('#ParentID').val(treeNode.pId);
        $('#parent_prefix_temp').val(treeNode.id);
        $('#parent_prefix').val(treeNode.id);
        $('#AccountName').val(treeNode.AccountName);
        if(treeNode.pId == null)$('.acc_pr_type').html('parent');else $('.acc_pr_type').html('child');
        $('#AccountDescription').text(treeNode.AccountDescription);
        $('#acc_type').select2("val", treeNode.AccountType);
        $('#TrackAgreement').prop('checked',value_to_bool(treeNode.TrackAgreement));
        $('#TrackEmployee').prop('checked',value_to_bool(treeNode.TrackEmployee));
        $('#TrackCustomer').prop('checked',value_to_bool(treeNode.TrackCustomer));
        $('#TrackCostCenter').prop('checked',value_to_bool(treeNode.TrackCostCenter));
        $('#TrackAssetItem').prop('checked',value_to_bool(treeNode.TrackAssetItem));
        $('#TrackBill').prop('checked',value_to_bool(treeNode.TrackBill));
        $('#TrackParty').prop('checked',value_to_bool(treeNode.TrackParty));
        $('#TrackBank').prop('checked',value_to_bool(treeNode.TrackBank));
        $('#TrackInventoryItem').prop('checked',value_to_bool(treeNode.TrackInventoryItem));
        $('#TrackTeller').prop('checked',value_to_bool(treeNode.TrackTeller));
//        $('#track_transaction').prop('checked',value_to_bool(treeNode.track_transaction));
        //$('#track_agreement').prop('checked',value_to_bool(treeNode.track_agreement));
        $('#IsGroup').prop('checked',value_to_bool(treeNode.IsGroup));
        //alert(treeNode.acc_head_name);
        //console.log(treeNode.acc_head_id);
    }
    function value_to_bool(val){
        if(val == 1) return true;else return false;
    }
    function showLog(str) {
        if (!log) log = $("#log");
        log.append("<li class='"+className+"'>"+str+"</li>");
        if(log.children("li").length > 8) {
            log.get(0).removeChild(log.children("li")[0]);
        }
    }
    function showIconForTree(treeId, treeNode) {
        return !treeNode.isParent;
    };
    function getTime() {
        var now= new Date(),
            h=now.getHours(),
            m=now.getMinutes(),
            s=now.getSeconds();
        return (h+":"+m+":"+s);
    }

    $(document).ready(function(){
        var zNodes = '';
        var treeObj;
        $.ajax({
            url:'<?php echo base_url();?>accounts_configuration/get_acc_head',
            type: 'POST',
            success:function(data){
                zNodes = $.parseJSON(data);
                treeObj = $.fn.zTree.init($("#treeDemo"), setting, zNodes);
                treeObj.expandAll(true);
            }
        });
        
        // Search Function 
        // var treeObj = $.fn.zTree.getZTreeObj("treeDemo");
        $(document).on('input','#search_acc',function(){
            var nodes = treeObj.getNodesByParamFuzzy("name", $(this).val(), null);
            //alert(JSON.stringify(nodes));
            treeObj.refresh();
            for( var i=0, l=nodes.length; i<l; i++) {
                treeObj.selectNode(nodes[i],true);
                if(l == 1){
                    $('#ParentID').val(nodes[i].name);
                    $('#parent_prefix_temp').val(nodes[i].id);
                    $('#parent_prefix').val(nodes[i].id);
                }
            }
            $(this).focus();
        });
    });
    //-->
</SCRIPT>