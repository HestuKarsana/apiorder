<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	
	<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
	<title></title>	
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { 
			font-family:"Arial Narrow"; 
			font-size:8px; }
		
	</style>
	
</head>
<?php
function rupiah($angka){
    $hasil_rupiah = "" . number_format($angka,0,'.',',');
    return $hasil_rupiah;
}
?>
<body>

<table cellspacing="0" border="0" width="100%">

	<tr>
		<td><p align='center'><b>LAPORAN KOLEKTING KIRIMAN KORPORAT WEBBASE </b></p></td>
		</tr>
	<tr>
		<td><p align='center'><b>KODE PELANGGAN : SAMPOERNA07603A - SAMPOERNA</b></p></td>
		</tr>
	<tr>
		<td><p align='center'><b>KODE PRODUK PELANGGAN : 000 - SEMUA PRODUK</b></p></td>
	</tr>
	<tr>
		<td><p align='center'><b>PERIODE : 1 September 2018 s.d. 29 September 2019</b></p></td>
	</tr>
</table>
<br>
<table cellspacing="0" border="1px">
	<colgroup width="36"></colgroup>
	<colgroup width="183"></colgroup>
	<colgroup width="157"></colgroup>
	<colgroup span="4" width="85"></colgroup>
	<colgroup width="147"></colgroup>
	<colgroup span="4" width="85"></colgroup>
	<colgroup width="96"></colgroup>
	<colgroup span="4" width="85"></colgroup>
	<colgroup width="96"></colgroup>
	<colgroup width="136"></colgroup>
	<colgroup width="264"></colgroup>
	<colgroup width="173"></colgroup>
	<colgroup width="131"></colgroup>
	<colgroup span="5" width="85"></colgroup>
	<tr>
		<td><p align='center'>NO</b></p></td>
		<td><p align='center'>ID PEL</b></p></td>
		<td><p align='center'>NO RESI</b></p></td>
		<td><p align='center'>NAMA PENERIMA</b></p></td>
		<td><p align='center'>ALAMAT</b></p></td>
		<td><p align='center'>KOTA</b></p></td>
		<td><p align='center'>KODEPOS</b></p></td>
		<td><p align='center'>NAMA PENGIRIM</b></p></td>
		<td><p align='center'>ALAMAT</b></p></td>
		<td><p align='center'>KOTA</b></p></td>
		<td><p align='center'>KODEPOS</b></p></td>
		<td><p align='center'>BERAT </b></p></td>
		<td><p align='center'>BEADASAR </b></p></td>
		<td><p align='center'>PPN</b></p></td>
		<td><p align='center'>HTNB</b></p></td>
		<td><p align='center'>PPN HTNB</b></p></td>
		<td><p align='center'>BEA LAIN</b></p></td>
		<td><p align='center'>TOTAL BEA </b></p></td>
		<td><p align='center'>TGL TRANSAKSI</b></p></td>
		<td><p align='center'>KANTOR KIRIM</b></p></td>
		<td><p align='center'>NO BARCODE </b></p></td>
		<td><p align='center'>TGL ANTARAN</b></p></td>
		<td><p align='center'>LOKASI ANTAR </b></p></td>
		<td><p align='center'>KODE POS</p></td>
		<td><p align='center'>STATUS ANTAR </b></p></td>
		<td><p align='center'>KETERANGAN ANTAR </b></p></td>
		<td><p align='center'>3LC</b></p></td>
	</tr>
	<?php
		$no = 1;
		foreach ($record as $key) {
			echo "<tr>
				<td>".$no++."</td>
				<td>".$key['customer_id']."</td>
				<td>".$key['no_resi']."</td>
				<td>".$key['nm_penerima']."</td>
				<td>".$key['alamat_penerima']."</td>
				<td>".$key['kab_penerima']."</td>
				<td>".$key['kodepos_penerima']."</td>
				<td>".$key['nm_pengirim']."</td>
				<td>".$key['alamat_pengirim']."</td>
				<td>".$key['kab_pengirim']."</td>
				<td>".$key['kodepos_pengirim']."</td> 
				<td>".$key['berat']."</td> 
				<td>".rupiah($key['beadasar'])."</td> 
				<td>".rupiah($key['ppn'])."</td> 
				<td>".rupiah($key['htnb'])."</td> 
				<td>".rupiah($key['ppn_htnb'])."</td> 
				<td>".rupiah($key['bea_lain'])."</td> 
				<td>".rupiah($key['total_bea'])."</td> 
				<td>".$key['tgl_transaksi']."</td> 
				<td>".$key['kantor_kirim']."</td> 
				<td>".$key['id_order']."</td> 
				<td>".$key['tgl_antaran']."</td> 
				<td>".$key['lokasi_antaran']."</td> 
				<td>".$key['kodepos']."</td> 
				<td>".$key['status_antar']."</td> 
				<td>".$key['keterangan']."</td> 
				<td>".$key['tlc']."</td> 
			</tr>";
		}
	?>
</table>
</body>

</html>
