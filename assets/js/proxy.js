class objeto {
	constructor(add, up, sup){
		this.add = add
		this.up = up
		this.sup = sup
	}
}

proxy = {
	get: (tobjeto, propiedad, receptor) => {
	},
	set: (objeto, propiedad, valor, receptor) => {
        if(propiedad == "add") agregarElemento(valor)
		if(propiedad == "up") actualizarElemento(valor)
        if(propiedad == "sup") eliminarElemento(valor)
        return true
	}
}
async function agregarElemento(add) {
    const noticia = new Noticia()
	let data = new FormData
	data.append('titulo',add)
    let dataSend = await fetch('./assets/php/getNoticiaFront.php',{method:'POST',body:data}).then(res=>res.json())
    noticia.agregarNoticia(dataSend.cod,dataSend.titulo,dataSend.imagen,dataSend.descripcion)
}
function eliminarElemento(code){
	const noticia = new Noticia()
	noticia.removerNoticia(code)
}
async function actualizarElemento(code){
	const noticia = new Noticia()
	let data = new FormData
	data.append('code_noticia',code)
	let dataSend = await fetch('./assets/php/getNoticia.php',{method:'POST',body:data}).then(res=>res.json())
	noticia.updateNoticia(code,dataSend.titulo,dataSend.imagen,dataSend.descripcion)
}