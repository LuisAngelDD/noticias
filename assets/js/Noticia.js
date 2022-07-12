class Noticia {
    agregarNoticia(cod,titulo, imagen, contenido) {
        var contenedor = document.getElementById('grid-container');
        const item = document.createElement("div");
        item.id = cod;
        const title = document.createElement("h3");
        title.textContent= titulo;
        const img = document.createElement("img");
        img.classList = "grid-item"
        img.src = imagen;
        img.alt = titulo;
        const desc = document.createElement("p");
        desc.textContent = contenido
        item.appendChild(title);
        item.appendChild(img);
        item.appendChild(desc)
        contenedor.appendChild(item);
    }
    removerNoticia(cod) {
        var contenedor = document.getElementById('grid-container');
        const item = contenedor.children
        var i=0
        while(i<item.length){
            if (item[i].id == cod) {
                contenedor.removeChild(item[i])
                i = item.length
            }
            i++
        }
    }
    updateNoticia(cod,titulo, imagen, contenido){
        var contenedor = document.getElementById('grid-container');
        const item = contenedor.children
        var i=0
        while(i<item.length){
            if (item[i].id == cod) {
                item[i].children[0].textContent = titulo
                item[i].children[1].src = imagen
                item[i].children[2].textContent = contenido
                i = item.length
            }
            i++
        }
    }
}