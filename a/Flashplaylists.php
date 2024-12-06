<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for SourceGuardian Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

const ALLOWED_CHARACTERS = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
function getDecodedString($str) {
    $encryptKeyPosition = getEncryptKeyPosition(substr($str, -2, 1));
    $encryptKeyPosition2 = getEncryptKeyPosition(substr($str, -1));
    $substring = substr($str, 0, -2);
    return trim(utf8_decode(base64_decode(substr($substring, 0, $encryptKeyPosition) . substr($substring, $encryptKeyPosition + $encryptKeyPosition2))));
}

function getEncryptKeyPosition($str) {
    return strpos(ALLOWED_CHARACTERS, $str);
}

function getEncodedString($str) {
    $encryptKeyPosition = getEncryptKeyPosition(substr($str, -2, 1));
    $encryptKeyPosition2 = getEncryptKeyPosition(substr($str, -1));
    $encodedString = base64_encode(utf8_encode($str));
    $substring = substr($encodedString, 0, $encryptKeyPosition) . substr($encodedString, $encryptKeyPosition + $encryptKeyPosition2);
    return $substring . substr(ALLOWED_CHARACTERS, $encryptKeyPosition, 1) . substr(ALLOWED_CHARACTERS, $encryptKeyPosition2, 1);
}


$api = 'invalid';
$req = 0;
$rawdata = file_get_contents('php://input');

if ($json_file = json_decode($rawdata, true)) {
	$req_data = $json_file['data'];
	$req = getDecodedString($req_data);
	$this_json = json_decode($req, true);
	$mac_address = strtoupper($this_json['mac_address']);
	$app_type = $this_json['app_type'];
	$playlist_id = $this_json['playlist_id'];
	$playlist_name = $this_json['playlist_name'];
	$playlist_url = $this_json['playlist_url'];
	$playlist_type = $this_json['playlist_type'];
	$url = str_replace('\\\\', '', $playlist_url);
	$pieces = explode('/get.php?', $url);
	$url1 = $pieces[0];
	$url2 = $pieces[1];
	parse_str($url2, $cred);
	$user = $cred['username'];
	$pass = $cred['password'];
	$db = new SQLite3('./.eggziedb.db');
	$db->exec('CREATE TABLE IF NOT EXISTS ibo(id INTEGER PRIMARY KEY NOT NULL,mac_address VARCHAR(100),username VARCHAR(100),password VARCHAR(100),expire_date VARCHAR(100),url VARCHAR(100),title VARCHAR(100),created_at VARCHAR(100))');
	$we = strtotime('+ 5years');
	$ne = date('Y-m-d', $we);
	$start = date('Y-m-d');
	$end = date('h:m:s');
	$full = $start . 'T' . $end . '.000000Z';
	$res = $db->query('SELECT * FROM ibo WHERE mac_address="' . $mac_address . '" and url="' . $playlist_id . '"');

	while ($row = $res->fetchArray()) {
		$thisid = $row['url'];
		$thisexpire_date = $row['expire_date'];
		$thispassword = $row['password'];
		$thisusername = $row['username'];
		$thisuserblock = $row['is_blocked'];
	}

	if ($thisuserblock == '1') {
		$out = ['success' => 1, 'id' => 0, 'name' => 0, 'url' => 0];
		echo json_encode($out);
		exit();
	}

	if (!empty($thisexpire_date)) {
		$db->exec('UPDATE ibo SET expire_date=\'' . $ne . '\', username=\'' . $user . '\', password=\'' . $pass . '\', created_at=\'' . $full . '\' WHERE mac_address=\'' . $mac_address . '\' and url=\'' . $playlist_id . '\'');
		$out = ['success' => 1, 'id' => $playlist_id, 'name' => $playlist_name, 'url' => $url . '/get.php?username=' . $user . '&password=' . $pass . '&type=m3u_plus&output-ts'];
		echo json_encode($out);
	}
	else {
		$db->exec('INSERT INTO ibo(mac_address, username, password, expire_date, url, title, created_at) VALUES(\'' . strtoupper($mac_address) . '\', \'' . $user . '\', \'' . $pass . '\', \'' . $ne . '\', \'' . $playlist_id . '\', \'' . $playlist_name . '\',\'' . $full . '\')');
		$out = ['success' => 1, 'id' => $playlist_id, 'name' => $playlist_name, 'url' => $url . '/get.php?username=' . $user . '&password=' . $pass . '&type=m3u_plus&output-ts'];
		echo json_encode($out);
	}
}

?>