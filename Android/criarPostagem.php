<?php

header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST"); // define the request method

include("conexao_bdMSQLI.php");

$data = json_decode(file_get_contents("php://input"), true); // collect input parameters and convert into readable format


$id_cliente = $_POST['idCliente'];
$produto = $_POST['nomeProduto'];
$preco = $_POST['valorProduto'];
$link = $_POST['linkReferencia'];
$paisOrigem = $_POST['paisOrigem'];
$cidadeOrigem = $_POST['cidadeOrigem'];
$ufOrigem = $_POST['estadoOrigem'];
$paisDestino = $_POST['paisDestino'];
$cidadeDestino = $_POST['cidadeDestino'];
$ufDestino = $_POST['estadoDestino'];
$caixa = $_POST['caixa'];

$originalFileName = $_FILES['sendimage']['name']; // Get the original filename
$tempPath = $_FILES['sendimage']['tmp_name'];
$fileSize = $_FILES['sendimage']['size'];


// Get the file extension
$fileExt = strtolower(pathinfo($originalFileName, PATHINFO_EXTENSION));

if (empty($originalFileName)) {
	$errorMSG = json_encode(array("message" => "please select image", "status" => false));
	echo $errorMSG;
} else {
	$upload_path = '../uploads/produtos/'; // set upload folder path 

	// Generate a unique identifier (e.g., using a timestamp or UUID)
	$uniqueIdentifier = uniqid();

	// Combine the identifier and extension for a custom filename
	$customFileName = $uniqueIdentifier . "." . $fileExt;

	// Valid image extensions
	$valid_extensions = array('jpeg', 'jpg', 'png', 'gif');

	// Allow valid image file formats
	if (in_array($fileExt, $valid_extensions)) {
		// Check file size '5MB'
		if ($fileSize < 50000000) {
			$targetFile = $upload_path . $customFileName;

			// Check if a file with the same custom filename already exists 
			if (file_exists($targetFile)) {
				// Optionally handle existing file (e.g., rename, error message)
				$errorMSG = json_encode(array("message" => "A file with that name already exists. Please try a different name.", "status" => false));
				echo $errorMSG;
			} else {


				// Move the uploaded file with the custom filename
				move_uploaded_file($tempPath, $targetFile);

				// Update database using the custom filename
				$query = mysqli_query($conn, "INSERT INTO tb_postagem (ID_CLIENTE, DTA_POSTAGEM, STATUS_POSTAGEM, PRODUTO_POSTAGEM, VALOR_POSTAGEM, LINK_REFERENCIA, PAIS_ORIGEM, CIDADE_ORIGEM, UF_ORIGEM, PAIS_DESTINO, CIDADE_DESTINO, UF_DESTINO, CAIXA, IMAGEM_PRODUTO) 
				VALUES ('$id_cliente', NOW(), 'Pendente', '$produto', '$preco', '$link', '$paisOrigem', '$cidadeOrigem', '$ufOrigem','$paisDestino', '$cidadeDestino', '$ufDestino', '$caixa', '$customFileName')");

				echo json_encode(array("message" => "Image Uploaded Successfully" . $produto, "status" => true));
			}
		} else {
			$errorMSG = json_encode(array("message" => "Sorry, your file is too large, please upload 5 MB size", "status" => false));
			echo $errorMSG;
		}
	} else {
		$errorMSG = json_encode(array("message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed", "status" => false));
		echo $errorMSG;
	}
}
