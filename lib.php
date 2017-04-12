<?php


function getDBConnection(){
	try{ // Uses try and catch to handle any unforeseen errors
		$db = new mysqli("localhost","root","","projects");
		if ($db == null && $db->connect_errno > 0)return null;
		return $db;
	}catch(Exception $e){ } // We currently do nothing in the catch, but later we can log
	return null;
}


function getAllProjects(){
	$db = getDBConnection();
	$projects = [];
	if ($db != null){
		$sql = "SELECT * FROM `project`";
		$res = $db->query($sql);
		while($res && $row = $res->fetch_assoc()){
			$projects[] = $row;
		}
	}
	return $projects;
}


function saveProject($name, $price, $countryId){
	$sql = "INSERT INTO `products` (`id`, `countryid`, `name`, `price`) VALUES (NULL, $countryId, '$name', $price);";
	$db = getDBConnection();
	$id = -1;
	if ($db != null){
		$res = $db->query($sql);
		if ($res && $db->insert_id > 0){
			$id = $db->insert_id;
		}
		$db->close();
	}
	return $id;
}






//echo saveProduct("Pants", 234, 23);