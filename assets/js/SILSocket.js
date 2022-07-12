class SILSocket extends socket {
	NOTICIAS_ALTAS(mensaje) {
		const obj = new objeto()
		const objetoConProxy = new Proxy(obj, proxy)
		objetoConProxy.add = mensaje.data.add
	}
	NOTICIAS_MODIFICACIONES(mensaje) {
		const obj = new objeto()
		const objetoConProxy = new Proxy(obj, proxy)
		objetoConProxy.up = mensaje.data.up
	}
	NOTICIAS_BAJAS(mensaje) {
		const obj = new objeto()
		const objetoConProxy = new Proxy(obj, proxy)
		objetoConProxy.sup = mensaje.data.sup
	}
}