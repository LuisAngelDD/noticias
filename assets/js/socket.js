class socket extends WebSocket {
	constructor(host, tipo="web") {
		try {
			super(host)
			this.tipo = tipo
			this.onopen = (m) => { this.OK = true }
			this.onclose = (m) => { this.OK = false }
			this.onmessage = (msg) => {
				const data = socket.esJSON(msg.data) ? socket.parse(msg.data) : msg.data,
					mensaje = socket.tipo(data) == "string" ? data : data.mensaje

				if(this[mensaje]) this[mensaje](data)
				else if(self && self[mensaje]) self[mensaje](data)
			}
		}
		catch(ex) { console.log(ex) }
	}

		static esJSON(dt){
			if(socket.tipo(dt) == "string"){
				let i = dt.substr(0,1), f = dt.substr(-1);

				if(i == "{") return f == "}";
				else if(i == "[") return f == "]";
				return false;
			}
			return false;
		};

		static tipo(ob){ return ({}).toString.call(ob).match(/\s([a-z|A-Z]+)/)[1].toLowerCase() }

		static parse(r) {
			try { r = JSON.parse(r) }
			catch(e) {
				console.log(r)
				console.log(e)
			}
			return r
		}

	enviar(msg, datos) {
		this.send(JSON.stringify({mensaje:msg, data:datos}))
	}

	eco(mensaje) {
		if(mensaje != '')
			this.send(JSON.stringify({mensaje: "ECO", data: mensaje}))
	}

	ECO(mensaje) {
		console.log(mensaje.data)
	}

	IDENTIFICATE() {
		this.enviar("IDENTIFICACION", {login:'jmfigueroag', tipo:this.tipo})
	}
}