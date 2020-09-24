<?php
/**
 * 
 */
class Model_assigment extends CI_Model{
	public function getAssigment($limit, $offset, $nopend){
		$sql = "SELECT *
				FROM ( 
				SELECT ROW_NUMBER() OVER ( ORDER BY a.tgl_order DESC ) AS RowNum, 
				a.id_order, CONVERT(varchar(10), a.tgl_order,120) as tgl_order, a.contentdesc,
				d.namakantor, d.postalcode, d.address1, a.service_id
				FROM t_order a
				INNER JOIN t_pengirim b on a.id_pengirim = b.id_pengirim
				INNER JOIN mapping_kantor c on b.kantorid = c.kantor_id
				INNER JOIN ref_kantor_sampoerna d on b.kantorid = d.kantorid
				WHERE a.status = '02' AND a.no_pickup IS NULL AND c.nopend = ?
				) AS RowConstrainedResult
				WHERE   RowNum >= $offset AND RowNum <= $limit
				ORDER BY RowNum";
		$query = $this->db->query($sql, array($nopend));
		return $query;
	}
}

?>