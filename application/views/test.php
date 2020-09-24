<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Surat Tugas Pengambilan</title>
<link href="assets/style_DO.css" rel="stylesheet" type="text/css">
<table width="100%" style="font-size: 15px;">
  <tbody>
  <tr>
    <th rowspan="2" align="center" width="1%">
      <h5><img src="assets/logoposindo.png" width="140" height="70"></h5></th>
    <th>
        <center><h1>Pickup Order</h1></center>
    </th>
     <tr>    
        <th align="center"><h3><u>No : <?php echo $record['no_pickup'];?></u></h3></th>        
    </tr>

  </tr>
  </tbody>
</table>
<br>
<div style="padding-top: 15px; font-size: 15px;">
	<table width="20%" style="font-size: 15px;">
	  <tr>
	    <td align="left">Tanggal Pengambilan</td>
	    <td>:</td>
	    <td colspan="4" align="left"><?php echo $record['tanggal'];?></td>
	  </tr>
	  <tr>
	    <td align="left">Kode PIN</td>
	    <td>:</td>
	    <td colspan="3" align="left"><?php echo $record['pin'];?></td>
	  </tr>
	</table>
	<br/>
	<br/>
	Sehubungan dengan adanya permintaan order pengiriman pada tanggal <b><?php echo $record['tanggal'];?></b>. Kami menugaskan kurir pada jam 10.00 - 16.00. Dengan detail order :
</div>
<br>


<br><table width="100%" border="1">
      <tbody><tr height="20">
        <th scope="col" width="10%" align='center'>Nomor Order</th>
        <th scope="col" width="20%" align='center'>Jenis Item</th>
        <th scope="col" width="4%" align='center'>Kuantiti</th>
        <th scope="col" width="3%" align='center'>Unit</th>
      </tr>
    </tbody>
  </table>
  <hr size="0" color="#000000">
  <table width="100%" >
      <tbody>
          <?php
            $detail = $record['detail'];
            foreach ($detail as $key) {
              $id_order = $key['id_order'];
              $content  = $key['contentdesc'];
              echo "<tr>
                <td scope='col' width='10%' align='center'>$id_order</td>
                <td scope='col' width='20%' align='center'>$content</td>
                <th scope='col' width='4%' align='center'>1</th>
                <th scope='col' width='3%' align='center'>buah</th>
              </tr>";
            }
          ?>
        </tbody>
      </table>
   <br><br><br>
<table width="100%" border="1" class="spec_table" style="text-align: center;">
  <tbody>
    <tr>
      <th scope="col" width="202">Dibuat Oleh</th>
      <th scope="col" width="218">Petugas</th>
      <th scope="col" width="208">Dikonfirmasi Oleh</th>
    </tr>
  <tr>
    <th scope="row" height="83">&nbsp;</th>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" style="border-top: 1px solid #eee; padding: 6px 24px"><?php echo $admin;?></td>
    <td align="center"><?php echo $record['nama_petugas'];?></td>
    <td></td>
  </tr>
</tbody></table>
</body></html>