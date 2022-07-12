class index {
    constructor(reset = false){
        if(reset)
            window.socket = new SILSocket("ws://127.0.0.1:9000", "pantalla")
    }
}
window.onload = () => {
    new index(true)
    cargarContenedor()
}
async function cargarContenedor () {
    const noticia = new Noticia()
    let dataSend = await fetch('./assets/php/getData.php').then(res=>res.json())
    console.log(dataSend)
    for (var i = 0; i < dataSend.length; i++) {
        noticia.agregarNoticia(dataSend[i].cod,dataSend[i].titulo, dataSend[i].imagen,dataSend[i].descripcion);
    }
}

// window.addEventListener("load", new index())