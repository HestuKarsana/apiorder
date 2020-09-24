<?php

/**
 * 
 */
class Model_dashboard extends CI_Model{
	public function getJumlahUser(){
		$sql = "SELECT b.deskripsi, a.id_level, COUNT(a.id_level) as jumlah
				FROM t_user a INNER JOIN ref_level b 
				on a.id_level = b.id_level
				WHERE confirmed = 1 AND a.id_level <> '03' 
				GROUP BY b.deskripsi, a.id_level
				UNION 
				SELECT 'deskripsi' = 'Belum Aktif', id_level='99', ISNULL(COUNT(*),0) as jumlah
				FROM t_user WHERE confirmed = 0
				ORDER BY a.id_level";
		$query = $this->db->query($sql)->result_array();
		return $query;
	}

	public function getCountForMitra($id){
		$sql = "SELECT COUNT(b.id_order) as jumlah, keterangan = 'Jumlah Order', nomor = '1', link = '/pickup'
				from t_user a LEFT JOIN t_order b on a.userid = b.user_id
				WHERE a.userid = '$id' AND b.status = '01'
				UNION
				SELECT COUNT(b.id_order) as jumlah, keterangan = 'Request Pickup', nomor = '2', link = '/laporan/pickup'
				from t_user a LEFT JOIN t_order b on a.userid = b.user_id
				WHERE a.userid = '$id' AND b.status = '02' AND b.no_pickup IS NULL
				UNION 
				SELECT COUNT(b.id_order) as jumlah, keterangan = 'Assigment', nomor = '3', link = '/laporan/assignment'
				FROM t_user a LEFT JOIN t_order b on a.userid = b.user_id
				LEFT JOIN t_pickup c on b.no_pickup = c.no_pickup
				WHERE c.status = '03' AND a.userid = '$id'
				UNION
				SELECT COUNT(b.id_order) as jumlah, keterangan = 'Handover', nomor = '4', link = '/laporan/handover'
				FROM t_user a LEFT JOIN t_order b on a.userid = b.user_id
				LEFT JOIN t_pickup c on b.no_pickup = c.no_pickup
				WHERE c.status = '04' AND a.userid = '$id'
				UNION
				SELECT COUNT(c.no_barcode) as jumlah, keterangan = 'Selesai Antar', nomor = '5', link = '/laporan/selesai_antar'
				FROM t_user a left JOIN t_order b on a.userid = b.user_id
				LEFT JOIN detail_invoice c on b.id_order = c.no_barcode
				WHERE a.userid = '$id' AND c.status_antar = 'SELESAI ANTAR'
				UNION
				SELECT COUNT(a.id_order) as jumlah, keterangan = 'Invoice', nomor = '6', link = '/laporan/invoice'
				FROM t_order a INNER JOIN t_pickup b on a.no_pickup = b.no_pickup
				WHERE b.status = '05' AND a.user_id = '$id'
				ORDER BY nomor ASC";
		return $this->db->query($sql);
	}
}

?>