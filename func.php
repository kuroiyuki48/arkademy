<?php
$con = mysqli_connect('localhost', 'root', '', 'arkademy') or die('Error Database');


if($_POST['submit'] == 'insert') {
  insert();
} elseif($_POST['submit'] == 'show') {
  show();
}  elseif($_POST['submit'] == 'update') {
  update();
} elseif($_POST['submit'] == 'delete') {
  delete();
} elseif($_POST['submit'] == 'ajax') {
  ajax();
} else {
  echo "<script>alert('tidak ada perintah yang dijalankan);window.href='index.html';</script>";
}

function show(){
  global $con;
  $id = $_POST['id'];
  $select = mysqli_query($con, "SELECT * FROM produk WHERE id = '$id'");
  $data = mysqli_fetch_array($select);
  echo json_encode($data);
}

function insert(){
  global $con;
  $nama = $_POST['nama_produk'];
  $keterangan = $_POST['keterangan'];
  $harga = $_POST['harga'];
  $jumlah = $_POST['jumlah'];
  $insert = mysqli_query($con, "INSERT INTO produk VALUES(null, '$nama', '$keterangan', '$harga', '$jumlah', null, null)");
  if($insert){
    echo "<script>alert('$nama Berhasil Ditambahkan');location.href='index.php'</script>";
  } else {
    echo "<script>alert('$nama Gagal Ditambahkan');location.href='index.php'</script>";
  }
}

function update(){
  global $con;
  $id = $_POST['id'];
  $nama = $_POST['nama_produk'];
  $keterangan = $_POST['keterangan'];
  $harga = $_POST['harga'];
  $jumlah = $_POST['jumlah'];
  $update = mysqli_query($con, "UPDATE produk SET nama_produk='$nama', keterangan='$keterangan', harga='$harga', jumlah='$jumlah' WHERE id = '$id'");
  if($update){
    echo "<script>alert('$nama Berhasil Diupdate');location.href='index.php'</script>";
  } else {
    echo "<script>alert('$nama Gagal Diupdate');location.href='index.php'</script>";
  }
}

function delete(){
  global $con;
  $id = $_POST['id'];
  $nama = $_POST['nama_produk'];
  $delete = mysqli_query($con, "DELETE FROM produk WHERE id = '$id'");
  if($delete){
    echo "<script>alert('$nama Berhasil Dihapus');location.href='index.php'</script>";
  } else {
    echo "<script>alert('$nama Gagal Dihapus');location.href='index.php'</script>";
  }
}

function ajax(){
  global $con;
  $search = $_POST['search']['value'];
  $limit = $_POST['length'];
  $start = $_POST['start'];
  $sql = mysqli_query($con, "SELECT id FROM produk");
  $sql_count = mysqli_num_rows($sql);
  $query = "SELECT * FROM produk WHERE (nama_produk LIKE '%".$search."%' OR keterangan LIKE '%".$search."%' OR harga LIKE '%".$search."%' OR jumlah LIKE '%".$search."%')";
  $order_index = $_POST['order'][0]['column'];
  $order_field = $_POST['columns'][$order_index]['data'];
  $order_ascdesc = $_POST['order'][0]['dir'];
  $order = " ORDER BY ".$order_field." ".$order_ascdesc;
  $sql_data = mysqli_query($con, $query.$order." LIMIT ".$limit." OFFSET ".$start);
  $sql_filter = mysqli_query($con, $query);
  $sql_filter_count = mysqli_num_rows($sql_filter);
  $data = mysqli_fetch_all($sql_data, MYSQLI_ASSOC);
  $callback = array(
    'draw'=>$_POST['draw'],
    'recordsTotal'=>$sql_count,
    'recordsFiltered'=>$sql_filter_count,
    'data'=>$data
  );
  header('Content-Type: application/json');
  echo json_encode($callback);
}

?>