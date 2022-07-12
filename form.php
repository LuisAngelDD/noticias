<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="assets/js/form.js"></script>
    <script src="assets/js/socket.js"></script>
	<script src="assets/js/SILSocket.js"></script>
	<script src="assets/js/proxy.js"></script>
    <title>Formulario</title>
</head>
<body>
<form id="form">
        <input type="text" name="code_noticia" id="code_noticia" placeholder="Codigo de la noticia">
        <input id="boton" type="button" value="Buscar Noticia" onclick="search()">
        <input type="text" name="nombre_noticia" id="nombre_noticia" placeholder="Titulo de la noticia">
        <input type="text" name="cont_noticia" id="cont_noticia" placeholder="Contenido de la noticia">
        <input type="date" name="fecha_noticia" id="fecha_noticia" placeholder="Fecha">
        <input type="time" name="hora_noticia" id="hora_noticia" placeholder="Hora">
        <input type="text" name="autor_noticia" id="autor_noticia" placeholder="Autor de la noticia">
        <input type="text" name="img_noticia" id="img_noticia" placeholder="URL de la img">
        <input id="boton" type="button" value="Enviar datos" onclick="add()">
        <input id="boton" type="button" value="Actualizar informacion" onclick="update()">
        <input id="boton" type="button" value="Eliminar informacion" onclick="sup()">
    </form>
</body>
</html>