<?php

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *"); // Consider restricting origins for production
header("Access-Control-Allow-Methods: POST");

include("conexao_bdMSQLI.php");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$userId = $_POST['user_id'];

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format

$fileName = $_FILES['sendimage']['name'];
$tempPath = $_FILES['sendimage']['tmp_name'];
$fileSize = $_FILES['sendimage']['size'];

if (empty($fileName)) {
    $errorMSG = json_encode(array("message" => "Please select an image", "status" => false));
    echo $errorMSG;
    exit(); // Stop script execution on error
}

$upload_path = '../uploads/'; // Set upload folder path (create if necessary)

// Validate file type using a more secure method (e.g., finfo)
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mimeType = $finfo->file($tempPath);
$valid_mime_types = array('image/jpeg', 'image/png', 'image/gif');

if (!in_array($mimeType, $valid_mime_types)) {
    $errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));
    echo $errorMSG;
    exit();
}

// Check file size '5MB'
if ($fileSize > 5000000) {
    $errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
    echo $errorMSG;
    exit();
}

// Generate a unique filename with microtime to prevent overwrites
$customFileName =  $userId. "fotoPerfil". '.jpg';
$targetFile = $upload_path . $customFileName;
				if (file_exists($targetFile)) {
					unlink($targetFile);
				}

// Convert image to JPG using GD library
$image = null;
if (in_array($mimeType, array('image/jpeg', 'image/png', 'image/gif'))) {
    switch ($mimeType) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($tempPath);
            break;
        case 'image/png':
            $image = imagecreatefrompng($tempPath);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($tempPath);
            break;
    }

    if ($image) {
        $success = imagejpeg($image, $targetFile, 80); // Adjust quality as needed
        imagedestroy($image);

        if (!$success) {
            $errorMSG = json_encode(array("message" => "Failed to convert image", "status" => false));
            echo $errorMSG;
            exit();
        }
    } else {
        $errorMSG = json_encode(array("message" => "Failed to create image resource", "status" => false));
        echo $errorMSG;
        exit();
    }
} else {
    // Handle invalid MIME type (shouldn't happen due to earlier validation)
    $errorMSG = json_encode(array("message" => "Unsupported image format", "status" => false));
    echo $errorMSG;
    exit();
}

// Move the converted image file (if successful)
// Consider using a prepared statement for the query
if (!isset($errorMSG)) {
    $nomeFoto = $userId. "fotoPerfil" . ".jpg";
	$query =  mysqli_query($conn, "UPDATE tb_usuario set FOTO_PERFIL = '$nomeFoto' WHERE ID_USUARIO = $userId");

	echo json_encode(array("message" => "Image Uploaded Successfully" . $userId, "status" => true));
}

?>
