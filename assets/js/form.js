class form {
    constructor(reset = false) {
		if (reset)
			window.socket = new SILSocket("ws://127.0.0.1:9000", "pantalla")
	}
}
window.onload = () => {
	new form(true)
}

function add(){
    console.log("Enviando datos")
    var form  = document.getElementById('form')
    var dataForm = new FormData(form)
    send(dataForm,1)
}
function search(){
    console.log("Buscando datos")
    var form  = document.getElementById('form')
    var dataForm = new FormData(form)
    send(dataForm,2)
}
function update(){
    console.log("Actualizando datos")
    var form  = document.getElementById('form')
    var dataForm = new FormData(form)
    send(dataForm,3)
}
function sup(){
    console.log("Eliminando datos")
    var form  = document.getElementById('form')
    var dataForm = new FormData(form)
    send(dataForm,4)
}
async function send(data,option){
    if (option===1){
        await fetch('./assets/php/sendData.php',{method:'POST',body:data}).then(res=>res.json())
        document.getElementById("nombre_noticia").value = "";
        document.getElementById("cont_noticia").value = "";
        document.getElementById("fecha_noticia").value = "";
        document.getElementById("hora_noticia").value = "";
        document.getElementById("autor_noticia").value = "";
        document.getElementById("img_noticia").value = "";
    	window.socket.enviar("NOTICIAS_ALTAS", { add: data.get('nombre_noticia')})
    } else if (option===2){
        let dataSend = await fetch('./assets/php/getNoticia.php',{method:'POST',body:data}).then(res=>res.json())
        document.getElementById("nombre_noticia").value = dataSend.titulo;
        document.getElementById("cont_noticia").value = dataSend.descripcion;
        document.getElementById("fecha_noticia").value = dataSend.fecha;
        document.getElementById("hora_noticia").value = dataSend.hora;
        document.getElementById("autor_noticia").value = dataSend.autor;
        document.getElementById("img_noticia").value = dataSend.imagen;
    } else if (option===3){
        await fetch('./assets/php/updateNoticia.php',{method:'POST',body:data}).then(res=>res.json())
        document.getElementById("code_noticia").value = "";
        document.getElementById("nombre_noticia").value = "";
        document.getElementById("cont_noticia").value = "";
        document.getElementById("fecha_noticia").value = "";
        document.getElementById("hora_noticia").value = "";
        document.getElementById("autor_noticia").value = "";
        document.getElementById("img_noticia").value = "";
        window.socket.enviar("NOTICIAS_MODIFICACIONES", { up: data.get('code_noticia')})
    } else {
        await fetch('./assets/php/deleteNoticia.php',{method:'POST',body:data}).then(res=>res.json())
        document.getElementById("code_noticia").value = "";
        document.getElementById("nombre_noticia").value = "";
        document.getElementById("cont_noticia").value = "";
        document.getElementById("fecha_noticia").value = "";
        document.getElementById("hora_noticia").value = "";
        document.getElementById("autor_noticia").value = "";
        document.getElementById("img_noticia").value = "";
        window.socket.enviar("NOTICIAS_BAJAS", { sup: data.get('code_noticia')})
    }
}
