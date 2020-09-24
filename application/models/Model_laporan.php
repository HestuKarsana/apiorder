<?php
/**
 * 
 */
class Model_laporan extends CI_Model{
	public function getPickup($no_pickup){
		$sql = "SELECT a.no_pickup, a.pin, c.nama_petugas, CONVERT(varchar(10), a.tgl_assigment, 120) as tanggal, CONVERT(char(5), a.tgl_assigment, 108) as jam,
            b.id_order, b.contentdesc
            FROM t_pickup a INNER JOIN t_order b on a.no_pickup = b.no_pickup
            INNER JOIN t_petugas_pickup c on a.petugas_pickup = c.id_petugas
            WHERE a.no_pickup = ?";
		$query 	= $this->db->query($sql, array($no_pickup))->result_array();
		$data 	= $this->magic($query, 'no_pickup','detail','id_order');
		return $data[0];
	}


	 private function magic( $data, $groupkey, $nestname, $innerkey ) {
      $outer0 = array();
      $group = array(); 
      $nested = array();
      
      foreach( $data as $row ) {
        $outer = array();

        // foreach ($row as $k => $v) {
        //     if( $k==$innerkey ) break;
        //     $outer[$k] = $v;
        // }

        // $inner = array( $innerkey => $v );
        // foreach ($row as $k2 => $v2) {
        //   if( $k2==$innerkey ) break;
        //   $inner[$k2] = $v2;
        // }

        // //old
        while( list($k,$v) = each($row) ) {
          if( $k==$innerkey ) break;
          $outer[$k] = $v;
        }
        
        $inner = array( $innerkey => $v );
        while( list($k,$v) = each($row) ) {
          if( $k==$innerkey ) break;
          $inner[$k] = $v;
        }
        
        if( count($outer0) and $outer[$groupkey]!=$outer0[$groupkey] ) {
          $outer0[$nestname] = $group;
          $nested[] = $outer0;
          $group = array();
        }
        $outer0 = $outer;
        
        $group[] = $inner;
      }
      $outer[$nestname] = $group;
      $nested[] = $outer;

      return $nested;
    }

    public function getPO($no){
      $sql = "SELECT a.id_po,a.tgl_awal, a.tgl_akhir,a.keterangan,a.bsu, b.*,c.nama, c.email 
              FROM t_po a, ref_kantor_sampoerna b, t_user c
              WHERE a.userid = c.userid AND c.kantor = b.kantorid AND id_po = ?";
      $query = $this->db->query($sql, array($no));
      return $query->row_array();
    }

    public function getLimitPo(){
      $sql = "SELECT a.id_po, bsu, c.nama, ISNULL(SUM(b.fee+b.feetax+b.insurancetax+b.insurance), 0) as transaksi ,
              ISNULL(a.bsu - SUM(b.fee+b.feetax+b.insurancetax+b.insurance), 0) as saldo,
              ISNULL((a.bsu - SUM(b.fee+b.feetax+b.insurancetax+b.insurance)) / a.bsu *100, 100) as persen,

              case 
                WHEN (a.bsu - SUM(b.fee+b.feetax+b.insurancetax+b.insurance)) / a.bsu *100 < 20 THEN 'topup'
                WHEN (a.bsu - SUM(b.fee+b.feetax+b.insurancetax+b.insurance)) / a.bsu *100 IS NULL THEN 'saldo cukup'
                ELSE 'saldo cukup' END
              as ket
              from t_po a LEFT JOIN t_order b on a.id_po = b.id_po
              INNER JOIN t_user c on a.userid = c.userid
              --WHERE c.userid = '00001'
              GROUP BY a.id_po, a.bsu, c.nama
              HAVING ROUND((a.bsu - SUM(b.fee+b.feetax+b.insurancetax+b.insurance)) / a.bsu *100, 2, 1) <= 20";
      $query = $this->db->query($sql)->result_array();

      return $query;
    }

    public function getPoUser($user, $offset, $limit){
      $sql    = "EXEC fetch_listpo @userid = ?, @offset = ?, @limit = ?";
      $query  = $this->db->query($sql, array($user, $offset, $limit));
      return $query;
    }

    public  function getCetak($noinvoice){
      $sql    = "exec sp_cetak_invoice '".$noinvoice."'";
      $query = $this->db->query($sql)->result_array();
      $data   = $this->magic($query, 'namakantor','detail','uraian');
      return $data[0];
    }

    public function getLaporanInvoice($tanggal){
      $result = array();
      $sql    = "exec sp_laporan_invoice '".$tanggal."'";
      $query  = $this->db->query($sql);
      if ($query->num_rows() > 0 ) {
        $data               = $query->result_array();
        $result['success']  = true;
        $result['data']     = $this->magic($data, 'no_invoice','detail','uraian');
      }else{
        $result['success']  = false;
        $result['data']     = null;
      }
      
      return $result;
    }


    public function laporanDetailInvoice($id){
      $sql    = $this->db->query("exec sp_detail_invoice '".$id."'");
      return $sql;    
    }

    public function getLaporanOrder($tanggal, $id){
      $sql = "SELECT a.id_order, a.service_id, CONVERT(varchar(10), a.tgl_order, 120) as tanggal_order, a.fee, ISNULL(a.no_pickup, '-') as no_pickup, a.contentdesc,
                keterangan = case 
                WHEN b.status is null THEN (SELECT keterangan from ref_status_order WHERE status = a.status)
                ELSE c.keterangan
                END,
                real_trans = case 
                WHEN d.no_barcode is null then 0
                else (d.beadasar + d.ppn + d.htnb + d.ppn_htnb)
                END
              from t_order a
              LEFT JOIN t_pickup b on a.no_pickup = b.no_pickup
              LEFT JOIN ref_status_order c on b.status = c.status
              LEFT JOIN detail_invoice d on a.id_order = d.no_barcode
              WHERE a.user_id = ? AND CONVERT(varchar(10), a.tgl_order, 120) = ?
              ORDER BY a.tgl_order DESC";
              
      return $this->db->query($sql, array($id, $tanggal));
    }

    public function getAssigment($userid){
      $sql = "SELECT a.no_pickup, CONVERT(varchar(10), a.tgl_assigment, 120) as tgl_assigment, b.id_order, b.contentdesc,
              c.namakantor, d.NamaKtr, e.nama_petugas
              from t_pickup a INNER JOIN t_order b on a.no_pickup = b.no_pickup
              INNER JOIN ref_kantor_sampoerna c on a.kantor_mitra = c.kantorid
              INNER JOIN MemberSeller.dbo.ref_kantor d on a.kantor_pickup = d.nopend
              INNER JOIN t_petugas_pickup e on a.petugas_pickup = e.id_petugas
              WHERE a.status = '03' AND b.user_id = ?
              ORDER BY tgl_assigment DESC";
      $query = $this->db->query($sql, array($userid));
      return $query;
    }


    public function getLapHandover($userid){
      $sql = "SELECT a.no_pickup, b.id_order, a.pin, status = 'Handover', b.contentdesc, 
              (b.fee + b.feetax + b.insurance + b.insurancetax) as bsu_order, convert(varchar(10), a.tgl_assigment, 120) as tgl_assigment, b.id_po
              from t_pickup a INNER JOIN t_order b on a.no_pickup = b.no_pickup 
              WHERE a.status = '04' AND b.user_id = ?";
      $query = $this->db->query($sql, array($userid));

      return $query;
    }

    public function getSelesaiAntar($userid){
      $sql = "SELECT a.no_barcode, a.no_resi, (a.beadasar + a.htnb + a.ppn + a.ppn_htnb) as real_trans, (b.fee + b.feetax + b.insurance + b.insurancetax) as bsu_order, convert(varchar(10), b.tgl_order, 120) as tgl_order, convert(varchar(10), a.tgl_antaran, 120) as tgl_antaran, b.contentdesc
              from detail_invoice a INNER JOIN t_order b on a.no_barcode = b.id_order
              WHERE b.user_id = ? AND a.status_antar = 'SELESAI ANTAR'
              ORDER BY tgl_antaran DESC";
      $query = $this->db->query($sql, array($userid));
      return $query;
    }

    public function getLapPickup($userid){
      $sql = "SELECT b.id_order, CONVERT(varchar(10), b.tgl_order, 120) as tgl_order,
              b.contentdesc, (b.fee + b.feetax + b.insurance + b.insurancetax) as bsu_order
              FROM t_order b
              WHERE b.user_id = ? AND b.status = '02' AND b.no_pickup IS NULL";
      $query = $this->db->query($sql, array($userid));
      return $query;
    }    

    public function getInvoice($no_invoice){
      try {
        $sql = "EXEC sp_cetak_invoice @id_po = ?, @tgl_awal = '', @tgl_akhir = '', @jenis = 0";
        $query = $this->db->query($sql, array($no_invoice));
        if ($query->num_rows() > 0) {
          $list   = $query->result_array();
          $data   = $this->magic($list, 'no_invoice','detail','no');
          return $data[0];
        }else{
          return false;
        }
      } catch (Exception $e) {
        return false;
      }
    }

    public function getDetailInvoice($no_invoice){
      try {
        $sql = "EXEC sp_cetak_detail_invoice @no_invoice = ?";
        $query = $this->db->query($sql, array($no_invoice));
        if ($query->num_rows() > 0) {
          return $query->result_array();
        }else{
          return false;
        }
      } catch (Exception $e) {
        return false;
      }
    }
}
?>