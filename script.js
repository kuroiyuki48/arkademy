
var tabel = null;
$(document).ready(function() {
    tabel = $('#table').DataTable({
        "processing": true,
        "serverSide": true,
        "responsive": true,
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
        { "data": "harga", "render": $.fn.DataTable.render.number('.',',', 2) }, 
        { "render": function ( data, type, row ) { 
            var action = "<div class='text-center'><a href='' class='btn btn-info btn-sm edit' data='"+ row['id'] +"'><i class='fa fa-pencil'></i></a> <a href='' class='btn btn-danger btn-sm delete' data='"+ row['id'] +"'><i class='fa fa-trash'></i></a><div>";
            return action;
        }
    },
    ],
});
});

$('#show').on('click','.edit',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "POST",
        url  : "func.php",
        dataType : "JSON",
        data : {
            id: id,
            submit: "show",
        },
        success: function(data){
            $.each(data, function(nama_produk){
                $('#ModalEdit').modal('show');
                $('[name="id"]').val(data.id);
                $('[name="nama_produk"]').val(data.nama_produk);
                $('[name="keterangan"]').val(data.keterangan);
                $('[name="harga"]').val(data.harga);
                $('[name="jumlah"]').val(data.jumlah);
            });
        }
    });
    return false;
});

$('#show').on('click','.delete',function(){
    var id = $(this).attr('data');
    $.ajax({
        type : "POST",
        url  : "func.php",
        dataType : "JSON",
        data : {
            id: id,
            submit: "show",
        },
        success: function(data){
            $.each(data, function(nama_produk){
                $('#ModalHapus').modal('show');
                $('[name="id"]').val(data.id);
                $('[name="nama_produk"]').val(data.nama_produk);
            });
        }
    });
    return false;
});