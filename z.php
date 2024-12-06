<?php
include_once ('./sys/functions.php');

$PDO = new PDO('mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=utf8', DB_USER, DB_PASS, array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_TIMEOUT => 5));
$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		$property = 'server_name';
		$sql = 'SELECT * FROM `properties` WHERE `property` = :property LIMIT 1;';
		$stmt = $PDO->prepare($sql);
		$stmt->bindParam(':property', $property, PDO::PARAM_STR, 255);

		if ($stmt->execute()) {
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			echo $result['value'];

		}

?>