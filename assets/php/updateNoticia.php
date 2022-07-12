<?php
    include 'conexion.php';
    $sql = "UPDATE noticias SET titulo=:titulo, descripcion=:descripcion, fecha=:fecha, hora=:hora, autor=:autor, imagen=:imagen WHERE cod=:cod";
	$query = $pdo->prepare($sql);
    $query->bindParam(':cod', $_POST['code_noticia'], PDO::PARAM_STR);
	$query->bindParam(':titulo', $_POST['nombre_noticia'], PDO::PARAM_STR);
	$query->bindParam(':descripcion', $_POST['cont_noticia'], PDO::PARAM_STR);
    $query->bindParam(':fecha', $_POST['fecha_noticia'], PDO::PARAM_STR);
    $query->bindParam(':hora', $_POST['hora_noticia'], PDO::PARAM_STR);
    $query->bindParam(':autor', $_POST['autor_noticia'], PDO::PARAM_STR);
    $query->bindParam(':imagen', $_POST['img_noticia'], PDO::PARAM_STR);
	$send = $query->execute();
    if($send === TRUE)
        echo json_encode("data actualizadas");
	else 
        echo json_encode("no se puede actualizar los datos");
?>