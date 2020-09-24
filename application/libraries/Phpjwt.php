<?php

use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenEncoded;
use Nowakowskir\JWT\TokenDecoded;

class Phpjwt{
	public function validateToken($tokenString){
		$result = array();
        $key 	= 'abC123!';
		$tokenEncoded = new TokenEncoded($tokenString);

		try {
		    $tokenEncoded->validate($key);
		} catch (IntegrityViolationException $e) {
		    $result['success'] = '400';
		} catch(TokenExpiredException $e) {
		    $result['success'] = '400';
		} catch(TokenInactiveException $e) {
		    $result['success'] = '400';
		} catch (InvalidStructureException $e){
			$result['success'] = '400';
		} catch(Exception $e) {
		    $result['success'] = '400';
		}

		return $result;

	}

	public function decodeToken($token){
		$tokenEncoded = new TokenEncoded($token);

		return $tokenEncoded->decode()->getPayload();
	}
}

?>