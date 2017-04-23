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
	$sql = "INSERT INTO `projects` (`id`, `projectid`, `studentname`, `year`) VALUES (NULL, $projectid, `$studentname`, $year);";
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

function createUser($username, $password, $firstname, $lastname, $schoolId, $acctype, $email){
	$sql = "INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `Email`, `schoolIdnum`, `accounttype`, `approval`, `datecreated`)
			VALUES (NULL, '$username', '$password', '$firstname', '$lastname', '$email', '$schoolId', '$acctype', 'No', CURRENT_TIMESTAMP);";
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

function createProject($projname, $coursename, $coursecode, $gitlink, $year){
	$sql = "INSERT INTO `project` (`id`, `projname`, `coursename`, `coursecode`, `githublink`, `year`, `file`, `members`)
			VALUES (NULL, '$projname', '$coursename', '$coursecode', '$gitlink', '$year', '/useruploads/hive.zip', 'Member1 Member2')";
	
	print $sql;
	
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

function upload(){
	
	$target_dir = "useruploads/";
	$target_file = $target_dir . basename($_FILES["upload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["upload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["upload"]["size"] > 10000000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}



//echo saveProduct("Pants", 234, 23);