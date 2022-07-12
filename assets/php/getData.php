<?php
    include 'conexion.php';
    $sentenciaSQL = $pdo->prepare("SELECT * FROM noticias");
    $sentenciaSQL->execute();
    $noticia = $sentenciaSQL->fetchAll(\PDO::FETCH_OBJ);
    echo json_encode($noticia);
?>