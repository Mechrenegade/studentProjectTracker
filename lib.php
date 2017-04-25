<?php
session_start();
$num =0;
$_SESSION['fromSignin'] = array("num"=>$num);


function getDBConnection(){
	try{ // Uses try and catch to handle any unforeseen errors
		$db = new mysqli("localhost","projAdmin","admin1","projects");
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

function createProject($projname, $coursename, $coursecode, $gitlink, $year, $fname){
	$sql = "INSERT INTO `project` (`id`, `projname`, `coursename`, `coursecode`, `githublink`, `year`, `file`, `members`)
			VALUES (NULL, '$projname', '$coursename', '$coursecode', '$gitlink', '$year', '$fname', 'Member1 Member2')";
	
	//print $sql;
	
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
	$fileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$name=" ";
	// Check if file already exists
	if (file_exists($target_file)) {
		//echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["upload"]["size"] > 100000000) {
		 //echo "Sorry, your file is too large." ;
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($fileType != "zip" && $fileType != "rar" && $fileType != "7z") {
		//echo "Sorry, only ZIP, RAR and 7z files are allowed";
		$uploadOk = 0;
	}

	if ($uploadOk == 0) {
		//echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file)) {
			
			//echo "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";
			$name = basename($_FILES["upload"]["name"]);
		} else {
			//echo "Sorry, there was an error uploading your file.";
		}
	}
	return $name; 
}

function countPending(){
	$conn = getDBConnection();
	$sql = "SELECT * FROM `user` WHERE `approval` = 'NO'";
	$res = $conn->query($sql);
	$count = 0;
	if ($res){
		$row = $res->fetch_assoc();
		while ($row != null){
			$count = $count+1;
			$row = $res->fetch_assoc();
		}
	}
	return $count;
}

function approve($id){

	$conn = getDBConnection();
	$sql = "UPDATE `user` SET `approval` = 'Yes' WHERE `user`.`id` = $id;";
	$res = $conn->query($sql);



}

function delete($id){

	$conn = getDBConnection();
	$sql = "DELETE FROM `user` WHERE `user`.`id` = $id";
	$res = $conn->query($sql);
}

function loginUser($username, $password){
	global $conn;
	$conn = getDBConnection();
    $password = sha1($password);
    $sql = "SELECT `id`, `username`, `accounttype`, `firstname`, `lastname`, `approval` FROM `user` WHERE `username` = \"{$username}\" AND `password` = \"{$password}\"";
    $res = $conn->query($sql);
	$user = $res->fetch_assoc();

    if($res->num_rows == 0){
        return json_encode(array("status"=>"failure"));
    }
	//else if($user['approval'] =='No'){
	//	return json_encode(array("status"=>"Not Approved"));
	//}
	else{
		
        $_SESSION["userData"] = array(
            "userid"=> $user['id'],
            "username"=> $user['username'],
			"accounttype"=> $user['accounttype'],
			"approval"=> $user['approval'],
			"firstname"=> $user['firstname'],
			"lastname"=> $user['lastname']
        );
        return json_encode(array("status"=>"success", "userid"=> $user['id']));
    }

}

function update($id, $name){

	$conn = getDBConnection();
	$sql = "UPDATE `user` SET `username` = '$name' WHERE `user`.`id` = $id;";
	$res = $conn->query($sql);


}

function upPic(){
	$target_dir = "src/propics";
    $target_file = $target_dir . basename($_FILES["upload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	$name ="";
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
    if ($_FILES["upload"]["size"] > 1000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
    
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
            //echo "The file ". basename( $_FILES["upload"]["name"]). " has been uploaded.";
			$name = basename($_FILES["upload"]["name"]);
        } else {
            //echo "Sorry, there was an error uploading your file.";
        }
    }
	return $name;

}

function createUserData($id, $picname){
	$sql = "SELECT * FROM `userInfo` WHERE `userId` = $id";
	$sql2 = "INSERT INTO `userInfo` (`id`, `userId`, `description`, `propic`)
			VALUES (NULL, '$id', ' ', '$picsname')";
	$sql3 = "UPDATE `userInfo` SET `propic` = '$picname' WHERE `userId` = $id";


	$db = getDBConnection();
	$id = -1;
	if ($db != null){
		$res = $db->query($sql);
		$row = $res->fetch_assoc();

		if($res->num_rows == 0){
			
			$res = $db->query($sql2);
			
			
		}
		else{

			$res = $db->query($sql3);
		}
		
		$db->close();
	}
	return $id2;
}

function updateDesc($id, $desc){

	$sql = "UPDATE `userInfo` SET `description` = '$desc' WHERE `userId` = $id";


	$db = getDBConnection();
	$id = -1;
	if ($db != null){
		$res = $db->query($sql);
		$db->close();
	}
	return $id2;
}


