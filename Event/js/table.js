/**
 * Created by LeiZhang on 20/04/2016.
 */
$(document).ready(function () {
    // $('#event').DataTable();
    var table = $('#event').DataTable();

    $('#event tfoot th').each(function(){
        var title = $('#event thead th').eq($(this).index()).text();
        $(this).html('<input type="text" placeholder="Search '+title+'"/>');
    });

    table.columns().eq(0).each(function(colIdx){
        $('input', table.column(colIdx).footer()).on( 'keyup change', function()  {
            table
                .column(colIdx)
                .search(this.value)
                .draw();
        });
    });

     });


