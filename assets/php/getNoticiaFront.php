<?php
    include 'conexion.php';
    $sentenciaSQL = $pdo->prepare("SELECT * FROM noticias where titulo ='". $_POST['titulo'] . "'");
    $sentenciaSQL->execute();
    $noticia = $sentenciaSQL->fetch(\PDO::FETCH_OBJ);
    echo json_encode($noticia);
?>