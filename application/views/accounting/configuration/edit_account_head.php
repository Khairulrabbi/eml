<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                Edit Account Head
            </div>
            <div class="panel-body">
                <div class="col-lg-6">
                    <label>Head of Account</label>
                    <div class="zTreeDemoBackground left">
                        <ul id="treeDemo" class="ztree"></ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="acc_title">Account Name</label>
                            <input type="text" name="acc_head_name" id="acc_title" class="form-control" value="<?php echo $edit_acc_head->acc_head_name; ?>"
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" name="is_group" value="1"> Is Group?</label>
                        </div>
                        <div class="form-group">
                            <label>Parent Account</label>
                            <input type="text" name="parent_id" id="parent_acc_id" class="form-control" readonly="">
                        </div>
                        <div class="form-group">
                            <label for="acc_desc">Account Description</label>
                            <textarea name="acc_desc" id="acc_desc" class="form-control" rows="3"><?php echo $edit_acc_head->acc_desc;?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Default Currency</label>
                            <select name="default_currency">
                                <option value="BDT">BDT</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tag Acc</label>
                            <?php
                            foreach($tag_list as $tag){
                                echo '<div class="checkbox">'
                                . '<label>'
                                . '<input type="checkbox" name="acc_tag_id[]" value="'.$tag['acc_tag_id'].'"/> '.$tag['acc_tag_name'].''
                                . '</label>'
                                . '</div>';
                            }
                            ?>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    
</div>
<SCRIPT type="text/javascript">
    <!--
    var setting = {
        view: {
                showIcon: showIconForTree
        },
        data: {
            key: {
                title:"t"
            },
            simpleData: {
                enable: true
            }
        },
        callback: {
            //beforeClick: beforeClick,
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
        $('#parent_acc_id').val(treeNode.id);
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
        var zNodes = ''
        $.ajax({
            url:'accounts_configuration/get_acc_head',
            type: 'POST',
            success:function(data){
                zNodes = $.parseJSON(data);
                $.fn.zTree.init($("#treeDemo"), setting, zNodes);
            }
        });
        //alert(zNodes);

    });
    //-->
</SCRIPT>