<?php


function cookie(){
	$url = "https://m.klikbca.com/login.jsp";

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt"); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; ) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.113 Safari/537.36");
	
	$result = curl_exec($ch);
	
	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
	$cookies = array();
	foreach($matches[1] as $item) {
		parse_str($item, $cookie);
		$cookies = array_merge($cookies, $cookie);
	}
	curl_close($ch);
	return $cookies;
}

function login($userid, $password){
	$url = "https://m.klikbca.com/authentication.do";

	$data = 'value(user_id)='.$userid.'&value(pswd)='.$password.'&value(Submit)=LOGIN&value(actions)=login&value(user_ip)=103.129.105.29&user_ip=103.129.105.29&value(mobile)=true&value(browser_info)=Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.122 Mobile Safari/537.36&mobile=true';

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_HEADER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; ) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.113 Safari/537.36");
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt"); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
	
	$result = curl_exec($ch);
	
	preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
	$cookies = array();
	foreach($matches[1] as $item) {
		parse_str($item, $cookie);
		$cookies = array_merge($cookies, $cookie);
	}
	curl_close($ch);
	return $cookies;
}


function logout(){
	$url = "https://m.klikbca.com/authentication.do?value(actions)=logout";

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; ) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.113 Safari/537.36");
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt"); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
	
	$result = curl_exec($ch);
	curl_close($ch);
	return $result;
}


function saldo(){
	$url = "https://m.klikbca.com/balanceinquiry.do";

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, "");
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; ) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.113 Safari/537.36");
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt"); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
	
	$result = curl_exec($ch);
	
	$rek = explode("<td><font size='1' color='#0000a7'><b>", $result);
	$rek1 = explode("</td>", $rek[1]);
	$norek = $rek1[0];
	
	$sal = explode("<td align='right'><font size='1' color='#0000a7'><b>", $result);
	$sal1 = explode("</td>", $sal[1]);
	$saldo = $sal1[0];
	
	curl_close($ch);
	return array("norek"=>$norek, "saldo"=>$saldo);
}


function mutasi($start, $end){

	$splitStart = explode("/", $start);
	$splitEnd = explode("/", $end);

	$url = "https://m.klikbca.com/accountstmt.do?value(actions)=acctstmtview";

	$data = 'value(r1)=1&value(startDt)='.$splitStart[0].'&value(startMt)='.$splitStart[1].'&value(startYr)='.$splitStart[2].'&value(endDt)='.$splitEnd[0].'&value(endMt)='.$splitEnd[1].'&value(endYr)='.$splitEnd[2].'&value(fDt)=&value(tDt)=&value(submit1)=Lihat+Mutasi+Rekening';

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; ) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.113 Safari/537.36");
	curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt"); 
	curl_setopt($ch, CURLOPT_COOKIEFILE, "cookie.txt");
	
	$result = curl_exec($ch);

	$rows = array();

	$parse = explode( '<td bgcolor="#e0e0e0" colspan="2"><b>KETERANGAN</td>', $result );
	if ( empty( $parse[1] ) ){
		return false;
	}else{

		$parse = explode( '<!--<tr>', $parse[1] );
		$clear = str_replace("<tr bgcolor='#e0e0e0'>", "", $parse[0]);
		$clear = str_replace("<tr bgcolor='#f0f0f0'>", "", $clear);
		$clear = str_replace("</tr>", "", $clear);
		$clear = str_replace("	", "", $clear);
		
		$parse = explode( "\n", $clear );
		$removeEmpty = array_filter($parse);

		foreach( $removeEmpty as $val ) {
			$split = explode("<td", $val);

			$tgl = trim(strip_tags("<td".$split[1]));
			if ( stristr( $tgl, 'pend' ) ) {
				$tgl = "PEND";
			}

			$keterangan = trim(strip_tags("<td".$split[2]));
			$status = trim(strip_tags("<td".$split[3]));
			$idr = explode("<br>", $split[2]);
			$nominal = str_replace(",", "", str_replace(".00", "", end($idr)));

			$rows[] = array(
				$tgl,
				$keterangan,
				$status,
				$nominal
			);
			
		}
	}
	
	
	curl_close($ch);
	
	return $rows;
}







?>