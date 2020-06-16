<?php
$con = mysqli_connect('localhost', 'root', '', 'arkademy') or die('Error Database');

if($_POST['submit'] == 'insert') {
  insert();
} elseif($_POST['submit'] == 'update') {
  update();
} elseif($_POST['submit'] == 'delete') {
  delete();
} elseif($_POST['submit'] == 'ajax') {
  ajax();
} else {
  echo "<script>alert('tidak ada perintah yang dijalankan);window.href='index.html';</script>";
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