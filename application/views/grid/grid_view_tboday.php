<table class="table table-striped table-bordered table-hover dataTable no-footer" id="grid_list_table">
    <thead>
        <tr>
            <?php
                foreach ($grid_list_theads as $thead)
                { ?>

                    <th><?php echo $thead; ?></th>

                <?php }
            ?>
        </tr>
    </thead>
    <tbody class="">
        <?php
            $sl = 1;
            foreach ($grid_list_tbody as $k=>$v)
            { ?>
                <tr>
                    <?php
                        echo "<td>".$sl."</td>";
                        foreach ($v as $key=>$kv)
                        {
                            echo "<td>".$v[$key]."</td>";
                        }
                    ?>
                </tr>
            <?php $sl++; }
        ?>
    </tbody>
</table> 

<script>
    $(document).ready(function () {
        var export_name = $('.export_name').val();
        $('#grid_list_table').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    title: export_name
                },
                {
                    extend: 'pdf',
                    title: export_name
                },
                {
                    extend: 'print',
                    title: export_name
                }
            ]
        } );
    });
</script>

</script>
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css">
<!--<script src="//code.jquery.com/jquery-1.12.3.js"></script>-->
<script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="//cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
<script src="//cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
