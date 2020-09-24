<?php
/**
 * 
 */
class Model_auth extends CI_Model{
	
	public function auth($username=null, $password=null, $userid=null){
		
		$result = array();

		if ($userid) { //SIGNUP
			$sql    = "SELECT a.*, isnull(b.nopend,0) as nopend_pos, 'confirmation' = 
						CASE 
							WHEN a.confirmed = 0 THEN 'FALSE'
							ELSE 'TRUE'
						END, c.address1, c.address2, c.city, c.postalcode, d.provinsi
						FROM t_user a 
							LEFT JOIN mapping_kantor b on a.kantor = b.kantor_id 
							LEFT JOIN ref_kantor_sampoerna c on a.kantor = c.kantorid
							LEFT JOIN (
								SELECT DISTINCT provinsi, kodepos from ref_kodepos 
							) d on c.postalcode = d.kodepos
	                    WHERE a.userid = ?";
	        $query 	= $this->db->query($sql, array($userid));
		}else{
			$sql 	= "SELECT a.*, isnull(b.nopend,0) as nopend_pos, 'confirmation' = 
						CASE 
							WHEN a.confirmed = 0 THEN 'FALSE'
							ELSE 'TRUE'
						END, c.address1, c.address2, c.city, c.postalcode, d.provinsi
						FROM t_user a 
							LEFT JOIN mapping_kantor b on a.kantor = b.kantor_id 
							LEFT JOIN ref_kantor_sampoerna c on a.kantor = c.kantorid
							LEFT JOIN (
								SELECT DISTINCT provinsi, kodepos from ref_kodepos 
							) d on c.postalcode = d.kodepos
						WHERE a.email = ? AND a.password = ?";
			$query 	= $this->db->query($sql, array($username, $password));
		}

		if ($query->num_rows() > 0) {
			$hasil 		= $query->row_array();
			//convert to boolean
			$confirmed 	= $this->convertBool($hasil['confirmation']);
			$token  	= $this->signed_token(
				$hasil['email'], 
				$hasil['kantor'], 
				$hasil['userid'], 
				$hasil['nama'], 
				$hasil['id_level'], 
				$hasil['nopend_pos'],
				$confirmed,
				$hasil['nohp'],
				$hasil['city'],
				$hasil['address1'],
				$hasil['address2'],
				$hasil['postalcode'],
				$hasil['provinsi']
			);

			$result['success'] 	= TRUE;
			$result['data'] = array(
				'username' 	=> $hasil['email'],
				'nopend' 	=> $hasil['kantor'],
				'userid' 	=> $hasil['userid'],
				'nama' 		=> $hasil['nama'],
				'level' 	=> $hasil['id_level'],
				'nopendPos' => $hasil['nopend_pos'],
				'confirmed' => $confirmed,
				'token' 	=> $token,
				'nohp'		=> $hasil['nohp'],
				'city' 		=> $hasil['city'],
				'address'	=> $hasil['address1'],
				'address2' => $hasil['address2'],
				'postalCode' => $hasil['postalcode'],
				'provinsi' => $hasil['provinsi']
			);	
		}else{
			$result['success'] 	= FALSE;
			$result['data']		= NULL;
		}

		return $result;
	}

	public function loginPickup($password, $email){
		$result = [];
		try {
			$sql = "SELECT a.id_petugas as userid, a.nama_petugas as nama, a.email, a.status, a.kprk as kantor, id_level = '05',  nohp = '0',
					confirmation = 'TRUE', address1 = null, address2 = null, postalcode = null, provinsi = null, nopend_pos = '0', city = null
 					FROM t_petugas_pickup a 
 					WHERE a.email = ? AND password = ?";
 			$query = $this->db->query($sql, array($email, $password));
 			if ($query->num_rows() > 0) {
 				$hasil 		= $query->row_array();
 				$confirmed 	= $this->convertBool($hasil['confirmation']);
				$token  	= $this->signed_token(
					$hasil['email'], 
					$hasil['kantor'], 
					$hasil['userid'], 
					$hasil['nama'], 
					$hasil['id_level'], 
					$hasil['nopend_pos'],
					$confirmed,
					$hasil['nohp'],
					$hasil['city'],
					$hasil['address1'],
					$hasil['address2'],
					$hasil['postalcode'],
					$hasil['provinsi']
				);

				$result['success'] 	= TRUE;
				$result['data'] = array(
					'username' 	=> $hasil['email'],
					'nopend' 	=> $hasil['kantor'],
					'userid' 	=> $hasil['userid'],
					'nama' 		=> $hasil['nama'],
					'level' 	=> $hasil['id_level'],
					'nopendPos' => $hasil['nopend_pos'],
					'confirmed' => $confirmed,
					'token' 	=> $token,
					'nohp'		=> $hasil['nohp'],
					'city' 		=> $hasil['city'],
					'address'	=> $hasil['address1'],
					'address2' => $hasil['address2'],
					'postalCode' => $hasil['postalcode'],
					'provinsi' => $hasil['provinsi']
				);
 			}else{
 				$result['success'] 	= FALSE;
				$result['data']		= NULL;
 			}
		} catch (Exception $e) {
			$result['success'] 	= FALSE;
			$result['data']		= NULL;
		}
		return $result;
	}

	private function signed_token($username, $nopend, $userid, $nama, $level, $noppos, $confirmed, $nohp, $city, $address, $address2, $pos, $prov) {
		// Create token header as a JSON string
		$header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
		$payload = json_encode([
			'username' => $username, 
			'nopend' => $nopend, 
			'userid' => $userid, 
			'nama' => $nama, 
			'level' => $level, 
			'nopendPos' => $noppos,
			'confirmed' => $confirmed,
			'nohp' => $nohp,
			'city' => $city,
			'address' => $address,
			'address2' => $address2,
			'postalCode' => $pos,
			'provinsi' => $prov
		]);
		$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
		$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
		$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'abC123!', true);
		$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

		$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

		return $jwt;
	}

	private function convertBool($val){
		if ($val == 'FALSE') {
			$data = FALSE;
		}else{
			$data = TRUE;
		}

		return $data;
	}

	public function validateAkun($email){
		$sql = "SELECT * FROM t_user WHERE email = ?";
		$query = $this->db->query($sql, array($email));
		if ($query->num_rows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	function getCurdate(){
        $sql = "SELECT getdate() as sekarang";
        $now    = $this->db->query($sql)->row_array();
        $now    = $now['sekarang'];
        return $now;
    }
}

?>