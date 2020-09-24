<?php

header("Content-type: application/octet-stream");

header("Content-Disposition: attachment; filename=detailInvoice.xls");

header("Pragma: no-cache");

header("Expires: 0");

function rupiah($angka){
    $hasil_rupiah = "" . number_format($angka,0,'.',',');
    return $hasil_rupiah;
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>detail invoice</title>
</head>
<body>
<table border="1" width="100%">
	<thead>
		<tr>
			<td>NO</td>
			<td>ID PEL</td>
			<td>NO RESI</td>
			<td>NAMA PENERIMA</td>
			<td>ALAMAT</td>
			<td>KOTA</td>
			<td>KODEPOS</td>
			<td>NAMA PENGIRIM</td>
			<td>ALAMAT</td>
			<td>KOTA</td>
			<td>KODEPOS</td>
			<td>BERAT</td>
			<td>BEADASAR</td>
			<td>PPN</td>
			<td>HTNB</td>
			<td>PPN HTNB</td>
			<td>BEA LAIN</td>
			<td>TOTAL BEA</td>
			<td>TGL TRANSAKSI</td>
			<td>KANTOR KIRIM</td>
			<td>NO BARCODE</td>
			<td>TGL ANTARA</td>
			<td>LOKASI ANTAR</td>
			<td>KODE POS</td>
			<td>STATUS ANTAR</td>
			<td>KETERANGAN ANTAR</td>
			<td>3LC</td>
	 	</tr>
	</thead>
	<tbody>
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
	</tbody>
</table>
</body>
</html>