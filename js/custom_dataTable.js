/* 
 * Created By Md. Riad Hossain at 15.02.2015
 */
    $('#dataTables-example').dataTable({
        responsive: true,
            "aaSorting": []
        });
        $('#mytable2').dataTable({
            bFilter: false,
            bInfo: false,
            bPaginate: false,
            bSort: false,
            sScrollY: '350px',
            sScrollXInner: "98.5%"
        });
    // add text input to each header cell
    $('#master thead tr#filterrow th.search').each( function () {
        var title = $('#master thead th').eq( $(this).index() ).text();
        $(this).html( title+'<br/><input type="text" class="form-control" onclick="stopPropagation(event);" placeholder="Search '+title+'" />' );
    } );
    // Apply the filter
    $("#master thead input").on( 'keyup change', function () {
        table
            .column( $(this).parent().index()+':visible' )
            .search( this.value )
            .draw();
    } );
    //Creating dynamic option for datatable
    //alert($('#master').data('pdf'));
    var pdf_obj,xl_obj,csv_obj,print_obj,obj=[];
    if($('#master').data('pdf') == 1){
    pdf_obj = {'sExtends':'pdf',
                "sFileName": $('#master').data('name')+".pdf",
                "sTitle": $('#master').data('name'),
             'mColumns':function ( dtSettings ) {
                       var api = new $.fn.dataTable.Api( dtSettings );
                       return api.columns(":not(:last)").indexes().toArray();
                  } 
            };
         obj.push(pdf_obj);
        }
    if($('#master').data('xl') == 1){
        xl_obj = {'sExtends':'xls',
                "sFileName": $('#master').data('name')+".xls",
                'mColumns':function ( dtSettings ) {
                          var api = new $.fn.dataTable.Api( dtSettings );
                          return api.columns(":not(:last)").indexes().toArray();
                     }
               };
               obj.push(xl_obj);
    }
    if($('#master').data('csv') == 1){
        csv_obj = {'sExtends':'csv',
                "sFileName": $('#master').data('name')+".csv",
                'mColumns':function ( dtSettings ) {
                          var api = new $.fn.dataTable.Api( dtSettings );
                          return api.columns(":not(:last)").indexes().toArray();
                     }
               };
               obj.push(csv_obj);
    }
    if($('#master').data('printing') == 1){
        print_obj = {"sExtends": "print",
                "sMessage": '<div class="datatables-print-msg">' +
                '<a class="btn close-print" href="#">Close print view</a>' +
                '</div>',
                'mColumns':function ( dtSettings ) {
                          var api = new $.fn.dataTable.Api( dtSettings );
                          return api.columns(":not(:last)").indexes().toArray();
                     }
               };
               obj.push(print_obj);
    }
    //
    var table = $('#master').DataTable({
        responsive: true,/*
        aLengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        iDisplayLength: 25,*/
        "dom": 'T<"clear">lfrtip',
        "oTableTools":{
        'sSwfPath': $('#master').data('url')+"js/plugins/dataTables/swf/copy_csv_xls_pdf.swf",
        'aButtons':obj
        }
    });

    //For getting a datatable with checkbox at first column
    $('#dataTables-checkbox').dataTable({
            "aaSorting": [],
            "aoColumnDefs": [
      { "sTitle": "<input type='checkbox' id='selectAll'/>", "aTargets": [ 0 ] },
      { 'bSortable': false, 'aTargets': [ 0 ] }
    ]
        });