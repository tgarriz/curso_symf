$( document ).ready(function() {

	cervezas.init({
		inputCantidad    : $("#cantidad"),
		spanTotal        : $("#total"),
		selectCervezas   : $("#selectCerveza"),
		tablaPedidos     : $("#tablaPedidos tbody"),
		tablaPedidosRows : $("#tablaPedidos > tbody > tr"),
		spanNombre       : $("#nombre"),
		spanOrigen       : $("#origen"),
		spanEstilo       : $("#estilo"),
		spanColor        : $("#color"),
		spanPUnit        : $("#punit"),
		spanPresentacion : $("#presentacion"),
		spanDescripcion  : $("#descripcion"),
		imgBeer          : $("#imgBeer"),
		preSelect        : $("#preSelect"),
		loading          : $("#loading"),
		delivery         : $("#delivery_cervezas")
	})

	cervezas.load()

})
