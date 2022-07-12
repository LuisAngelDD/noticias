<?php
    include 'conexion.php';
    $sentenciaSQL = $pdo->prepare("SELECT * FROM noticias where cod ='". $_POST['code_noticia'] . "'");
    $sentenciaSQL->execute();
    $noticia = $sentenciaSQL->fetch(\PDO::FETCH_OBJ);
    echo json_encode($noticia);
?>