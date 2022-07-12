<?php
    include 'conexion.php';
    $sql = "INSERT INTO noticias (titulo, descripcion, fecha, hora, autor, 	imagen) VALUES (:titulo,:descripcion,:fecha,:hora,:autor,:imagen)";
	$query = $pdo->prepare($sql);
	$query->bindParam(':titulo', $_POST['nombre_noticia'], PDO::PARAM_STR);
	$query->bindParam(':descripcion', $_POST['cont_noticia'], PDO::PARAM_STR);
    $query->bindParam(':fecha', $_POST['fecha_noticia'], PDO::PARAM_STR);
    $query->bindParam(':hora', $_POST['hora_noticia'], PDO::PARAM_STR);
    $query->bindParam(':autor', $_POST['autor_noticia'], PDO::PARAM_STR);
    $query->bindParam(':imagen', $_POST['img_noticia'], PDO::PARAM_STR);
	$send = $query->execute();
    if($send === TRUE)
        echo json_encode("data agregada");
	else 
        echo json_encode("data no cargados");
?>