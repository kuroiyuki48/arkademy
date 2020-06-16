
var tabel = null;
$(document).ready(function() {
    tabel = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
            "ordering": true, 
            "order": [[ 0, 'asc' ]], 
            "ajax":
            {
                "url": "func.php", 
                "type": "POST",
                "data": {
                    "submit" : "ajax"
                }
            },
            "deferRender": true,
            "columns": [
                { "data": "id" }, 
                { "data": "nama_produk" },  
                { "data": "keterangan" },  
                { "data": "jumlah" }, 
                { "render": function ( data, type, row ) {
                    var rupiah = $.fn.dataTable.render.number(',', '.', 2, 'Rp. ');
                           return data + ' ' + row['harga'];
                }
            },
                { "render": function ( data, type, row ) { 
                    var html  = "<a href=''>EDIT</a> | "
                    html += "<a href=''>DELETE</a>"
                    return html
                }
            },
        ],
    });
});