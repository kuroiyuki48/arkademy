<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>repl.it</title>
  <!-- booststrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
  <!-- font awesome -->
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <!-- datatable -->
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap.min.css">
  <!-- custome -->
  <link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
  <div class="container">
    <div class="card table-responsive">
      <div class="card-body">
        <div class="card-title">
          <div class="pull-right"><a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#ModalAdd"><span class="fa fa-plus"></span></a></div>
          <h1>Inventory System</h1>
        </div>
        <hr>
        <div id="reload">
          <table class="table table-bordered" id="table" width="100%">
            <thead>
              <tr>
                <th width="10px">No</th>
                <th>Nama Produk</th>
                <th>Keterangan</th>
                <th>Jumlah</th>
                <th>Harga</th>
                <th width="150px" style="text-align: center">#</th>
              </tr>
            </thead>
            <tbody id="show">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- MODAL ADD -->
  <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Tambah Produk</h3>
        </div>
        <form class="form-horizontal" action="func.php" method="POST">
          <div class="modal-body">

            <div class="form-group">
              <label class="control-label col-xs-3">Nama Produk</label>
              <div class="col-xs-9">
                <input name="nama_produk" id="nama_produk" class="form-control" type="text" placeholder="Nama Produk" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-xs-3">Keterangan</label>
              <div class="col-xs-9">
                <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-xs-3">Jumlah</label>
              <div class="col-xs-9">
                <input name="jumlah" id="jumlah" class="form-control" type="number" min="1" placeholder="0" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-xs-3">Harga</label>
              <div class="col-xs-9">
                <input name="harga" id="harga" class="form-control" type="number" min="0" placeholder="Harga" required>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-success" type="submit" name="submit" value="insert" id="btn_simpan">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--END MODAL ADD-->

  <!-- MODAL EDIT -->
  <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="largeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Edit Produk</h3>
        </div>
        <form class="form-horizontal" action="func.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="id">
            <div class="form-group">
              <label class="control-label col-xs-3">Nama Produk</label>
              <div class="col-xs-9">
                <input name="nama_produk" id="nama_produk" class="form-control" type="text" placeholder="Nama Produk" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-xs-3">Keterangan</label>
              <div class="col-xs-9">
                <input name="keterangan" id="keterangan" class="form-control" type="text" placeholder="Keterangan" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-xs-3">Jumlah</label>
              <div class="col-xs-9">
                <input name="jumlah" id="jumlah" class="form-control" type="number" min="1" placeholder="0" required>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-xs-3">Harga</label>
              <div class="col-xs-9">
                <input name="harga" id="harga" class="form-control" type="number" min="0" placeholder="Harga" required>
              </div>
            </div>

          </div>

          <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Tutup</button>
            <button class="btn btn-success" type="submit" name="submit" value="update" id="btn_update">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--END MODAL EDIT-->

  <!--MODAL HAPUS-->
  <div class="modal fade" id="ModalHapus" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
          <h4 class="modal-title" id="myModalLabel">Hapus Produk</h4>
        </div>
        <form class="form-horizontal" action="func.php" method="POST">
          <div class="modal-body">

            <input type="hidden" name="id">
            <input type="hidden" name="nama_produk">
            <div class="alert alert-warning"><p>Apakah Anda yakin mau menghapus Produk ini?</p></div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
            <button class="btn_hapus btn btn-danger" type="submit" name="submit" value="delete" id="btn_hapus">Ya</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--END MODAL HAPUS-->
</body>

<!-- Datatables -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap.min.js"></script>

<!-- bootstrap -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- custome -->
<script src="script.js"></script>
</html>