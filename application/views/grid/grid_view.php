
<div id="wrapper" class="toggled">   
    
    <?php    
        if($grid_list_info->search_panel)
        { 
            $this->load->view("grid/grid_view_search_area");
        }        
    ?>
    
    <div id="page-content-wrapper" style="padding:0;">
        <div class="container-fluid" style="padding:0;">
            <div class="panel panel-default" style="padding:0;">
                <div class="panel-heading"><?php echo $grid_title; ?></div>
                <input type="hidden" class="export_name" value="<?php echo $export_name; ?>">
                <div class="panel-body show_search_data">
                    <?php
                        $this->load->view("grid/grid_view_tboday");
                    ?>                    
                </div>
            </div>
            
        </div>
    </div>

</div>

<script>
    $('#top_search').click(function (e) {
        $('#search_by').slideToggle();
    });

    $("#left_search").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    
    
//    for grid view search area
    $(document).on('click', '.moresearchfieldpanel', function () {
       $(this).next().show();
       $('body').click(function () {
            $('.moresearchfield').hide();
        });
    });
    $(document).on('click', '.moresearchfield li', function () {
        var thisClick = $(this);
        var panel_id = $(this).attr('search_panel_id');
        var column = $(this).attr('column');
        var panel_details_id = $(this).attr('panel_details_id');
        var title_name = $(this).attr('title_name');
        count = 0;
        $( ".custom_label" ).each(function( index ) {
            var tn = $(this).text();
            if(tn == title_name)
            {
                count++;
            }            
        });
        if(count < 1)
        {
            $.ajax({
                url: base_url+'common_grid/more_search_panel',
                type: 'POST',
                data: {panel_id: panel_id, column: column,panel_details_id:panel_details_id},
                success: function (data) {
                    $('.appendSearchPanel').append(data);
                    $('.appendSearchPanel').find('select').select2();
                }
            });
        }        
    });
    
    
    
    $(document).on('click', '.search_submit', function () {
        $.ajax({
            url: base_url+'common_grid/grid_list_search',
            type: 'POST',
            data: $('#grid_list_frm').serialize(),
            success: function (data) {
                $('.show_search_data').html(data);
            }
        });        
    });
</script>


<style>
    #wrapper {
    padding-left: 0;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled {
    padding-left: 250px;
}

#sidebar-wrapper {
    z-index: 1000;
    position: absolute;
    left: 260px;
    width: 0;
    height: 100%;
    margin-left: -250px;
    overflow-y: auto;
    -webkit-transition: all 0.5s ease;
    -moz-transition: all 0.5s ease;
    -o-transition: all 0.5s ease;
    transition: all 0.5s ease;
}

#wrapper.toggled #sidebar-wrapper {
    width: 250px;
}

#page-content-wrapper {
    width: 100%;
    position: absolute;
    padding: 15px;
}

#wrapper.toggled #page-content-wrapper {
    position: absolute;
    margin-right: -250px;
}


@media(min-width:768px) {
    #wrapper {
        padding-left: 260px;
    }

    #wrapper.toggled {
        padding-left: 0;
    }

    #sidebar-wrapper {
        width: 250px;
    }

    #wrapper.toggled #sidebar-wrapper {
        width: 0;
    }

    #page-content-wrapper {
        padding: 20px;
        position: relative;
    }

    #wrapper.toggled #page-content-wrapper {
        position: relative;
        margin-right: 0;
    }
}


/*for grid view search area*/
.moresearchfield {
    display:none;
    background: #ff2666 none repeat scroll 0 0;
    list-style: outside none none;
    padding: 0;
    position: absolute;
    right: 66px;
    border-radius: 4px;
    /*top: 33px;*/
    width: auto;
    z-index: 99;
  }
  .moresearchfield > li {
    cursor: pointer;
    padding: 2px 36px;
  }

  .moresearchfield > li:hover {
    background: #fff none repeat scroll 0 0;
  }
</style>