<?php
/**
 * 
 */
class Model_pickup extends CI_Model{
	public function fetchData($offset, $limit, $userid){
		$sql = "SELECT  *
				FROM    ( 
					 SELECT ROW_NUMBER() OVER ( ORDER BY tgl_order DESC ) AS RowNum,
						f.namakantor, h.NamaKtr as kantor_pickup, a.id_order,b.no_tlp as tlp_p, c.no_tlp as tlp_s, 
						CONVERT(varchar(10), a.tgl_order, 120) as tgl_order, 
						CONVERT(VARCHAR(8), a.tgl_order, 108) as waktu, a.id_po
					 FROM t_order a 
					 INNER JOIN t_pengirim b on a.id_pengirim = b.id_pengirim
					 INNER JOIN t_penerima c on a.id_penerima = c.id_penerima
					 INNER JOIN t_po d on d.id_po = a.id_po AND a.line_po = d.line
					 INNER JOIN t_user e on a.user_id = e.userid
					 INNER JOIN ref_kantor_sampoerna f on b.kantorid = f.kantorid
					 LEFT JOIN mapping_kantor g on b.kantorid = g.kantor_id
					 LEFT JOIN MemberSeller.dbo.ref_kantor h on g.nopend = h.nopend
					 WHERE a.status = '01' AND a.user_id = '$userid'
				) AS RowConstrainedResult
				WHERE   RowNum >= $offset AND RowNum <= $limit
				ORDER BY RowNum";
		$query = $this->db->query($sql, array($limit, $offset));
		return $query;
	}
}

?>