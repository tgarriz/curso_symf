const cervezas = {
  	init (opt) {
  		this.opt = opt;
      this.pedidos = [];
  	},
  	load () {

      const select = this.opt.selectCervezas;
      const preSelect = this.opt.preSelect;
      select.html('');
      this.opt.loading.removeClass('hidden');
  		$.ajax({
    			url: Routing.generate('cervezas_get_all'),
          data: {
            select: preSelect.val()
          }
  		})
    		.done((data) => {
  			let items = [];
    			select.append(`<option value="0">Seleccione una cerveza...</option>`);
          $.each(JSON.parse(data), (key, cerveza) => {
            select.append(`<option value="${cerveza.id}"
                         data-id="${cerveza.id}"
                         data-nombre="${cerveza.nombre}"
                         data-origen="${cerveza.origen.descripcion}"
                         data-estilo="${cerveza.estilo.descripcion}"
                         data-color="${cerveza.color.descripcion}"
                         data-punit="${cerveza.precio}"
                         data-presentacion="${cerveza.presentacion}"
                         data-descripcion="${cerveza.descripcion}"
                         data-img="${cerveza.foto}">${cerveza.nombre}</option>`);

    			})

    		}).
        always(() => {
          this.opt.loading.addClass('hidden');
        });
  	},
    onSelectChange () {

      const select       = this.opt.selectCervezas;
      const option       = select.find(':selected');
      const id           = option.data('id');
      const nombre       = option.data('nombre')
      const origen       = option.data('origen')
      const estilo       = option.data('estilo')
      const color        = option.data('color')
      const punit        = option.data('punit')
      const presentacion = option.data('presentacion')
      const descripcion  = option.data('descripcion')
      const img          = (option.data('img') !== undefined ? option.data('img') : 'placeholder.png'  )

      alert();
      this.opt.spanNombre.html(nombre);
      origen !== undefined ? this.opt.spanOrigen.html(origen) : this.opt.spanOrigen.html("Sin Origen");
      estilo !== undefined ? this.opt.spanEstilo.html(estilo) : this.opt.spanEstilo.html("Sin Estilo");
      color !== undefined ? this.opt.spanColor.html(color) : this.opt.spanColor.html("Sin Color");
      this.opt.spanPUnit.html(punit);
      this.opt.spanPresentacion.html(presentacion);
      this.opt.spanDescripcion.html(descripcion);
      this.opt.imgBeer.attr('src', './assets/img/uploads/'+img);

    },
    add () {
      const select   = this.opt.selectCervezas;
      const option   = select.find(':selected');
      const id       = option.data('id');

      if (id === undefined) {
        return
      }

    const punit    = option.data('punit')
    const nombre   = option.data('nombre')
    const cantidad = this.opt.inputCantidad.val();
    const total    = parseFloat(this.opt.spanTotal.html());
    const cantRows = $("#tablaPedidos > tbody > tr").length + 1;

    const newRow = `
      <tr data-id="${id}" data-cantidad="${cantidad}" data-punit="${punit}">
        <td>${cantRows}</td>
            <td>${nombre}</td>
            <td>${cantidad}</td>
            <td>${punit}</td>
            <td>${punit*cantidad}</td>
            <td>
            <a href="#" onclick="return cervezas.remove($(this).closest('tr'))">
            <i class="fa fa-trash"></i>&nbsp;</a></td>
          </tr>
    `;

    this.opt.spanTotal.html(total + parseFloat(punit*cantidad))
    this.opt.tablaPedidos.append(newRow);

    let pedido = new Object();
    pedido.cantidad = cantidad;
    pedido.cervezaId = id;
    this.pedidos.push(pedido);
    this.opt.delivery.val(JSON.stringify(this.pedidos));

    },
    remove (row){
      const cantidad = row.data('cantidad');
      const punit = row.data('punit');
      const total = parseFloat(this.opt.spanTotal.html());
      this.opt.spanTotal.html(total - parseFloat(punit*cantidad))
      row.remove();
      return false;
    }
}
