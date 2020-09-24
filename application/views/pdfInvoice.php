<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Surat Tugas PIckup</title>

<link href="<?php echo base_url();?>assets/style_DO.css" rel="stylesheet" type="text/css">
<?php
function rupiah($angka){
    $hasil_rupiah = "" . number_format($angka,0,'.',',');
    return $hasil_rupiah;
}
?>
<table bgcolor="lightblue" width="100%">
<tr>
  <td>
<table width="100%">
  <tbody>
  <tr>
    <td rowspan="3" align="center" width="40%">
    <img src="<?php echo base_url();?>assets/1200px-LogoHMSampoerna.svg.png" width="150" height="90"><br>
    <h3 style="margin-bottom: -10px;"><?php echo $record['namakantor'];?></h3></b><br>
    <?php echo $record['address1'];?><br>
    <?php echo $record['address2'];?> - <?php echo $record['city'];?><br>
    <?php echo $record['postalcode'];?><br>
    Indonesia<br>
    Tel : 62 31 843 1699; Fax : 62 31 843 0986<br><br>
    <p align="left">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PT. POS INDONESIA<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hadi Sunarto<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JEMUR ANDAYANI NO.75<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;JEMUR WONOSARI WONOCOLO<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;60299 SURABAYA<br>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;INDONESIA</p>
    </td>
    <td align="left" colspan='2' width="30%"><h1>Call-Of-Order <?php echo $record['id_po'];?></h1>
    </td>
  
  </tr>
  <tr>
    <td width="30%" align="left">
      <b>Delivery Address</b><br>
      PT. Hm Sampoerna Tbk.<br>
      Jl. Rungkut Industri Raya No 18<br>
      Rungkut Tengah<br>
      Gunung Anyar - Surabaya<br>
      60293 Jawa Timur<br>
      Indonesia<br>
    </td>
    <td>
    <table>
    <tr>
      <td align="left"><b>Vendor Number</b></td>
      <td align="left">151170</td>
    </tr>
    <tr>
      <td align="left"><b>Telephone</b></td>
      <td align="left">0851xxxxxxxxx</td>
    </tr>    
      <tr>
        <td></td>
      </tr>
      <tr>
        <td></td>
      </tr>
    <tr>
      <td align="left"><b>Contant</b></td>
      <td align="left"><?php echo $record['nama'];?></td>
    </tr>
    <tr> 
      <td align="left"><b>Email</b></td>
      <td align="left"><?php echo $record['email']?></td>
    </tr>
    <tr>
      <td align="left"><b>Telephone</b></td>
      <td align="left">0851xxxxxxxxx</td>
    </tr> 
    </table>
    </td>     
  </tr>
  <tr>
    <td width="30%" align="left">
      <b>Invoicing Address</b><br>
      <?php echo $record['namakantor'];?><br>
      <?php echo $record['address1'];?><br>
      <?php echo $record['address2'];?><br>
      <?php echo $record['city'];?><br>
      <?php echo $record['postalcode'];?><br>
      Indonesia<br>
    </td>
    <td>
      <br>
    <table>
    <tr>
      <td align="left"><b>Release Date</b></td>
      <td align="left"><?php echo $record['tgl_awal'];?></td>
    </tr>
    <tr>
      <td align="left"><b>Delivery Date</b></td>
      <td align="left"><?php echo $record['tgl_akhir'];?></td>
    </tr>    
    <tr>
      <td align="left"><b>Terms of Payment</b></td>
      <td align="left">Due 14 Days from the invoice</td>
    </tr>
    <tr> 
      <td align="left">receiving date</td>
    </tr>
    <tr>
      <td align="left"><b>Currency</b></td>
      <td align="left">IDR</td>
    </tr> 
    </table>
    </td>     
  </tr>
  </tbody>
</table>
</td>
</tr>
</table>
<hr>

<table>
  <tr>
    <td>
      1.
    </td>
    <td>
      Please return signed PO acknowledgement immediately, advising shipping / delivery date and price changes to Accounts Payable, or you can return the signed PO by fax.
    </td>
  </tr>
  <tr>
    <td>
      2.
    </td>
    <td>
      Invoices must be submitted on the day of delivery together with the delivery orders to the Accounts Payable - Finance Department.<
    </td>
  </tr>
  <tr>
    <td>
      3.
    </td>
    <td>
      Purchase Order number must appear on all invoices and delivery orders.
    </td>
  </tr>
  <tr>
    <td>
      4.
    </td>
    <td>
      The seller has to remit the 10% VAT amount to the appropriate tax authority. Failure to do so, the seller shall be responsible of any penalty / claim imposed.
    </td>
  </tr>
  <tr>
    <td>
      5.
    </td>
    <td>
      Vendor must submit the correct Invoice after goods & services received by the Company within 90 days to avoid Tax Invoice expiration. If the Company did not received the invoice from vendor up to 240 days for Direct Materials and 360 days for Indirect Materials & Services from date of goods & services received by the Company, the related liability will be automatically written off and the Company will have the right to reject the billing.
    </td>
  </tr>
  <tr>
    <td>
      6.
    </td>
    <td>
      The total price is subject to 10% VAT but inclusive any applicable Withholding Tax(WHT)<br>
    </td>
  </tr>
  <tr>
    <td>      
    </td>
    <td>
      QNAP delivery from 80 area to Pandaan
    </td>
  </tr>
  <tr>
    <td></td>
    <td>
      PIC : Vincentius Budi Darmawan
    </td>
  </tr>
</table>

<table class="bottomBorder" width="100%">
  <tr>
    <th align="left" width="15%">Item Material Number</th>
    <th align="left" width="33%">Description</th>
    <th width="10%">Quantity</th>
    <th width="10%">Unit</th>
    <th width="10%">Price per unit</th>
    <th width="10%">Amount</th>
  </tr>
</table>
<br>
<table width="100%" class="body">
  <tr>
    <th align="left" width="15%">1</th>
    <th align="left" width="33%"> <?php echo $record['keterangan'];?></th>
    <th width="10%">1</th>
    <th width="10%">VAL</th>
    <th width="10%"><?php echo rupiah($record['bsu']);?></th>
    <th width="10%"><?php echo rupiah($record['bsu']);?></th>
  </tr>
</table>
<br>
<table width="100%" class="body">
  <tr>
    <th align="left" width="15%"></th>
    <th align="left" width="33%">QNAP delivery from 80 area to Pandaan<br>
    PIC : Vincentius Budi Darmawan</th>
    <th width="10%"></th>
    <th width="10%"></th>
    <th width="10%"></th>
    <th width="10%"></th>
  </tr>
</table>
<table class="bottomBorder" width="100%">
  <tr>
    <th align="left" width="15%"></th>
    <th align="left" width="33%">
    <th width="10%"></th>
    <th width="10%"><b>Total Value</b></th>
    <th width="10%"></th>
    <th width="10%"><?php echo rupiah($record['bsu']);?></th>
  </tr>
</table>
<br>
<table width="100%">
  <tr>
    <th align="left" width="70%">
      For and on behalf of<br>
     <?php echo $record['namakantor'];?></th>
    <th align="left" width="30%">
    Confirmed and Accepted by:</th>
  </tr>
  <tr>
    <th align="left" width="70%" height="83">
      </th>
    <th align="left" width="30%">
    </th>
  </tr>
  <tr>
    <th align="left" width="70%">
      __________________________________________________<br>
      Company Stamp / Authorised Signature (the "Buyer")
      </th>
    <th align="left" width="30%">
      __________________________________________________<br>
      Company Stamp & Authorised Signature (the "Seller")
    </th>
  </tr>
  <tr>
    <th align="left" width="70%" height="50">
      __________________________<br>
      Date
      </th>
    <th align="left" width="30%">
      __________________________<br>
      Date
    </th>
  </tr>
</table>
</body>
</html>

<style>
  table.bottomBorder { 
    border-collapse: collapse; 
  }
  table.bottomBorder td, 
  table.bottomBorder th { 
    border-top: 1px solid ;
    border-bottom: 1px solid ; 
    padding: 10px; 
    
  }

  table.body { 
    border-collapse: collapse; 
  }
  table.body td, 
  table.body th { 
    padding: 10px; 
    
  }  
</style>