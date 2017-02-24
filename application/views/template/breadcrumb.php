<div class="custom_breadcrumb">
    <div class="cb_details">
        <span class="breadcrumb_link">
            <?php 
            if(isset($breadcrumb))
            {
                foreach ($breadcrumb as $bc)
                {
                    echo "<a href='".$bc['url']."'>".$bc['title']."</a>";
                }
            }
            else
            {
                echo "<a href='".base_url()."'>Home</a>";
            }
                
            ?>
<!--            <a href="">Home</a>
            <a href="">link 1</a>
            <a href="">link 1</a>
            <a href="">link 1</a>-->
        </span>
    </div>
    <div class="cb_button">
        <span class=""><img style="width: 18px;" src="<?php echo base_url().'images/breadcrumb.png'; ?>"></span></div>
</div>
<style>
    .custom_breadcrumb{
        position: fixed;
        top: 100px;
        left: 0;
        width: auto;
        overflow: hidden;
        background: #286090 none repeat scroll 0 0;
        border-bottom-right-radius: 16px;
        border-top-right-radius: 16px;
    }
    .cb_details{
        float: left;
        width: auto;
        display: none;
    }
    .cb_button{
        float: left;
        width: auto;
        cursor: pointer
    }
    .breadcrumb_link a{
        color: #fff;
    }
</style>
<script>
    $(document).ready(function(){
        $('.custom_breadcrumb').hover(function(){
            $('.cb_details').toggle({left:'100px'});
        });
    });
    
</script>