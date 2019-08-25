<?php
include '../koneksi.php';
$username = $_SESSION['username'];
$kode_barang = $_POST['kodebarang'];
$jumlah = $_POST['jumlah'];

if(isset($_POST['submit']))
{
    $pernah_pesan = 'SELECT count(*) as sudah FROM pesan WHERE username_konsumen="'.$username.'"';
    $result_pernah = $conn->query($pernah_pesan);
    $pernah = $result_pernah->fetch_assoc();
    if ($pernah["sudah"] <> 0){
        $pesan_akhir = 'SELECT status_pesan, kode_pesan FROM pesan WHERE username_konsumen="'.$username.'" ORDER BY kode_pesan DESC LIMIT 1';
        $result_akhir = $conn->query($pesan_akhir);
        $akhir = $result_akhir->fetch_assoc();
        if ($akhir["status_pesan"] <> 6){
            $query_pesan = 'INSERT INTO pesan VALUE (NULL,"'.$username.'",CURRENT_TIMESTAMP,6,"kosong",NULL,0)';
            $conn->query($query_pesan);
        };
    } else {
        $query_pesan = 'INSERT INTO pesan VALUE (NULL,"'.$username.'",CURRENT_TIMESTAMP,6,"kosong",NULL,0)';
        $conn->query($query_pesan);
    };
    $pesan_akhir = 'SELECT kode_pesan FROM pesan WHERE username_konsumen="'.$username.'" ORDER BY kode_pesan DESC LIMIT 1';
    $result_akhir = $conn->query($pesan_akhir);
    $akhir = $result_akhir->fetch_assoc();
    $stok_cart = 'SELECT kode_stok FROM stok WHERE status_stok=0 AND kode_barang='.$kode_barang.' ORDER BY kode_stok ASC LIMIT '.$jumlah.'';
    $result_cart = $conn->query($stok_cart);
    while ($cart = $result_cart->fetch_assoc()) {
        $pesan = 'UPDATE stok SET kode_pesan='.$akhir["kode_pesan"].', status_stok=1 WHERE kode_stok='.$cart["kode_stok"].'';
        $conn->query($pesan);
    };
    header('Location: ../keranjang.php');  
}
else
{
    header('Location: ../../katalog-detail.php?kodebarang='.$kode_barang.'');
}

$conn->close();
?>