<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST"); // here is define the request method

$host = "zippybd.mysql.dbaas.com.br";
$dbname = "zippybd"; // Nome do seu banco de dados
$username = "zippybd"; // Seu usuário
$password = "C0dingd3vs@"; // Sua senha
$conn = mysqli_connect("zippybd.mysql.dbaas.com.br", "zippybd", "C0dingd3vs@", "zippybd");

$userId = $_POST['user_id'];

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format

$fileName  =  $_FILES['sendimage']['name'];
$tempPath  =  $_FILES['sendimage']['tmp_name'];
$fileSize  =  $_FILES['sendimage']['size'];

if (empty($fileName)) {
	$errorMSG = json_encode(array("message" => "please select image", "status" => false));
	echo $errorMSG;
} else {
	$upload_path = 'img/'; // set upload folder path 

	$fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION)); // get image extension

	$customFileName = $userId. "fotoPerfil" . "." . $fileExt;

	// valid image extensions
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

	// allow valid image file formats
	if (in_array($fileExt, $valid_extensions)) {
		//check file not exist our upload folder path

			// check file size '5MB'
			if ($fileSize < 5000000) {
				
				$targetFile = $upload_path . $customFileName;
				if (file_exists($targetFile)) {
					unlink($targetFile);
				}

				move_uploaded_file($tempPath, $targetFile); // move file from system temporary path to our upload folder path 
			} else {
				$errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
				echo $errorMSG;
			}

	} else {
		$errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));
		echo $errorMSG;
	}
}

// if no error caused, continue ....
if (!isset($errorMSG)) {
	$query =  mysqli_query($conn, "UPDATE tb_usuario set FOTO_PERFIL = 'img/$fileName' WHERE ID_USUARIO = $userId");

	echo json_encode(array("message" => "Image Uploaded Successfully" . $userId, "status" => true));
}
