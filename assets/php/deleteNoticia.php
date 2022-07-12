<?php
    include 'conexion.php';
    $sql = "DELETE FROM noticias WHERE cod=:cod";
	$query = $pdo->prepare($sql);
    $query->bindParam(':cod', $_POST['code_noticia'], PDO::PARAM_STR);
	$send = $query->execute();
    if($send === TRUE)
        echo json_encode("data Eliminada");
	else 
        echo json_encode("No se pudo eliminar");
?>